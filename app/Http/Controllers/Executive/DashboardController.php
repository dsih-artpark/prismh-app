<?php

namespace App\Http\Controllers\Executive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Hash;

class DashboardController extends Controller
{
  public function dashboard(){
    $date = Carbon::now()->format('Y-m-d');
    if(Auth::user()->roles == 3){
      $zone = explode(',',Auth::user()->zone_ids);
      $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      $zone_ids = $zone;
    }else if(Auth::user()->roles == 4){
      $divisions = explode(',',Auth::user()->division_ids);
      $zone_ids = DB::table('division')->where('id', $divisions[0])->pluck('zone_id');
    }
    $wards = DB::table('ward')->whereIn('division_id', $divisions)->pluck('id')->toArray();
    $_ward_ids = implode("','", $wards);
    $last_month = Carbon::now()->subDays(30)->format('Y-m-d');
    $locations = DB::select("select latit, source_reduction from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and created_at >= '$last_month'");
    $zones = DB::table('zone')->whereIn('id',$zone_ids)->get();
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

    $wards = DB::table('ward')->whereIn('id', $wards)->select('boundry','name')->get();
    return view('executive.dashboard', compact('wards','zones','locations','house_servey','total_breeding_spots', 'weekly_breeding_spots', 'monthly_breeding_spots',
                                               'weekly_servey','monthly_servey','ward_count','source_reduction_cleared','source_reduction_sprayed','source_reduction_pending'));
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
    $user = Auth::user();
    return view('executive.profile', compact('user'));
  }

  public function profile_update(Request $request){
    $data = $request->except('_token', 'password');
    if($request->password)
    $data['password'] = Hash::make($request->password);
    Auth::user()->update($data);
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
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->where('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $reports = DB::table('ward')->whereIn('division_id', $divisions)->where('status',1)->get();
      return view('executive.analysis',compact('reports','currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
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
      if(Auth::user()->roles == 3){
        $zone = explode(',',Auth::user()->zone_ids);
        $divisions = DB::table('division')->whereIn('zone_id', $zone)->pluck('id')->toArray();
      }else if(Auth::user()->roles == 4){
        $divisions = explode(',',Auth::user()->division_ids);
      }
      $reports = DB::table('ward')->whereIn('division_id', $divisions)->where('status',1)->get();
      return view('executive.analysis',compact('reports', 'currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
  }
}
