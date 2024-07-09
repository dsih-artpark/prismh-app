<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth;

class FeverSurveyController extends Controller
{
  public function create(){
    $menu = 'dashboard';
    return view('asha_worker.fever_survey.add', compact('menu'));
  }

  public function store(Request $request){
    $data['cust_id'] = Auth::guard('customer')->id();
    $data['latit'] = convert_uuencode($request->input('latit'));
    $data['name'] = convert_uuencode($request->input('name'));
    $data['phone'] = convert_uuencode($request->input('phone'));
    $data['created_at'] = date('Y-m-d H:i:s');
    $result =  DB::table('survey_patients')->insert($data);
    if(!empty($result))
      return redirect()->route('asha_worker.dashboard')->with('success', 'Form submitted successfully');
    else
      return redirect()->back()->with('error', 'Something went wrong');
  }
}
