<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, DB, Auth, App, Http;
use GuzzleHttp\Client as Guzle;

class DashboardController extends Controller
{
  public function dashboard(){
    $menu = 'dashboard';
    $total_survey = DB::table('pick')->where('cust_id', Auth::guard('customer')->id())->where('status', 1)->count();
    $today_survey = DB::table('pick')->where('cust_id', Auth::guard('customer')->id())->where('created_at','LIke', Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
    return view('asha_worker.dashboard', compact('menu', 'total_survey', 'today_survey'));
  }
  public function app_locale(Request $request){
    App::setLocale($request->lang);
    session()->put('locale', $request->lang);
    session()->put('langpop', 'hide');
    return redirect()->back();
  }
  public function sms(Request $request){
    // $username = env('SMS_USERNAME');
    // $encryp_password = sha1(trim(env('SMS_PASSWORD')));
    // $senderid = env('SMS_SENDER_ID');
    // $message = "Hello Dheeraj, Your Prism-H OTP for changing your password is: 989898 This code expires in 5 minutes. If you didn't request this, please report to admin. Prism-H Team";
    // $mobileno = '8123505532';
    // $deptSecureKey = env('SMS_SECURE_KEY');
    // $templateid = env('SMS_FORGOT_TEMPLET');
    // $res = $this->sendOtpSMS($username,$encryp_password,$senderid,$message,$mobileno,$deptSecureKey,$templateid);
  }

  private function sendOtpSMS($username,$encryp_password,$senderid,$message,$mobileno,$deptSecureKey,$templateid){
    $key=hash('sha512',trim($username).trim($senderid).trim($message).trim($deptSecureKey));
    $data=array(
      "username"=> trim($username),
      "password"=> trim($encryp_password),
      "senderid"=> trim($senderid),
      "content"=> trim($message),
      "smsservicetype"=>"singlemsg",
      "mobileno"=>trim($mobileno),
      "key"=> trim($key),
      "templateid"=> trim($templateid)
      );
      $res = $this->post_to_url(env('SMS_URL'),$data); 
  }

  private function post_to_url($url,$data) {
    $fields='';
    foreach($data as $key => $value) {
      $fields.=$key.'='. urlencode($value) .'&';
    }
      rtrim($fields,'&');
      $post= curl_init();
      curl_setopt($post, CURLOPT_SSLVERSION, 6);
      curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($post, CURLOPT_URL, $url);
      curl_setopt($post, CURLOPT_POST, count($data));
      curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
      curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
      $result= curl_exec($post);    
      curl_close($post);
      dd($result);
      return $result;
  }

  public function test(){}
}
