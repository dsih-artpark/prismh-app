<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $zones = Zone::get();
    return view('admin.zone.index', compact('zones'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.zone.add');
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
      'title' => 'required|unique:zone,title',
      'latitude' => 'required',
      'longitude' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $data = $request->except('_token');
    $data['status'] = 1;
    Zone::create($data);
    return redirect()->route('admin.zone.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $zone = Zone::find($id);
    return view('admin.zone.edit', compact('zone'));
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
      'title' => 'required|unique:zone,title,'.$id,
      'latitude' => 'required',
      'longitude' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $data = $request->except('_token', '_method');
    Zone::find($id)->update($data);
    return redirect()->route('admin.zone.index');
  }
}
