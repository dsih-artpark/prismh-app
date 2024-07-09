<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;
use App\Models\Division;
use Illuminate\Support\Facades\Validator;

class WardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $wards = Ward::get();
    return view('admin.ward.index', compact('wards'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $divisions = Division::get();
    return view('admin.ward.add', compact('divisions'));
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
      'name' => 'required|unique:ward,name',
      'number' => 'required|unique:ward,number',
      'division_id' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    Ward::create(['name'=>$request->name,'number'=>$request->number, 'division_id'=>$request->division_id, 'status'=>1]);
    return redirect()->route('admin.ward.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $ward = Ward::find($id);
    $divisions = Division::get();
    return view('admin.ward.edit', compact('ward','divisions'));
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
      'name' => 'required|unique:ward,name,'.$id,
      'number' => 'required|unique:ward,number,'.$id,
      'division_id' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    Ward::find($id)->update(['name'=>$request->name,'number'=>$request->number, 'division_id'=>$request->division_id]);
    return redirect()->route('admin.ward.index');
  }
}
