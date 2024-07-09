<?php

namespace App\Http\Controllers\SprayTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, App;

class DashboardController extends Controller
{
  public function dashboard(){
    App::setLocale('en');
    session()->put('locale', 'en');
    $menu = 'dashboard';
    $total_sprayed = DB::table('dump')->where('cust_id', Auth::guard('customer')->id())->where('status', 1)->count();
    $today_sprayed = DB::table('dump')->where('cust_id', Auth::guard('customer')->id())->where('created_at','LIke', Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
    return view('spray_team.dashboard', compact('menu', 'total_sprayed', 'today_sprayed'));
  }

  public function index(){
    $menu = 'history';
    $pids =  DB::table('dump')->where('cust_id', Auth::guard('customer')->id())->pluck('pid');
    $histories =  DB::table('pick')->whereIn('id',$pids)->orderBy('id', 'desc')->get();
    return view('spray_team.history.list', compact('menu', 'histories'));
  }

  public function show($id){
    $menu = 'history';
    $history =  DB::table('pick')->where('id', $id)->first();
    $dump_details =  DB::table('dump')->where('pid', $history->id)->first();
    return view('spray_team.history.details', compact('menu', 'history', 'dump_details'));
  }
}
