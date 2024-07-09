<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Hash;

class DashboardController extends Controller
{
  
  private function filter_data($all_surveys = [], $f_select=['id'], $count = true, $f_ward = [], $f_q1 = '', $f_start_date='', $f_end_date='', $f_src_red='', $f_ids=[], $f_not_ids=[]){
    $result = [];
    $data = [];
    foreach ($all_surveys as $key => $survey) {
      $is_matched = true;
      if(!empty($f_q1)){
        if($survey->q1 != $f_q1){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_src_red)){
        if($survey->source_reduction != $f_src_red){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_ward)){
        if(!in_array($survey->ward, $f_ward)){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_ids)){
        if(!in_array($survey->id, $f_ids)){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_not_ids)){
        if(in_array($survey->id, $f_not_ids)){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_start_date)){
        if(!strtotime($survey->created_at) >= strtotime($f_start_date)){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if(!empty($f_end_date)){
        if(!strtotime($survey->created_at) <= strtotime($f_end_date)){
          $is_matched = false;
          unset($all_surveys[$key]);
          continue;
        }
      }
      if($is_matched){
        in_array('id', $f_select) ? $data['id'] = $survey->id : '';
        in_array('latit', $f_select) ? $data['latit'] = $survey->latit : '';
        in_array('q1', $f_select) ? $data['q1'] = $survey->q1 : '';
        in_array('ward', $f_select) ? $data['ward'] = $survey->ward : '';
        in_array('created_at', $f_select) ? $data['created_at'] = $survey->created_at : '';
        in_array('source_reduction', $f_select) ? $data['source_reduction'] = $survey->source_reduction : '';
        $result[] = (object)$data;
      }
    }
    if($count)
    return count($result);
    return $result;
  }

  public function dashboard_new(Request $request){
    $date = Carbon::now()->format('Y-m-d');
    $zones = DB::table('zone')->whereNotNull('boundry')->get();
    $wards = DB::table('ward')->pluck('id')->toArray();
    $_ward_ids = implode("','", $wards);
    $last_month = Carbon::now()->subDays(30)->format('Y-m-d');
    $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
    $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

    $all_surveys = DB::select("select id, latit, source_reduction, ward, q1, created_at from pick where ward in ('".$_ward_ids."') and status = 1");
    $house_servey = $this->filter_data($all_surveys, ['id'], true, $wards);
    $locations = $this->filter_data($all_surveys, ['latit', 'source_reduction'], false, $wards, 'Yes', $last_month);
    $weekly_servey = $this->filter_data($all_surveys, ['id'], true, $wards, '', $startOfWeek, $endOfWeek);
    $monthly_servey = $this->filter_data($all_surveys, ['id'], true, $wards, '', $startOfMonth, $endOfMonth);
    $ward_count =  count(DB::select("select ward from pick where ward in ('".$_ward_ids."') and status = 1 group by ward"));
    $total_breeding_spots = $this->filter_data($all_surveys, ['id'], true, $wards, 'Yes');
    $weekly_breeding_spots = $this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', $startOfWeek, $endOfWeek);
    $monthly_breeding_spots = $this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', $startOfMonth, $endOfMonth);

    $sprayed_ids = array_column(DB::select('select pid from dump'), 'pid');
    $source_reduction_cleared = $this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', '', '', 'Done', [], $sprayed_ids);
    $source_reduction_sprayed = $this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', '', '', 'Done', $sprayed_ids);
    $source_reduction_pending = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and (source_reduction != 'Done' or source_reduction is null)"));

    $pie_chart = [];
    foreach($zones as $key => $zone){
        $division_ids = DB::table('division')->where('zone_id', $zone->id)->pluck('id');
        $ward_ids = DB::table('ward')->whereIn('division_id', $division_ids)->pluck('id')->toArray();
        $pie_chart[$key]['zone'] = $zone->title;
        $pie_chart[$key]['breeding_spots'] = $this->filter_data($all_surveys, ['id'], true, $ward_ids, 'Yes');
        $pie_chart[$key]['source_reduction'] = $this->filter_data($all_surveys, ['id'], true, $ward_ids, 'Yes', '', '', 'Done');
    }  
    $line_chart = [];
    $j=0;
    for ($i=14; $i >=0; $i--) {
      $line_chart[$j]['date']=Carbon::now()->subDays($i)->format('d M');
      $day_start = Carbon::now()->subDays($i)->format('Y-m-d 00:00:00');
      $day_end = Carbon::now()->subDays($i)->format('Y-m-d 23:59:59');
      $line_chart[$j]['survey']=$this->filter_data($all_surveys, ['id'], true, $wards, '', $day_start, $day_end);
      $line_chart[$j]['breeding_spots']=$this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', $day_start, $day_end);
      $line_chart[$j]['source_reduction']=$this->filter_data($all_surveys, ['id'], true, $wards, 'Yes', $day_start, $day_end, 'Done');
      $j++;
    }

    $wards = DB::table('ward')->whereIn('id', $wards)->whereNotNull('boundry')->select('boundry','name')->get();
    $last_seven = Carbon::now()->subDays(7)->format('Y-m-d');
    $active_asha_ids = implode("','", array_unique(array_column(DB::select("select cust_id from pick where created_at >= '$last_seven'"), 'cust_id')));
    $inactive_asha = DB::select("select username, ward from customers where id not in ('".$active_asha_ids."') and roles = 1 and status = 1");
    return view('admin.dashboard', compact('wards','zones','locations','house_servey','total_breeding_spots', 'weekly_breeding_spots', 'monthly_breeding_spots','pie_chart','line_chart',
                                             'weekly_servey','monthly_servey','ward_count','source_reduction_cleared','source_reduction_sprayed','source_reduction_pending','inactive_asha'));
  }

  public function dashboard(Request $request){
    // dd(DB::select("select cust_id, COUNT(*) AS number from pick where ward = 4 group by cust_id"));
    $date = Carbon::now()->format('Y-m-d');
    $zones = DB::table('zone')->whereNotNull('boundry')->get();
    $wards = DB::table('ward')->pluck('id')->toArray();
    $_ward_ids = implode("','", $wards);
    $last_month = Carbon::now()->subDays(30)->format('Y-m-d');
    $locations = DB::select("select latit, source_reduction from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$last_month'");
    $house_servey =  count(DB::select("select latit, source_reduction from pick where ward in ('".$_ward_ids."') and status = 1"));
    $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
    $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
    $weekly_servey = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and created_at >= '$startOfWeek' and created_at <= '$endOfWeek'"));
    $monthly_servey = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and created_at >= '$startOfMonth' and created_at <= '$endOfMonth'"));
    $ward_count =  count(DB::select("select ward from pick where ward in ('".$_ward_ids."') and status = 1 group by ward"));
    $total_breeding_spots = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes'"));
    $weekly_breeding_spots = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$startOfWeek' and created_at <= '$endOfWeek'"));
    $monthly_breeding_spots = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$startOfMonth' and created_at <= '$endOfMonth'"));

    $sprayed_ids = implode("','", array_column(DB::select('select pid from dump'), 'pid'));
    $source_reduction_cleared = count(DB::select("select id from pick where id not in ('".$sprayed_ids."') and ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done'"));
    $source_reduction_sprayed = count(DB::select("select id from pick where id in ('".$sprayed_ids."') and ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done'"));
    $source_reduction_pending = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and (source_reduction != 'Done' or source_reduction is null)"));
    
    $wards = DB::table('ward')->whereIn('id', $wards)->whereNotNull('boundry')->select('boundry','name')->get();
    $pie_chart = [];;
    foreach($zones as $key => $zone){
        $division_ids = DB::table('division')->where('zone_id', $zone->id)->pluck('id');
        $ward_ids = DB::table('ward')->whereIn('division_id', $division_ids)->pluck('id')->toArray();
        $ward_ids = implode("','", $ward_ids);
        $pie_chart[$key]['zone'] = $zone->title;
        // $pie_chart[$key]['survey'] = count(DB::select("select id from pick where ward in ('".$ward_ids."') and status = 1"));
        $pie_chart[$key]['breeding_spots'] = count(DB::select("select id from pick where ward in ('".$ward_ids."') and status = 1 and q1 = 'Yes'"));
        $pie_chart[$key]['source_reduction'] = count(DB::select("select id from pick where ward in ('".$ward_ids."') and status = 1 and source_reduction = 'Done' and q1 = 'Yes'"));
    }  
    $line_chart = [];
    $j=0;
    for ($i=14; $i >=0; $i--) {
      $line_chart[$j]['date']=Carbon::now()->subDays($i)->format('d M');
      $day_start = Carbon::now()->subDays($i)->format('Y-m-d 00:00:00');
      $day_end = Carbon::now()->subDays($i)->format('Y-m-d 23:59:59');
      $line_chart[$j]['survey']=count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and created_at >= '$day_start' and created_at <= '$day_end'"));
      $line_chart[$j]['breeding_spots']=count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$day_start' and created_at <= '$day_end'"));
      $line_chart[$j]['source_reduction']=count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done' and created_at >= '$day_start' and created_at <= '$day_end'"));
      $j++;
    }

    $last_seven = Carbon::now()->subDays(7)->format('Y-m-d');
    $active_asha_ids = implode("','", array_unique(array_column(DB::select("select cust_id from pick where created_at >= '$last_seven'"), 'cust_id')));
    $inactive_asha = DB::select("select username, ward from customers where id not in ('".$active_asha_ids."') and roles = 1 and status = 1");
    return view('admin.dashboard', compact('wards','zones','locations','house_servey','total_breeding_spots', 'weekly_breeding_spots', 'monthly_breeding_spots','pie_chart','line_chart',
                                             'weekly_servey','monthly_servey','ward_count','source_reduction_cleared','source_reduction_sprayed','source_reduction_pending','inactive_asha'));
  }

  public function zone_data(Request $request){
    ## Read value
      $draw = $request->get('draw');
      $start_date = '';
      $end_date = '';
      if($request->date_range){
        $start_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[0])));
        $end_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[1])));
      }
    // Fetch records
      $data_arr = array();
      $zones = DB::table('zone')->whereNotNull('boundry')->get();
      foreach($zones as $key => $zone){
        $division_ids = DB::table('division')->where('zone_id', $zone->id)->pluck('id');
        $ward_ids = DB::table('ward')->whereIn('division_id', $division_ids)->pluck('id')->toArray();
        $_ward_ids = implode("','", $ward_ids);
        if($start_date AND $end_date){
          $data_arr[] = array(
            "id" => $zone->id,
            "zone" => $zone->title,
            "survey" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and created_at >= '$start_date' and created_at <= '$end_date'")),
            "spots" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$start_date' and created_at <= '$end_date'")),
            "reduction" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done' and created_at >= '$start_date' and created_at <= '$end_date'")),
          );
        }
        else{
          $data_arr[] = array(
            "id" => $zone->id,
            "zone" => $zone->title,
            "survey" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1")),
            "spots" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes'")),
            "reduction" => count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done'")),
          );
        }
      }

      $response = array(
        "draw" => intval($draw),
        "test" => $start_date.$end_date,
        "aaData" => $data_arr
      );

      return response()->json($response); 
  }

  public function report(Request $request){
    $start_date = '';
    $end_date = '';
    if($request->date_range){
      $start_date = date('Y-m-d', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[0])));
      $end_date = date('Y-m-d', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[1])));
    }
    $zone_id = $request->zone_id??'';
    $division_id = $request->division_id??'';
    $zones = $request->zone_id !='' ? [$request->zone_id] : DB::table('zone')->pluck('id')->toArray();
    if($zone_id AND !$division_id)
      $divisions = DB::table('division')->whereIn('zone_id', $zones)->pluck('id')->toArray();
    else
      $divisions = $division_id ? [$division_id] : DB::table('division')->whereIn('zone_id', $zones)->pluck('id')->toArray();
    $user_zones = DB::table('zone')->get();
    $user_divisions = DB::table('division')->select('id','name')->whereIn('zone_id', $user_zones->pluck('id'))->get();
    $wards = DB::table('ward')->select('id', 'name')->whereIn('division_id', $divisions)->get();
    $reports = [];
    foreach ($wards as $key => $ward) {
      $reports[$key]['sr'] = $key+1;
      $reports[$key]['ward'] = $ward->name;
      if($start_date AND $end_date){
        $reports[$key]['survey'] = DB::table('pick')->whereBetween('created_at', [$start_date, $end_date])->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['breeding_spot'] = DB::table('pick')->whereBetween('created_at', [$start_date, $end_date])->where('q1','=','Yes')->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['source_reduction'] = DB::table('pick')->whereBetween('created_at', [$start_date, $end_date])->where('q1','=','Yes')->whereIn('source_reduction', ['Done'])->where('ward', $ward->id)->where('status', 1)->count();
      }
      else{
        $reports[$key]['survey'] = count(DB::select("select id from pick where ward = '$ward->id' and status = 1"));
        $reports[$key]['breeding_spot'] = count(DB::select("select id from pick where ward = '$ward->id' and status = 1 and q1 = 'Yes'"));
        $reports[$key]['source_reduction'] = count(DB::select("select id from pick where ward = '$ward->id' and status = 1 and q1 = 'Yes' and source_reduction = 'Done'"));
      }
    }
    return view('admin.report.index', compact('reports', 'user_divisions', 'user_zones'));
  }

  public function get_divisions(Request $request){
    if($request->id)
      $divisions = DB::table('division')->where('zone_id', $request->id)->select('id', 'name')->get();
    else
      $divisions = DB::table('division')->select('id', 'name')->get();
    $html = '<option value="" selected>Select Division</option>';
    foreach($divisions as $division){
      $html .= '<option value="'.$division->id.'">'.$division->name.'</option>';
    }
    return response()->json(['success'=>true, 'html'=>$html]);
  }

  public function profile(){
    $user = Auth::guard('admin')->user();
    return view('admin.profile', compact('user'));
  }

  public function profile_update(Request $request){
    // dd(Auth::guard('admin')->user());
    $data = $request->except('_token', 'password');
    if($request->password)
    $data['password'] = Hash::make($request->password);
    Auth::guard('admin')->user()->update($data);
    return redirect()->back();
  }
  
  public function analysis()
  {
      $curr =  now()->format('m');
      $m = $curr;
      $currentMonthth = now()->format('Y');
      $daysInMonthth = \Carbon\Carbon::parse("$currentMonthth-$m")->daysInMonth; 
      $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      $res = $months[$m-1];
      $monthdetth = $res." Month";
      $currentYear = \Carbon\Carbon::now()->format('Y');
      $currentMonth = $m;
      $daysInMonth = \Carbon\Carbon::create($currentYear, $currentMonth)->daysInMonth;
      $reports = DB::table('ward')->where('status',1)->get();
      return view('admin.analysis',compact('reports','currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
  }

  public function analysis_filter($id)
  {
      $m = str_pad($id, 2, '0', STR_PAD_LEFT);
      $currentMonthth = now()->format('Y');
      $daysInMonthth = \Carbon\Carbon::parse("$currentMonthth-$m")->daysInMonth;
      $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      $res = $months[$m-1];
      $monthdetth = $res." Month";
      $currentYear = \Carbon\Carbon::now()->format('Y');
      $currentMonth = $m;
      $daysInMonth = \Carbon\Carbon::create($currentYear, $currentMonth)->daysInMonth;
      $reports = DB::table('ward')->where('status',1)->get();
      return view('admin.analysis',compact('reports', 'currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
  }
}
