<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

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

// use App\Models\Customer;

use Twilio\Rest\Client;

use Otp;

use Msg91;

use Craftsys\Msg91\SMS\SMSService;

use Craftsys\Msg91\Client as Vbf;

// use Ichtrojan\Otp\Facades\Otp;

use GuzzleHttp\Client as Guzle;

use Response;

use Illuminate\Support\Facades\Http;

class otpC extends Controller
{
    public function passtest(){
        
        $dat = DB::table('customers')->where('id', '179')->first();
        // $password = 'fariz9633';
        // Hash::check($password, $dat->password);
        // dd(Hash::needsRehash($dat->password, ['rounds' => 12]))
        // dd(Hash::needsRehash($password, $dat->password));
        // dd(Hash::needsRehash($dat->password));
        
        echo Hash::needsRehash($dat->password, ['rounds' => 12]);
        if(Hash::needsRehash($dat->password, ['rounds' => 12])){
            $newHashedPassword = Hash::make($dat->password);
            
        }
    }
    public function generate(Request $request)
    {
        $user =  DB::table('customers')->where('phone', $request->phone)->first();
        
        if(empty($user)){
            
        $otp = mt_rand(100000, 999999);
        $client = new Guzle();
        
        $workingKey = 'Ab03e3e01101171ea663244197610958f';
        $sender = 'VBFSMS';
        $to = $request->phone;
        $message = 'OTP for registration on V Biz is '.$otp.' VBF';
        $templateid = '1207164536015285287';
        
        
        $url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
        $params = [
            'query' => [
                'workingkey' => $workingKey,
                'sender' => $sender,
                'to' => $to,
                'message' => $message,
                'template id' => $templateid
            ]
        ];
        $response = $client->get($url, $params);
        
        // $content = $response->getBody()->getContents();
        
        $status_code = $response->getStatusCode();
        if($status_code == '200'){
            
            //check otp pending
            // DB::table('customer_otp')->where('cust_id', $user->id)->delete();
            
            $upd['cust_id'] = $request->phone;
            $upd['otp'] = $otp;
            $upd['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            $userOtp = DB::table('customer_otp')->insertGetId($upd);
            
            return redirect()->route('otp.verify', ['id' => encrypt($userOtp)]); 
            
            // return redirect()->route('otp.verify')->with('success', 'OTP Sended successfully.');
            
        }
            
        }
        else{
            
            session()->flash('error', 'Mobile number already registered');
            return redirect()->back()->with('error', 'Mobile number already registered');
        }
        
        
    }
     public function form(){
        //  echo"wel";
        //  echo $error = Session::get('error');die;
        // if(Session::has('error')){
        // echo $successMessage = Session::get('error');
        // die;
        // }
        return view('includes.otplogin');
    }
       public function api(Request $request)
    {
        // echo"wel";die;
        $client = new Guzle();

        $workingKey = 'Ab03e3e01101171ea663244197610958f';
        $sender = 'VBFSMS';
        $to = $request->phone;
        $message = $request->input('message');
        $templateid = '1207164536015285287';

       
        $client = new Guzle();
$url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
$params = [
    'workingkey' => $workingKey,
    'sender' => $sender,
    'to' => $to,
    'message' => $message,
    'template id' => $templateid,
];

$headers = [
    // 'Content-Type' => 'application/json',
    // 'Authorization' => 'Bearer ' . $token,
    'Accept' => 'text/html; charset=UTF-8',
];



try {
    
    $response = $client->request('GET', $url, [
        'query' => $params,
        'headers' => $headers,
    ]);
dd($response);
    // Get the response body
    $responseData = $response->getBody()->getContents();
// dd($responseData);
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo "error";die;
}






    }
     
public function verify($id){
        
        $details['id'] = decrypt($id);
        
        return view('includes.verify', compact('details'));
    }
public function verifyOtp(Request $request)
{
    
    $code = $request->otp;
    $id = $request->id;
    
    $result = DB::table('customer_otp')->where('id', $id)->where('otp', $code)->first();
    
    
    
    
    if(!empty($result)) {
        
        return redirect()->route('register', ['id' => encrypt($result->cust_id)]);
        
        $dat = DB::table('customers')->where('id', $result->cust_id)->first();
        
        // dd(Hash::needsRehash($dat->password));
        $credentials['phone'] = $dat->phone;
        $credentials['password'] =  $dat->password;
        // dd($credentials);
            if(Auth::guard('customer')->attempt($credentials))
            {
        
                $request->session()->put('customers' , $dat);
                $request->session()->save();
                
                //customer logs
                $updata['custid'] = $dat->id;
                $updata['login'] = date('Y-m-d H:i:s');
                $updata['ip'] = $request->ip();
                DB::table('customers_logs')->insert($updata);
                
                return redirect()->route('login.dashboard')->with('success', 'OTP verified successfully.');
            }
            else
            {
                return redirect()->route('login.dashboard')->with('success', 'OTP verified successfully, Please Login');
            }
            
    } else {
        
        return redirect()->route('otp.verify')->with('error', 'Invalid OTP');
    }
}


}
