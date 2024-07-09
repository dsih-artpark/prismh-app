<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Hash, DB;

class AuthController extends Controller
{
  use AuthenticatesUsers;

  protected $redirectTo = '/admin/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm(Request $request)
  {
    if($request->ajax()){
      $admin =  Admin::where('phone', $request->input('phone'))->first();
      if($admin && $admin->status == 1){
        try{
        $otp = rand(100000, 999999);
        $is_otp = DB::table('login_otp')->where('phone', $request->input('phone'))->first();
        if($is_otp)
          DB::table('login_otp')->where('phone', $request->input('phone'))->update(['otp'=>$otp]);
        else
          DB::table('login_otp')->insert(['phone' => $request->phone, 'otp'=>$otp]);
        $message = "Hello ".$admin->name.", Your Prism-H OTP for Login is: ".$otp." This code expires in 5 minutes. If you didn't request this, please report to admin. Prism-H Team";
        $res = $this->sendOtpSMS($message, $admin->phone, env('SMS_LOGIN_OTP_TEMPLET'));
        return response()->json(['success'=>true, 'message'=>'OTP Sent Successfully.']);
        }catch(\Exception $e){
          return response()->json(['success'=>false, 'message'=>'OTP service is not available now. Please login using your password.']);
        }
      }else if($admin && $admin->status == 0){
        return response()->json(['success'=>false, 'message'=>'Your account has been deactivated.']);
      }else{
        return response()->json(['success'=>false, 'message'=>'User doesn\'t exist. Please register or enter correct number.']);
      }
    }
    if($request->has('type') AND $request->type == 'otp_login')
    return view('admin.otp_login');
    return view('admin.login');
  }

  public function login(Request $request)
  {
    if($request->has('type') AND $request->type == 'otp_login'){
      $check_otp = DB::table('login_otp')->where('phone', $request->phone)->first();
      if($check_otp->otp == $request->otp){
        $admin = Admin::where('phone', $request->phone)->first();
        Auth::guard('admin')->login($admin);
        DB::table('login_otp')->where('phone', $request->phone)->delete();
        return redirect()->route('admin.dashboard');
      }
      else
        return redirect()->back()->withInput($request->input())->with('error','Incorrect OTP');
    }else{
      $check = Admin::where('email', $request->email)->first();
      if(!$check)
        return redirect()->back()->withInput($request->input())->withErrors(['email' => 'Please enter a valid email.']);
      else if($check->status!=1){
        return redirect()->back()->withInput($request->input())->withErrors(['email' => 'Your Account has been Deactivated.']);
      }
      if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        if ($request->hasSession()) {
          $request->session()->put('auth.password_confirmed_at', time());
        }
        return $this->sendLoginResponse($request);
      }
      return redirect()->back()->withInput($request->input())->withErrors(['password' => 'Please enter correct password.']);
    }
  }

  protected function authenticated(Request $request, $user)
  {
    return redirect('/admin/dashboard');
  }

  protected function loggedOut(Request $request)
  {
    return redirect('/admin/login');
  }

  private function send_mail($to, $content, $subject){
    try{
      $postfields = '{
                      "personalizations": [{
                        "to": [{
                          "email": "'.$to.'"
                        }]
                      }],
                      "from": {
                        "email": "info@mcwaretechnologies.com"
                      },
                      "subject": "'.$subject.'",
                      "content": [{
                        "type": "text/plain", 
                        "value": "'.$content.'"
                      }]
                    }';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
          'Authorization: Bearer '.env('SENDGRID_API_TOKEN'),
          'Content-Type: application/json',
      ]);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);  
      $response = curl_exec($ch);  
      curl_close($ch);
      return $response;
    }catch(\Exception $e){

    }
  }

  private function sendOtpSMS($message,$mobileno,$template_id){
    $key=hash('sha512',trim(env('SMS_USERNAME')).trim(env('SMS_SENDER_ID')).trim($message).trim(env('SMS_SECURE_KEY')));
    $data=array(
      "username"=> trim(env('SMS_USERNAME')),
      "password"=> trim(sha1(trim(env('SMS_PASSWORD')))),
      "senderid"=> trim(env('SMS_SENDER_ID')),
      "content"=> trim($message),
      "smsservicetype"=>"singlemsg",
      "mobileno"=>trim($mobileno),
      "key"=> trim($key),
      "templateid"=> trim($template_id)
      );
      return $res = $this->post_to_url(env('SMS_URL'),$data); 
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
      return $result;
  }
}
