<?php

namespace App\Http\Controllers\AshaWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Hash, DB, File, Session;
use Carbon\Carbon;

class AuthController extends Controller
{
  use AuthenticatesUsers;

  protected $redirectTo = '/asha-worker/dashboard';

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
      $customer =  DB::table('customers')->whereIn('roles',[1,2,5,6,7,8,9,10])->where('phone', $request->input('phone'))->first();
      if($customer && $customer->status == 1){
        try{
        $otp = rand(100000, 999999);
        $is_otp = DB::table('login_otp')->where('phone', $request->input('phone'))->first();
        if($is_otp)
          DB::table('login_otp')->where('phone', $request->input('phone'))->update(['otp'=>$otp]);
        else
          DB::table('login_otp')->insert(['phone' => $request->phone, 'otp'=>$otp]);
          $message = "Hello ".$customer->username.", Your Prism-H OTP for Login is: ".$otp." This code expires in 5 minutes. If you didn't request this, please report to admin. Prism-H Team";
          $res = $this->sendOtpSMS($message, $customer->phone, env('SMS_LOGIN_OTP_TEMPLET'));
        return response()->json(['success'=>true, 'message'=>__('messages.OTP sent successfully'), 'sms'=>$res]);
        }catch(\Exception $e){
          // return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
          return response()->json(['success'=>false, 'message'=>__('messages.OTP service is not available now. Please login using your password')]);
        }
      }else if($customer && $customer->status == 0){
        return response()->json(['success'=>false, 'message'=>__('messages.Your mobile number is not approved')]);
      }else{
        return response()->json(['success'=>false, 'message'=>__("messages.user doesnot exist.Please register or enter correct number")]);
      }
    }
    if($request->type && $request->type == 'otp_login')
    return view('asha_worker.auth.login_otp');
    return view('asha_worker.auth.login');
  }

  public function login(Request $request)
  {
    \Session::forget('success');\Session::forget('error');
    $chkphone =  Customer::whereIn('roles',[1,2,5,6,7,8,9,10])->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();
    if(!empty($chkphone))
    {
      if($request->has('otp') && $request->otp && $chkphone->status == 1)
      {
        $check_otp = DB::table('login_otp')->where('phone', $request->phone)->first();
        if($check_otp->otp == $request->otp){
          Auth::guard('customer')->login($chkphone);
          DB::table('login_otp')->where('phone', $request->phone)->delete();
          $dat = Auth::guard('customer')->user();
          $request->session()->put('customers' , $dat);
          $request->session()->save();
          $updata['custid'] = Auth::guard('customer')->user()->id;
          $updata['login'] = date('Y-m-d H:i:s');
          $updata['ip'] = $request->ip();
          DB::table('customers_logs')->insert($updata);
          if(in_array($chkphone->roles, [5,6]))
            return redirect()->route('field-executive.dashboard');
          if($chkphone->roles == 2)
            return redirect()->route('spray_team.dashboard');
          else
            return redirect()->route('asha_worker.dashboard')->with('success',__('messages.your account  has been logged in successfully'));
        }
        else
          return redirect()->back()->with('error',__('messages.Incorrect OTP'));
      }
      if(Hash::check($request->input('password'),$chkphone->password) && $chkphone->status == 1)
      {
          $credentials = $request->only('phone', 'password');
          $credentials['email'] = $chkphone->email;
          if(Auth::guard('customer')->attempt($credentials))
          {
              $dat = Auth::guard('customer')->user();
              $request->session()->put('customers' , $dat);
              $request->session()->save();
              $updata['custid'] = Auth::guard('customer')->user()->id;
              $updata['login'] = date('Y-m-d H:i:s');
              $updata['ip'] = $request->ip();
              DB::table('customers_logs')->insert($updata);
              if(in_array($chkphone->roles, [5,6]))
                return redirect()->route('field-executive.dashboard');
              if($chkphone->roles == 2)
                return redirect()->route('spray_team.dashboard');
              else
                return redirect()->route('asha_worker.dashboard')->with('success',__('messages.your account  has been logged in successfully'));
          }
          else{
            \Session::put('error', __('messages.Invalid credentials'));
            return redirect()->route('asha_worker.login');
          }
      }
      else if($chkphone->status == 0){
        \Session::put('error', __('messages.Your mobile number is not approved'));
        return redirect()->route('asha_worker.login');
      }
      else{
        \Session::put('error', __('messages.Invalid credentials'));
        return redirect()->route('asha_worker.login');
      }
    }
    else{
      \Session::put('error', __('messages.This number is not registered'));
      return redirect()->route('asha_worker.login');
    }
  }

  protected function loggedOut(Request $request)
  {
    return redirect('/login');
  }

  public function showRegisterForm()
  {
    \Session::forget('success');\Session::forget('error');
    $roles = DB::table('roles')->whereIn('id',[1,7,8,9,10])->get();
    return view('asha_worker.auth.register', compact('roles'));  
  }

  public function validate_number(Request $request){
    $exist = DB::table('customers')->where('phone', $request->input('phone'))->first();
    if($exist)
    return response()->json(['success'=>true, 'message'=>__('messages.This number is already registered')]);
    return response()->json(['success'=>false]);
  }

  public function register(Request $request)
  {
    \Session::forget('success');\Session::forget('error');
    $chkexist = DB::table('customers')->where('phone', $request->input('phone'))->first();
    if(!empty($chkexist))
      return redirect()->route('asha_worker.register')->with('error', 'Mobile number already registered');
    else{
      $data = $request->only('phone','email','ward','roles');
      $data['username'] = $request->input('name');
      $data['password'] = Hash::make($request->password);
      $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
      $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
      $data['status'] = '0';
      if($request->hasFile('id_card') && $request->id_card){
        $file = $request->id_card;
        $extension = File::extension($file->getClientOriginalName());
        $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
        $file->move(public_path('uploads/id_cards/'), $filename);
        $data['id_card'] = '/public/uploads/id_cards/'.$filename;
      }
      // $result = DB::table('customers')->insert($data);
      $result = Customer::create($data);
      $id =  $result->id;//DB::getPdo()->lastInsertId();
      $reg_id = "BBMPMMS".$id;
      DB::table('customers')->where('id', $id)->update(['reg_id'=>$reg_id]);
      if($result)
        return redirect()->route('asha_worker.login')->with('success','Registration was successful');
      else
        return redirect()->back()->with('error', 'Invalid inputs you entered');
    }
  }

  public function forgotPassword()
  {
    \Session::forget('success');\Session::forget('error');
    return view('asha_worker.auth.forgot-password');  
  }

  public function send_forgot_otp(Request $request){
    \Session::forget('success');\Session::forget('error');
    $otp = $this->randomToken(4);
    $phone = $request->phone;
    DB::table('verification_otps')->where('phone',$request->phone)->delete();
    DB::table('verification_otps')->insert(['phone'=>$phone, 'otp'=>$otp, 'created_at'=>Carbon::now()->toDateTimeString(), 'updated_at'=>Carbon::now()->toDateTimeString()]);
    $customer = DB::table('customers')->where('phone',$phone)->first();
    if(!$customer){
      \Session::put('error', __('messages.This number is not registered'));
      return view('asha_worker.auth.forgot-password');
    }
    $message = "Hello ".$customer->username.", Your Prism-H OTP for changing your password is: ".$otp." This code expires in 5 minutes. If you didn't request this, please report to admin. Prism-H Team";
    $res = $this->sendOtpSMS($message, $customer->phone, env('SMS_FORGOT_TEMPLET'));
    $success = __('messages.OTP sent successfully');
    \Session::put('success', $success);
    return view('asha_worker.auth.confirm_otp', compact('phone','success'));
  }

  public function confirm_otp(Request $request)
  {
      \Session::forget('success');\Session::forget('error');
    $phone = $request->input('phone');      
    $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->first();
    if(!empty($chkphone)){
      $check_otp = DB::table('verification_otps')->where(['phone'=>$request->phone, 'otp'=>$request->otp])->first();
      if(!$check_otp){
        \Session::put('error', __('messages.Please enter correct OTP'));
        return view('asha_worker.auth.confirm_otp', compact('phone'));
      }
      $now = Carbon::now();
      $otp_time = Carbon::parse($check_otp->updated_at);
      if($now->diffInMinutes($otp_time) > 5){
        \Session::put('error', __('messages.Your OTP has expired'));
        return view('asha_worker.auth.forgot-password');
      }
      return view('asha_worker.auth.reset_password', compact('phone'));
    }
    else
      return redirect()->route('forgot-password')->with('error', 'You entered phone number not registered');
  }
  public function resetPassword(Request $request)
  {
    $data['password'] = Hash::make($request->password);
    $res = DB::table('customers')->where('phone', $request->input('phone'))->update($data);
    if(!empty($res)){
      DB::table('verification_otps')->where('phone',$request->phone)->delete();
      return redirect()->route('asha_worker.login')->with('success', __('messages.Password changed'));
    }
    else
      return redirect()->back()->with('error', 'Password is not updated, Please enter the new password');
  }

  private function randomToken($n)
  {
      $chareacters = '123456789';
      $str = '';
      for($i = 0; $i < $n; $i++){
          $index = rand(0, strlen($chareacters)-1);
          $str .= $chareacters[$index];
      }
      return $str;
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
  
  public function wards_list()
  {
    $result = DB::table('ward')->where('status', 1)->get();
    $response = $result;
    return response()->json($response); 
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
