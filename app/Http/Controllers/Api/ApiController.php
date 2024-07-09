<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
  public function listlocations(){
    $datas = DB::table('zone')
    ->join('division', 'zone.id', '=', 'division.zone_id' ,'left')
    ->join('ward', 'division.id', '=', 'ward.division_id' ,'left')
    ->where('zone.status', 1)
    ->where('division.status', 1)
    ->where('ward.status', 1)
    ->get();
    
    if($datas){
      $gridata['CODE'] = 1;
      $gridata['CODEMESSAGE'] = 'Datas Found';
      $gridata['result'] = $datas;
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }else{
      $gridata['CODE']   =   0;
      $gridata['CODEMESSAGE']    =   'Datas not found';
      $gridata['result'] = array();
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }  
  }
  
  public function listsurveys(Request $request){
    if(!$request->token)
      return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
    $user = DB::table('api_authentication')->where(['token' => $request->token, 'type' => 'larava'])->first();
    if(!$user)
      return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
    $length = $request->length??5000;
    $datas = DB::table('pick')
    ->select('pick.id as Id','pick.uid as Uid','customers.username as Asha worker','pick.q1 as Breeding spot','pick.waste as Container Type','pick.indoor as Indoor','pick.outdoor as Outdoor','pick.descp as Remarks','pick.image_data as Image','pick.source_reduction as Source Reduction','ward.name as Ward Name','ward.number as Ward Number','pick.latit as Latitude and Longitude','pick.created_at as Date and Time')
    ->join('customers', 'pick.cust_id', '=', 'customers.id' ,'left')
    ->join('ward', 'pick.ward', '=', 'ward.id' ,'left')
    ->where('pick.status', 1)
    ->paginate($length)
    ->appends(request()->query());
    
    foreach($datas as $data){
        $data->image_url = url('/').'/public/uploads/pick/'.$data->Image;
    }  
    return $datas;
    
    if($datas){
      $gridata['CODE'] = 1;
      $gridata['CODEMESSAGE'] = 'Datas Found';
      $gridata['result'] = $datas;
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }
    else
    {
      $gridata['CODE']   =   0;
      $gridata['CODEMESSAGE']    =   'Datas not found';
      $gridata['result'] = array();
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }  
  }

  public function fever_servey_list(Request $request)
  {
      if(!$request->token)
        return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
      $user = DB::table('api_authentication')->where(['token' => $request->token, 'type' => 'fever'])->first();
      if(!$user)
        return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
      $length = $request->length??5;
      $serveys = DB::table('survey_patients')
      ->join('customers','survey_patients.cust_id','=','customers.id','left')
      ->select('customers.username as asha_worker', 'survey_patients.name as patient','survey_patients.phone', 'survey_patients.latit as latlong', 'survey_patients.created_at as date')
      ->paginate($length)
      ->appends(request()->query());

      if(count($serveys) == 0)
      return response()->json([
        'success' => false,
        'message' => 'Data Not Found.',
        'result' => (object)[]
      ]);
      return response()->json([
        'success' => true,
        'message' => 'Data Found.',
        'result' => $serveys
      ]);
  }

  public function access_token(Request $request){
    if(!$request->email || !$request->password)
      return response()->json(['success' => false, 'message' => 'Please enter email & password']);
    $user = DB::table('api_authentication')->where(['email'=>$request->email, 'password'=>$request->password])->first();
    if(!$user)
     return response()->json(['success'=>false, 'message' => 'Please enter valid credentials.']);
    $token = (string)Str::uuid();
    DB::table('api_authentication')->where(['email'=>$request->email, 'password'=>$request->password])->update(['token'=>$token]);
    return response()->json([
      'success' => true,
      'message' => 'Please use this token to fetch data.',
      'token' => $token
    ]);
  }
}
