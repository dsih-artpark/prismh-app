<?php

namespace App\Http\Controllers\Executive;

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
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $wards = DB::table('ward')->whereIn('division_id', $divisions)->pluck('id')->toArray();
      $dumps = DB::table('dump')
              ->select('dump.*','customers.username','pick.q1')
              ->join('pick','dump.pid','=','pick.id','left')
              ->join('customers','dump.cust_id','=','customers.id','left')
              ->whereIn('pick.ward',$wards)
              ->orderBy('dump.id','desc')
              ->get();
      return view('executive.spray.index', compact('dumps'));
    }
}
