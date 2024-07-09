<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB, File;
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
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $wards = DB::table('ward')->whereIn('division_id', $divisions)->pluck('id')->toArray();
      $spray_team = Customer::where('roles','=',2)->whereIn('ward', $wards)->get();
      return view('executive.spray_team.index', compact('spray_team'));
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
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $wards = DB::table('ward')->whereIn('division_id', $divisions)->select('id','name')->get();
      return view('executive.spray_team.edit', compact('user','roles','wards'));
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
        $user = Customer::find($id)->update($data);
        return redirect()->route('executive.spray-team.index')->with ('succes', 'User updated successfully');
      } catch(\Throwable $e){
        return back()->with('error','Something went wrong.');
      }
    }
}
