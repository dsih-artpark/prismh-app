<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB, File, Hash;
use App\Models\Customer;

class SprayTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $wards = DB::table('ward')->pluck('id')->toArray();
      $spray_team = Customer::where('roles','=',2)->whereIn('ward', $wards)->get();
      return view('admin.spray_team.index', compact('spray_team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $role = DB::table('roles')->select('id','name')->where('id',2)->first();
      $wards = DB::table('ward')->select('id','name')->get();
      return view('admin.spray_team.add', compact('role','wards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $data = $request->except('_token', 'password');
        if($request->password) 
        $data['password'] = Hash::make($request->password);
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        if($request->hasFile('id_card') && $request->id_card){
          $file = $request->id_card;
          $extension = File::extension($file->getClientOriginalName());
          $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
          $file->move(public_path('uploads/id_cards/'), $filename);
          $data['id_card'] = '/public/uploads/id_cards/'.$filename;
        }
        $user = Customer::create($data);
        return redirect()->route('admin.spray-team.index')->with ('succes', 'User added successfully');
      } catch(\Throwable $e){
        return back()->with('error','Something went wrong.');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Customer::find($id);
      $roles = DB::table('roles')->select('id','name')->get();
      $wards = DB::table('ward')->select('id','name')->get();
      return view('admin.spray_team.edit', compact('user','roles','wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if ($request->ajax() || $request->wantsJson()) {
        $user = Customer::find($request->id);
        $status = $user->status == 1 ? 0 : 1 ;
        Customer::find($request->id)->update(['status'=>$status]);
        return response()->json(['success'=>true, 'message'=>'Status Updated Successfully']);
      }

      try{
        $data = $request->except('_token', 'password', '_method');
        if($request->password) 
        $data['password'] = Hash::make($request->password);
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        if($request->hasFile('id_card') && $request->id_card){
          $file = $request->id_card;
          $extension = File::extension($file->getClientOriginalName());
          $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
          $file->move(public_path('uploads/id_cards/'), $filename);
          $data['id_card'] = '/public/uploads/id_cards/'.$filename;
        }
        $user = Customer::find($id)->update($data);
        return redirect()->route('admin.spray-team.index')->with ('succes', 'User updated successfully');
      } catch(\Throwable $e){
        return back()->with('error','Something went wrong.');
      }
    }
}
