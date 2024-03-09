<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;


class Report extends Controller
{
   
    public function vibhag()
    {
        $date = Carbon::now()->format('Y-m-d');
        $reports['reg'] = DB::table('customers')->where('status', 1)->paginate(10);
        $reports['count'] = DB::table('customers')->where('status', 1)->count();
        $reports['today'] = DB::table('customers')->where('created_at','like', $date.'%')->count();
        $reports['vibhag'] = DB::table('jm_blr_rs_vibhag')->orderBy('name','asc')->get();

        return view('report.vibhag', compact('reports'));
    }

}
