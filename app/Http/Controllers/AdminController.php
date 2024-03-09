<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Admin;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\Crypt;


class AdminController extends Controller
{
    
    public function getLogin()
    {
         return view('admin.auth.login');
    }
    
    public function postLogin(Request $request)
    {
        
       $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
       $chkemail =  DB::table('pwa_admin')->where('email', $request->input('email'))->where('password', md5( $request->input('password')))->first();
       

    if(!empty($chkemail))
    {
echo "checked";
        
             $credentials = $request->only('email', 'password');
             dd(Auth::guard('admin')->attempt($credentials));
            if(Auth::guard('admin')->attempt($credentials))
            {
                $dat = Auth::guard('admin')->user();
                $request->session()->put('admin' , $dat);
                $request->session()->save();
                
                return redirect()->route('admindashboard')->with('success','Your account has been logged in successfully!');
            }
            else
            {
                return redirect()->route('adminlogin');
            } 
       
    }
    else
    {
        return redirect()->route('adminLogin')->with('error','Email is not valid'); 
    }
        
    }

}
