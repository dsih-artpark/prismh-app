<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::get();
      return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.role.add');
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
        'name' => 'required|unique:roles,name',
      ]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      Role::create(['name'=>$request->name, 'status'=>$request->status == 'on' ? 1 : 0]);
      return redirect()->route('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::find($id);
      return view('admin.role.edit', compact('role'));
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
        $role = Role::find($request->id);
        $status = $role->status == 1 ? 0 : 1 ;
        Role::find($request->id)->update(['status'=>$status]);
        return response()->json(['success'=>true, 'message'=>'Status Updated Successfully']);
      }
      $validator = Validator::make($request->all(), [
        'name' => 'required|unique:roles,name,'.$id,
			]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      Role::find($id)->update(['name'=>$request->name, 'status'=>$request->status == 'on' ? 1 : 0]);
      return redirect()->route('admin.role.index');
    }
}
