<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class ExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $authorities = DB::table('customers')->select('customers.*','roles.name as role_name')->join('roles','roles.id','=','customers.roles')->whereNotIn('roles',[1,2])->get();
      return view('admin.executives.list', compact('authorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = DB::table('roles')->whereIn('id',[3,4,5,6])->get();
      $zones = DB::table('zone')->get();
      $divisions = DB::table('division')->get();
      $wards = DB::table('ward')->where('status', 1)->get();
      return view('admin.executives.add', compact('roles','zones','divisions','wards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required|unique:customers,email',
        'phone' => 'required|unique:customers,phone',
			]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      $data = $request->only('roles', 'username', 'phone', 'email');
      if($request->status == 1) $data['status'] = 1;
      $data['password'] = Hash::make($request->password);
      if($request->has('ward_ids')) {
        $data['ward_ids'] = implode(',', $request->ward_ids);
      }
      if($request->has('zone_ids')) {
        $data['zone_ids'] = implode(',', $request->zone_ids);
      }
      if($request->has('division_ids')) {
        $data['division_ids'] = implode(',', $request->division_ids);
      }
      Customer::create($data);
      return redirect()->route('admin.executive.index');
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
      $roles = DB::table('roles')->whereIn('id',[3,4,5,6])->get();
      $zones = DB::table('zone')->get();
      $divisions = DB::table('division')->get();
      $wards = DB::table('ward')->where('status', 1)->get();
      return view('admin.executives.edit', compact('user','roles','zones','divisions','wards'));
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
      $validator = Validator::make($request->all(), [
        'email' => 'required|unique:customers,email,'.$id,
        'phone' => 'required|unique:customers,phone,'.$id,
			]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      $data = $request->only('roles', 'username', 'phone', 'email', 'zone_id', 'division_id');
      if($request->status == 1) $data['status'] = 1;
      if($request->password) $data['password'] = Hash::make($request->password);
      if($request->has('ward_ids')) {
        $data['ward_ids'] = implode(',', $request->ward_ids);
      }
      if($request->has('zone_ids')) {
        $data['zone_ids'] = implode(',', $request->zone_ids);
      }
      if($request->has('division_ids')) {
        $data['division_ids'] = implode(',', $request->division_ids);
      }
      if($data['roles'] == 3){
        $data['division_ids'] = null; $data['ward_ids'] = null;
      }
      if($data['roles'] == 4){
        $data['zone_ids'] = null; $data['ward_ids'] = null;
      }
      if(in_array($data['roles'], [5,6])){
        $data['division_ids'] = null; $data['zone_ids'] = null;
      }
      Customer::find($id)->update($data);
      return redirect()->route('admin.executive.index');
    }
}
