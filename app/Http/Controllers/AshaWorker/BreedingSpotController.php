<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth;

class BreedingSpotController extends Controller
{
  public function index(){
    $menu = 'breeding_spots';
    $surveys =  DB::table('pick')->where('cust_id', Auth::guard('customer')->id())->where('q1','=',"Yes")->where('status', 1)->orderBy('id', 'desc')->get();
    return view('asha_worker.breeding_spot.list', compact('menu', 'surveys'));
  }

  public function show($id){
    $menu = 'breeding_spots';
    $survey =  DB::table('pick')->where('id', $id)->first();
    return view('asha_worker.breeding_spot.details', compact('menu', 'survey'));
  }
}
