<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Hash;
use App\Models\Customer;
use App\Models\WastePickup;

class SurveyController extends Controller
{
  public function servey_list(Request $request){
    $menu = 'manage';
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $wards = DB::table('ward')->whereIn('id', $ward_ids)->select('id', 'name', 'number')->get();
    foreach($wards as $ward)
      $ward->survey_count = DB::table('pick')->where('ward', $ward->id)->where('status', 1)->count();
    if($request->ward!='')
      $surveys =  DB::table('pick')->where('ward', $request->ward)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
    else
      $surveys =  DB::table('pick')->whereIn('ward', $ward_ids)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
    // dd($surveys);
    return view('workers.survey.list', compact('menu','surveys','wards'));
  }

  public function servey_details($id){
    $menu = 'manage';
    $survey =  DB::table('pick')->where('id', $id)->first();
    return view('workers.survey.details', compact('menu','survey'));
  }

  public function breeding_spots(){
    $menu = 'manage';
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $wards = DB::table('ward')->whereIn('id', $ward_ids)->select('id', 'name')->get();
    return view('workers.breeding_spots', compact('menu', 'wards'));
  }

  public function breeding_spots_list(Request $request)
  {
    ## Read value
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); 

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column'];
      $columnName = $columnName_arr[$columnIndex]['data']; 
      $columnSortOrder = $order_arr[0]['dir']; 
      $searchValue = $search_arr['value']; 

      $wards = !empty($request->get("ward")) ? [$request->get("ward")] : explode(',',Auth::guard('customer')->user()->ward_ids);
    // Total records
      $totalRecords = DB::table('pick')
          ->where('pick.q1','=',"Yes")
          ->whereIn('pick.ward',$wards)
          ->join('customers','pick.cust_id','=','customers.id','left')
          ->select('pick.*','customers.username','count(*) as allcount')
          ->count();
      $totalRecordswithFilter = DB::table('pick')
          ->where('pick.q1','=',"Yes")
          ->whereIn('pick.ward',$wards)
          ->join('customers','pick.cust_id','=','customers.id','left')
          ->select('pick.*','customers.username','count(*) as allcount')
          ->where(function($q) use($searchValue) {
            $q->where('customers.username', 'like', '%' .$searchValue . '%');
            $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
            $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
            $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
            $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
          })
          ->count();

    // Fetch records
      $records = DB::table('pick')->orderBy($columnName,$columnSortOrder)
        ->join('customers','pick.cust_id','=','customers.id','left')
        ->where(function($q) use($searchValue) {
          $q->where('customers.username', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
        })
        ->where('pick.q1','=',"Yes")
        ->whereIn('pick.ward',$wards)
        ->select('pick.*','customers.username')
        ->skip($start)
        ->take($rowperpage)
        ->get();
        $data_arr = array();
    
      foreach($records as $key => $record){
        $id = $start+$key+1;
        $uid = $record->uid;
        $username = strtoupper($record->username);
        $spot = strtoupper($record->q1);
        if(!empty($record->image_data))
        $image = '<img src="'.asset('uploads/pick/' . $record->image_data).'" class="rounded-circle" width="80" height="80" alt="No image">';
        else        
        $image = '<img alt="Image not found">';
        $remark = $record->descp ?? '-';
        $date = date("d/m/Y", strtotime($record->created_at));
        $action = '<a href="'.route('executive.breeding-spot.show' ,$record->id).'" class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';
        if($record->source_reduction == "Done"){
          // $source_reduction = '<a class="text-decoration-none text-dark" href="#" role="button" data-bs-toggle="modal" data-bs-target="#sourcered'.$record->id.'">Done</a>
          //                     <div class="modal fade" id="sourcered'.$record->id.'" tabindex="-1" aria-labelledby="sourceredLabel" aria-hidden="true">
          //                     <div class="modal-dialog"> <div class="modal-content"> <div class="modal-body">
          //                     <div class="row"> <h6>Image</h6>';
          // if(!empty($record->source_reduction_img)) 
          //   $source_reduction .= '<img src="'.asset('uploads/pick/' . $record->source_reduction_img).'" class="img-thumbnail" width="180" height="180" alt="No image">';
          // else
          //   $source_reduction .= '<img alt="Image not found">';                                          
          // $source_reduction .= '</div></div></div></div></div>';
          $source_reduction = '<p>'.$record->source_reduction.'</p>';
        }
        else if($record->source_reduction == "Not Done")
          $source_reduction = '<p>'.$record->source_reduction.'</p>';
        else
          $source_reduction = '<p>-</p>';

        $data_arr[] = array(
            "id" => $id,
            "uid" => $uid,
            "username" => $username,
            "q1" => $spot,
            "image_data" => $image,
            "descp" => $remark,
            "created_at" => $date,
            'source_reduction'=>$source_reduction,
            "action" => $action,
        );
      }

      $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr
      );

      return response()->json($response); 
  }
}
