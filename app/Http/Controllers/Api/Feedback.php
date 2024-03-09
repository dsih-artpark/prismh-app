<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

use Response;


use App;

use Session;

use Auth;


class Feedback extends Controller
{

 public function feedbackstore(Request $request)
  {
    //   print_r(DB::table('grievance')->get());die;
    $data['u_id'] = $request->input('user');
      $data['category'] = $request->input('category');
      $data['subcategory'] = $request->post('subcategory');
      $data['description'] = $request->post('description');
      $data['address'] = $request->post('address');
      $data['ward_no'] = $request->post('ward_no');
      $data['ward_name'] = $request->post('ward_name');
      $data['latitude'] = $request->post('latitude');
      $data['longitude'] = $request->post('longitude'); 
     
      
       if ($request->hasFile('capture')) 
       {
           $image = $request->file('capture');
        $image_name = date('y-m-d-his').'.'.$image->getClientOriginalExtension();
         $destinationPath = base_path('public/images/feedback');
        $image->move($destinationPath, $image_name);
     
      $data['capture'] = $image_name;
      
       }
      
    $griresult = DB::table('grievance')->insert($data);
    $fd['gri_id'] = DB::getPdo()->lastInsertId();
     $fd['feedback'] = $request->post('feedback'); 
      $fd['rating'] = $request->post('rating'); 
    
     $result = DB::table('grievance_feedback')->insert($fd);
     if($result){
         
         $grievance = DB::table('grievance')->join('grievance_feedback', 'grievance.id', '=', 'grievance_feedback.gri_id' ,'left')->where('grievance.id', $fd['gri_id'])->get();
         
      $gridata['CODE'] = 1;
      $gridata['CODEMESSAGE'] = 'Success';
      $gridata['CODEDESCRIPTION'] = 'Feedback inserted';
      $gridata['result'] = $grievance;
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }
    else
    {
      $gridata['CODE']   =   0;
      $gridata['CODEMESSAGE']    =   'Failure';
      $gridata['result'] = array();
      $gridata['CODEDESCRIPTION']    =   'failed to insertion';
      return Response::json($gridata, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->header('Content-Type', 'application/json');
    }  
  }
 
  
}
