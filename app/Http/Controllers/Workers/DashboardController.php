<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, Hash, App;
use App\Models\Customer;

class DashboardController extends Controller
{
  public function dashboard(){
    App::setLocale('en');
    session()->put('locale', 'en');
    $menu = 'dashboard';
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $house_servey =  DB::table('pick')->whereIn('ward', $ward_ids)->where('status', 1)->count();
    $weekly_servey = DB::table('pick')->whereIn('ward', $ward_ids)->where('status', 1)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
    $monthly_servey = DB::table('pick')->whereIn('ward', $ward_ids)->where('status', 1)
                    ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->count();
    $ward_count =  count(DB::table('pick')->select('ward')->whereIn('ward', $ward_ids)->where('status', 1)->groupBy('ward')->get());
    $total_breeding_spots = DB::table('pick')->where('q1','=','Yes')->whereIn('ward', $ward_ids)->where('status', 1)->count();
    $weekly_breeding_spots = DB::table('pick')->where('q1','=','Yes')->whereIn('ward', $ward_ids)->where('status', 1)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $monthly_breeding_spots = DB::table('pick')->where('q1','=','Yes')->whereIn('ward', $ward_ids)->where('status', 1)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

    $_ward_ids = implode("','", $ward_ids);
    $sprayed_ids = implode("','", array_column(DB::select('select pid from dump'), 'pid'));
    $source_reduction_cleared = count(DB::select("select id from pick where id not in ('".$sprayed_ids."') and ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done'"));
    $source_reduction_sprayed = count(DB::select("select id from pick where id in ('".$sprayed_ids."') and ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and source_reduction = 'Done'"));
    $source_reduction_pending = count(DB::select("select id from pick where ward in ('".$_ward_ids."') and status = 1 and q1 = 'Yes' and (source_reduction != 'Done' or source_reduction is null)"));
    return view('workers.dashboard', compact('menu','house_servey','total_breeding_spots', 'weekly_breeding_spots', 'monthly_breeding_spots','weekly_servey',
                                             'monthly_servey','ward_count','source_reduction_cleared','source_reduction_sprayed','source_reduction_pending'));
  }

  public function manage(){
    $menu = 'manage';
    return view('workers.manage', compact('menu'));
  }

  public function asha_workers(){
    $menu = 'manage';
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $asha_workers =  Customer::whereIn('ward', $ward_ids)->whereIn('roles',[1,7,8,9,10])->where(['status'=>1])->orderBy('id', 'desc')->get();
    return view('workers.asha_workers', compact('menu','asha_workers'));
  }

  public function report(Request $request){
    $menu = 'manage';
    $start_date = '';
    $end_date = '';
    if($request->date_range){
      $start_date = date('Y-m-d 00:00:00', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[0])));
      $end_date = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-',explode(' - ', $request->date_range)[1])));
    }
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $wards = DB::table('ward')->select('id', 'name','number')->whereIn('id', $ward_ids)->get();
    $reports = [];
    foreach ($wards as $key => $ward) {
      $reports[$key]['sr'] = $key+1;
      $reports[$key]['ward'] = $ward->name.' - '.$ward->number;
      if($start_date AND $end_date){
        $reports[$key]['survey'] = DB::table('pick')->where('created_at','>=', $start_date)->where('created_at','<=', $end_date)->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['breeding_spot'] = DB::table('pick')->where('created_at','>=', $start_date)->where('created_at','<=', $end_date)->where('q1','=','Yes')->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['source_reduction'] = DB::table('pick')->where('created_at','>=', $start_date)->where('created_at','<=', $end_date)->where('q1','=','Yes')->whereIn('source_reduction', ['Done'])->where('ward', $ward->id)->where('status', 1)->count();
      }
      else{
        $reports[$key]['survey'] = DB::table('pick')->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['breeding_spot'] = DB::table('pick')->where('q1','=','Yes')->where('ward', $ward->id)->where('status', 1)->count();
        $reports[$key]['source_reduction'] = DB::table('pick')->where('q1','=','Yes')->whereIn('source_reduction', ['Done'])->where('ward', $ward->id)->where('status', 1)->count();
      }
    }
    return view('workers.report', compact('menu', 'reports'));
  }

  public function history(){
    $menu = 'history';
    $ward_ids = explode(',',Auth::guard('customer')->user()->ward_ids);
    $surveys =  DB::table('pick')->whereIn('ward', $ward_ids)->where('q1','=',"Yes")->where('status', 1)->orderBy('id', 'desc')->paginate(10);
    return view('workers.history', compact('menu','surveys'));
  }

  public function history_details($id){
    $menu = 'history';
    $survey =  DB::table('pick')->where('id', $id)->first();
    return view('workers.survey.details', compact('menu','survey'));
  }
}
