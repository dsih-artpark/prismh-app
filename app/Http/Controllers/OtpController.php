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

// use Illuminate\Support\Facades\Auth;

use Nexmo\Laravel\Facade\Nexmo;

use App\Models\Customerotp;


class OtpController extends Controller
{
    public function verify($id){
        
        $details['custd'] = $id;
        
        return view('includes.verify', compact('details'));
    }
    public function form(){
        
        return view('includes.otplogin');
    }
    public function generate(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);
  
        /* Generate An OTP */
        // $userOtp = $this->generateOtp($request->phone);
        // $userOtp->sendSMS($request->phone);
$basic  = new \Nexmo\Client\Credentials\Basic('18a48e06', 'oYIV7id1bUk7XkfO');
        $client = new \Nexmo\Client($basic);

        $send = $client->message()->send([
        
 
        // $send = Nexmo::message()->send([
            'to' => '+91'.$request->phone,
            'from' => 'VBF OTP LOGIN',
            'text' => 'Dont share this api VBF-1234'
        ]);
        // dd($send);
        if($send){
            echo"success";die;
        }
        else{
            echo"error";die;
        }
 
        
  
        // return redirect()->route('otp.verification', ['id' => $userOtp->id])->with('success',  "OTP has been sent on Your Mobile Number."); 
    }
    //  public function generateOtp($mobile_no)
    // {
    //     $user = Customer::where('phone', $mobile_no)->first();
  
    //     /* User Does not Have Any Existing OTP */
    //     $userOtp = Customerotp::where('cust_id', $user->id)->latest()->first();
  
    //     $now = now();
  
    //     if($userOtp && $now->isBefore($userOtp->created_at)){
    //         return $userOtp;
    //     }
  
    //     /* Create a New OTP */
    //     return Customerotp::create([
    //         'cust_id' => $user->id,
    //         'otp' => rand(123456, 999999),
    //         'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
    //     ]);
    // }
    

}
