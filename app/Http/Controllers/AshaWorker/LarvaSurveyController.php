<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Str;
use Intervention\Image\Facades\Image;
use App\Models\WastePickup;

class LarvaSurveyController extends Controller
{
  public function create(){
    $menu = 'dashboard';
    return view('asha_worker.larva_survey.add', compact('menu'));
  }

  public function store(Request $request){
      \Session::forget('success');\Session::forget('error');
   try {
    $data = $request->except('image','_token');
    $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
    $data['uid'] = (string)Str::uuid();
    $data['cust_id'] = Auth::guard('customer')->id();
    $data['ward'] = Auth::guard('customer')->user()->ward;
    $nme = \Carbon\Carbon::now()->format('YmdHis');
    $images=array();
    if ($request->hasFile('image')) 
    {
      $files=$request->file('image');
      $i=1;
      try {
        foreach($files as $file)
        { 
          $image_name = date('Ymdhis').$i.rand(10,99).'.'.$file->extension();
          $destinationPath = base_path('public/uploads/pick');
          if(is_readable($file)){
            $dimension = getimagesize($file);
            $x = 900;
            $y = round($x * $dimension[1] / $dimension [0]);
            $y = (int) $y;
            
            $img = Image::make($file->getRealPath());
            $img->orientate()->resize($x, $y, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas($x, $y)->save($destinationPath.'/'.$image_name);
          }else{
            $file->move($destinationPath, $image_name);
          }
            $images[]=$image_name;
            $i++;
        }
        $data['image_data'] = implode(",",$images);
      } catch (\Exception $e) {
         \Session::put('error',"Issue in image format please change your camera settings are try again");
         return redirect()->back();
      }
    }
    // $result =  WastePickup::table('pick')->insert($data);
    $result =  WastePickup::create($data);
    $sid = $result->id;//DB::getPdo()->lastInsertId();
    $request->session()->put('sts' , $sid);
    if(!empty($result))
      return redirect()->route('asha_worker.servey_list')->with('success', __('messages.larva survey submitted successfully'));
    else{
      Session::put('error',"Something went wrong please try again.");
      return redirect()->back();
    }
   } catch (\Exception $e) {
      \Session::put('error',"Exception while processing survey data: " . $e->getMessage());
      return redirect()->back();
   }
  }

  
  public function survey_ward(Request $request){
    $user_ward = null;
    if(Auth::guard('customer')->user()->ward){
      $ward_ids = DB::table('ward')
                    ->where('x_min', '<=', $request->lat)
                    ->where('x_max', '>=', $request->lat)
                    ->where('y_min', '<=', $request->long)
                    ->where('y_max', '>=', $request->long)
                    ->pluck('id')->toArray();
      if(in_array(Auth::guard('customer')->user()->ward, $ward_ids)){
        return response()->json([
          'success' => false,
        ]);
      }else{
        $ward_name = DB::table('ward')->whereId(Auth::guard('customer')->user()->ward)->value('name');
        $message = 'It looks like you are outside '.$ward_name. ' area. Please check your location before continue.';
        return response()->json([
          'success' => true,
          'title' => 'Warning!',
          'message' => $message,
        ]);
      }
    } 
    return response()->json([
      'success' => false
    ]);
  }
}
