<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB;

class LarvaSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('executive.larva_survey.index');
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
      
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $wards = DB::table('ward')->whereIn('division_id', $divisions)->pluck('id')->toArray();
      // Total records
      $totalRecords = DB::table('pick')
                  ->whereIn('pick.ward',$wards)
                  ->join('customers','pick.cust_id','=','customers.id','left')
                  ->select('pick.*','customers.username','count(*) as allcount')
                  ->count();
      $totalRecordswithFilter = DB::table('pick')
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
        $date = date("Y-m-d", strtotime($record->created_at));
        $action = '<a href="'.route('executive.larva-survey.show' ,$record->id).'" class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';
        $latlng = explode(',',$record->latit);
        $ward = DB::table('ward')->whereId($record->ward)->first();
        if($latlng[0] >= $ward->x_min && $latlng[0] <= $ward->x_max && $latlng[1] >= $ward->y_min && $latlng[1] <= $ward->y_max)
          $within_ward = '<span class="badge badge-success">Yes</span>';
        else
          $within_ward = '<span class="badge badge-danger">No</span>';

        $data_arr[] = array(
            "id" => $id,
            "uid" => $uid,
            "username" => $username,
            "q1" => $spot,
            "image_data" => $image,
            "within_ward" => $within_ward,
            "descp" => $remark,
            "created_at" => $date,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data = DB::table('pick')
                ->select('pick.*','customers.username','customers.roles','ward.name as wardname')
                ->join('customers','pick.cust_id','=','customers.id','left')
                ->join('ward','pick.ward','=','ward.id','left')
                ->where('pick.id',$id)->first();
      return view('executive.larva_survey.show', compact('data'));
    }
}
