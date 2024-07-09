<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Division;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $divisions = Division::get();
    return view('admin.division.index', compact('divisions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $zones = Zone::get();
    return view('admin.division.add', compact('zones'));
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
      'name' => 'required|unique:division,name',
      'latitude' => 'required',
      'longitude' => 'required',
      'zone_id' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $data = $request->except('_token');
    $data['status'] = 1;
    Division::create($data);
    return redirect()->route('admin.division.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $division = Division::find($id);
    $zones = Zone::get();
    return view('admin.division.edit', compact('division', 'zones'));
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
      'name' => 'required|unique:division,name,'.$id,
      'latitude' => 'required',
      'longitude' => 'required',
      'zone_id' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $data = $request->except('_token', '_method');
    Division::find($id)->update($data);
    return redirect()->route('admin.division.index');
  }
}
