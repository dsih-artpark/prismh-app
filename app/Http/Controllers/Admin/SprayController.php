<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB;

class SprayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $wards = DB::table('ward')->pluck('id')->toArray();
      $dumps = DB::table('dump')
              ->select('dump.*','customers.username','pick.q1')
              ->join('pick','dump.pid','=','pick.id','left')
              ->join('customers','dump.cust_id','=','customers.id','left')
              ->whereIn('pick.ward',$wards)
              ->orderBy('dump.id','desc')
              ->get();
      return view('admin.spray.index', compact('dumps'));
    }
}
