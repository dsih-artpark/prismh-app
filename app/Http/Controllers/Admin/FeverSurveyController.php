<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB;

class FeverSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.fever_survey.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $wards = DB::table('ward')->pluck('id')->toArray();
      
      // Total records
        $totalRecords = DB::table('survey_patients')
        ->select('survey_patients.*','customers.username')
        ->join('customers','survey_patients.cust_id','=','customers.id','left')
        ->whereIn('customers.ward', $wards)
        ->count();
        $totalRecordswithFilter = DB::table('survey_patients')
        ->select('survey_patients.*','customers.username')
        ->join('customers','survey_patients.cust_id','=','customers.id','left')
        ->whereIn('customers.ward', $wards)
        ->where(function($q) use($searchValue) {
          $q->where('customers.username', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.name', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.phone', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.latit', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.created_at', 'like', '%' .$searchValue . '%');
        })
        ->count();

      // Fetch records
        $records = DB::table('survey_patients')->orderBy($columnName,$columnSortOrder)
              ->join('customers','survey_patients.cust_id','=','customers.id','left')
              // ->whereIn('customers.ward', $wards)
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.name', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.phone', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.latit', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.created_at', 'like', '%' .$searchValue . '%');
              })
              ->select('survey_patients.*','customers.username','customers.ward')
              ->skip($start)
              ->take($rowperpage)
              ->get();

        $data_arr = array();

      foreach($records as $key => $record){
        $id = $start+$key+1;
        $username = ucfirst($record->username);//.' -- '.$record->ward;
        $name = ucfirst($record->name);
        $phone = $record->phone;
        $latit = $record->latit;
        $created_at = date("Y-m-d", strtotime($record->created_at));        
        $action = '<a href="'.route('admin.fever-survey.show' , $record->id).'"  class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';

        $data_arr[] = array(
            "id" => $id,
            "username" => $username,
            "name" => @convert_uudecode($name) ? convert_uudecode($name) :  $name,
            "phone" => @convert_uudecode($phone) ? convert_uudecode($phone) : $phone,
            "latit" => @convert_uudecode($latit) ? convert_uudecode($latit) : $latit,
            "created_at" => $created_at,
            "action" => $action,
        );
      }

      $response = array(
        'wards'=>$wards,
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr,
      );

      return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data = DB::table('survey_patients')
      ->select('survey_patients.*','customers.username','customers.roles')
      ->join('customers','survey_patients.cust_id','=','customers.id','left')
      ->where('survey_patients.id',$id)->first();
      return view('admin.fever_survey.show', compact('data'));
    }
}
