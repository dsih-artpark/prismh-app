<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_zones = [];
      $user_divisions = [];
      if(Auth::user()->roles == 3){
        $zone_ids = explode(',',Auth::user()->zone_ids);
        $user_zones = DB::table('zone')->select('id','title')->whereIn('id', $zone_ids)->get();
        $user_divisions = DB::table('division')->select('id','name')->whereIn('zone_id', $zone_ids)->get();
      }else{
        $division_ids = explode(',',Auth::user()->division_ids);
        $user_divisions = DB::table('division')->select('id','name')->whereIn('id', $division_ids)->get();
      }
      return view('executive.report.index', compact('user_divisions', 'user_zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      ## Read value
        $start_date = '';
        $end_date = '';
        if($request->date_range){
          $start_date = date('Y-m-d', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[0])));
          $end_date = date('Y-m-', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[1])));
          $d = date('d', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[1])));
          $end_date = $end_date.(1+(int)$d);
        }
        $zone_id = $request->zone??'';
        $division_id = $request->division??'';

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

        $user_zones = [];
        $user_divisions = [];
        if(Auth::user()->roles == 3){
          $user_zones = explode(',',Auth::user()->zone_ids);
        }else{
          $user_divisions = explode(',',Auth::user()->division_ids);
        }

        $zones = $zone_id !='' ? [$zone_id] : $user_zones;
        if($zones AND !$division_id)
          $divisions = DB::table('division')->whereIn('zone_id', $zones)->pluck('id')->toArray();
        else
          $divisions = $division_id !='' ? [$division_id] : $user_divisions;
        $wards = DB::table('ward')->select('id', 'name')->whereIn('division_id', $divisions)->get();
        $divisions_string = implode("','", $divisions);
      // Total records
        $totalRecords = DB::table('ward')->select('id')->whereIn('division_id', $divisions)->count();
        $totalRecordswithFilter = DB::table('ward')->select('id', 'name')->whereIn('division_id', $divisions)->where('name', 'like', '%' .$searchValue . '%')->count();

      // Fetch records
      if($start_date AND $end_date)
        $records = DB::select("select ward.id, ward.name, ward.number,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1 and created_at >= '$start_date' and created_at <= '$end_date') as survey,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1 and q1 = 'Yes' and created_at >= '$start_date' and created_at <= '$end_date') as breeding_spot,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1 and q1 = 'Yes' and source_reduction = 'Done' and created_at >= '$start_date' and created_at <= '$end_date') as source_reduction
          from ward where division_id in ('".$divisions_string."') and (name like '%$searchValue%' or number like '%$searchValue%') order by $columnName $columnSortOrder limit $rowperpage offset $start ");
      else
        $records = DB::select("select ward.id, ward.name, ward.number,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1) as survey,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1 and q1 = 'Yes') as breeding_spot,
         (select count(*) from pick where pick.ward = ward.id and pick.status = 1 and q1 = 'Yes' and source_reduction = 'Done') as source_reduction
          from ward where division_id in ('".$divisions_string."') and (name like '%$searchValue%' or number like '%$searchValue%') order by $columnName $columnSortOrder limit $rowperpage offset $start ");
        $data_arr = array();
      
      foreach($records as $key => $record){
        $id = $start+$key+1;
        $data_arr[] = array(
          "id" => $id,
          "name" => $record->name,
          "number" => $record->number,
          "survey" => $record->survey,
          "breeding_spot" => $record->breeding_spot,
          "source_reduction"=> $record->source_reduction,
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
