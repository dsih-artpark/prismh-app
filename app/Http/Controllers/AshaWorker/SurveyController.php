<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth;

class SurveyController extends Controller
{
  public function index(){
    $menu = 'larva_servey';
    $surveys =  DB::table('pick')->where('cust_id', Auth::guard('customer')->id())->where('status', 1)->orderBy('id', 'desc')->get();
    return view('asha_worker.survey.list', compact('menu', 'surveys'));
  }

  public function show($id){
    $menu = 'larva_servey';
    $survey =  DB::table('pick')->where('id', $id)->first();
    return view('asha_worker.survey.details', compact('menu', 'survey'));
  }
}
