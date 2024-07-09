<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::get();
        return view('admin.admin_user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.admin_user.add');
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
        'name' => 'required',
        'email' => 'required|unique:pwa_admin,email',
        'phone' => 'required|unique:pwa_admin,phone',
      ]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      $data = $request->only('name', 'email', 'phone');
      if($request->password!='')
      $data['password'] = Hash::make($request->password);
      Admin::create($data);
      return redirect()->route('admin.admin-user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Admin::find($id);
      return view('admin.admin_user.edit', compact('user'));
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
        'name' => 'required',
        'email' => 'required|unique:pwa_admin,email,'.$id.',admin_id',
        'phone' => 'required|unique:pwa_admin,phone,'.$id.',admin_id',
      ]);
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }
      $data = $request->only('name', 'email', 'phone');
      if($request->password!='')
      $data['password'] = Hash::make($request->password);
      Admin::find($id)->update($data);
      return redirect()->route('admin.admin-user.index');
    }
}
