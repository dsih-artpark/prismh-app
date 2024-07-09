<?php

namespace App\Http\Controllers\SprayTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Str;

class TaskController extends Controller
{
  public function index(){
    $menu = 'my_task';
    $ward = explode(',',Auth::guard('customer')->user()->ward);
    $pick_ids =  DB::table('pick')->whereIn('ward',$ward)
                      ->where(function ($query) {
                          $query->where('source_reduction', '=', null)
                                ->orWhere('source_reduction', '=', 'Not Done');
                      })->where('q1','=','Yes')
                      ->where('status', 1)
                      ->orderBy('id', 'desc')
                      ->pluck('id')->toArray();
    
    $dump_pick_ids = DB::table('dump')->whereIn('pid', $pick_ids)->pluck('pid')->toArray();
    $pids = array_diff($pick_ids, $dump_pick_ids);
    $tasks = DB::table('pick')->whereIn('id',$pids)->orderBy('id', 'desc')->get();
    return view('spray_team.task.list', compact('menu', 'tasks'));
  }

  public function show($id){
    $menu = 'my_task';
    $task =  DB::table('pick')->where('id', $id)->first();
    $dump_details =  DB::table('dump')->where('pid', $task->id)->first();
    return view('spray_team.task.details', compact('menu', 'task', 'dump_details'));
  }

  public function create($id){
    $menu = 'my_task';
    return view('spray_team.task.add', compact('menu', 'id'));
  }

  public function store(Request $request)
  {
    $file_name = Carbon::now()->format('YmdHis').rand(10,99);
    $imageData = $request->input('image_data');
    $imageName = $file_name.'.png';
    if(!empty($imageData)){
      $imageData = str_replace('data:image/png;base64,', '', $imageData);
      $imageData = str_replace(' ', '+', $imageData);
      $imageData = base64_decode($imageData);
      file_put_contents(public_path('uploads/dump/' . $imageName), $imageData);      
      $data['image_data'] = $imageName;
    }
    $data['pid'] = $request->input('pid')? $request->input('pid') : '';
    $data['latit'] = $request->input('latit');
    $data['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
    // $uid = Str::random(4, '1234567890');
    // $data['uid'] = "BBMPMMS".$uid;
    $data['uid'] = (string)Str::uuid();
    $data['cust_id'] = Auth::guard('customer')->id();
    $result =  DB::table('dump')->insert($data);
    $did = DB::getPdo()->lastInsertId();
    DB::table('pick')->where('id', $data['pid'])->update(['source_reduction' => 'Done']);
      if(!empty($result))
        return redirect()->route('spray_team.task_list')->with('success', 'Added successfully!');
      else
        return redirect()->back()->with('error', 'Something went wrong, Please try again.');  
  }
}
