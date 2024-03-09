<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Response;

use Validator,Redirect;

use App;

use Session;

use Auth;

use Crypt;


class ApiController extends Controller
{
    public function listlocations()
    {
        
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
    }
    else
    {
      $gridata['CODE']   =   0;
      $gridata['CODEMESSAGE']    =   'Datas not found';
      $gridata['result'] = array();
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }  
  }
  
  public function listsurveys(Request $request)
    {
      $length = $request->length??5;
      $datas = DB::table('pick')
      ->select('pick.id as Id','customers.username as Asha worker','pick.q1 as Breeding spot','pick.waste as Container Type','pick.descp as Remarks','pick.image_data as Image','pick.source_reduction as Source Reduction','pick.source_reduction_img as Source Reduction Image','ward.name as Ward Name','pick.latit as Latitude and Longitude','pick.created_at as Date and Time')
      ->join('customers', 'pick.cust_id', '=', 'customers.id' ,'left')
      ->join('ward', 'pick.ward', '=', 'ward.id' ,'left')
      ->where('pick.status', 1)
      ->paginate($length);
      
      foreach($datas as $data){
          $data->image_url = url('/').'/public/uploads/pick/'.$data->Image;
      }

      // $reslt = $datas->chunk(5000, function ($datas) {
      //   $json = $datas->map(function ($datasdt) {
      //       return $datasdt->toArray();
      //   });
      // // return response()->json($json);
      // });       
     
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


}
