<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ReportController extends Controller
{
    
    public function managereportinspectiondatewise($id)
    {
         $m = str_pad($id, 2, '0', STR_PAD_LEFT);
         $currentMonthth = now()->format('Y');
         $daysInMonthth = \Carbon\Carbon::parse("$currentMonthth-$m")->daysInMonth;
         
        if($m == 1)
        {
            $res = "January";
        }
        else if($m == 2)
        {
            $res = "February";
        }
        else if($m == 3)
        {
            $res = "March";
        }
        else if($m == 4)
        {
            $res = "April";
        }
        else if($m == 5)
        {
            $res = "May";
        }
        else if($m == 6)
        {
            $res = "June";
        }
        else if($m == 7)
        {
            $res = "July";
        }
        else if($m == 8)
        {
            $res = "August";
        }
        else if($m == 9)
        {
            $res = "September";
        }
        else if($m == 10)
        {
            $res = "October";
        }
        else if($m == 11)
        {
            $res = "November";
        }
        else{
            $res = "December";
        }
        
        $monthdetth = $res." Month";
        
        $currentYear = \Carbon\Carbon::now()->format('Y');
        $currentMonth = $m;
        $daysInMonth = \Carbon\Carbon::create($currentYear, $currentMonth)->daysInMonth;

         $reports = DB::table('ward')->where('status',1)->get();
        
        return view('admin.addreport1',compact('reports', 'currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
    }
    public function managereportinspection()
    {
        $curr =  now()->format('m');
        $m = $curr;
        $currentMonthth = now()->format('Y');
        $daysInMonthth = \Carbon\Carbon::parse("$currentMonthth-$m")->daysInMonth; 
        
        if($m == 1)
        {
            $res = "January";
        }
        else if($m == 2)
        {
            $res = "February";
        }
        else if($m == 3)
        {
            $res = "March";
        }
        else if($m == 4)
        {
            $res = "April";
        }
        else if($m == 5)
        {
            $res = "May";
        }
        else if($m == 6)
        {
            $res = "June";
        }
        else if($m == 7)
        {
            $res = "July";
        }
        else if($m == 8)
        {
            $res = "August";
        }
        else if($m == 9)
        {
            $res = "September";
        }
        else if($m == 10)
        {
            $res = "October";
        }
        else if($m == 11)
        {
            $res = "November";
        }
        else{
            $res = "December";
        }
        
        $monthdetth = $res." Month";
        
         $currentYear = \Carbon\Carbon::now()->format('Y');
         $currentMonth = $m;
         $daysInMonth = \Carbon\Carbon::create($currentYear, $currentMonth)->daysInMonth;
         
         
        // $reports = DB::table('pick')->where('status',1)->get();
         $reports = DB::table('ward')->where('status',1)->get();
        
      
        return view('admin.addreport1',compact('reports','currentMonthth', 'daysInMonthth', 'monthdetth', 'currentYear', 'currentMonth', 'daysInMonth'));
    }
    
     
}