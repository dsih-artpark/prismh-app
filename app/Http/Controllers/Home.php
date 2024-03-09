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

use Illuminate\Support\Str;

use GuzzleHttp\Client as Guzle;

use Carbon\Carbon;

use Response, File;

use Illuminate\Support\Facades\Http;

use QrCode;

use Illuminate\Support\Facades\Storage;


class Home extends Controller
{
    public function loginsourcereductionstore(Request $request, $id)
    {
         if(Auth::guard('customer')->check())
        {
            $nme = \Carbon\Carbon::now()->format('YmdHis');
         $imageData = $request->input('image_data');
        $imageName = $nme.'.png'; // Provide a desired name for the uploaded image
        if(!empty($imageData)){
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);
        // dd($imageData);
        
        // Save the image to the desired location
        file_put_contents(public_path('uploads/pick/' . $imageName), $imageData);
        
        $data['source_reduction_img'] = $imageName;
        }
        
        
        $data['source_reduction'] = $request->input('phone');
        // dd($data);
       
        $result =  DB::table('pick')->where('id', $id)->update($data);
        // dd($result);
        if(!empty($result))
        {
            return redirect()->route('login.dump.list')->with('success', 'Added successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'Something wrong & invalid');
        }
        
        }
        else{
            return redirect()->route('login');
        }
    
    }
    public function loginsourcereduction($id)
    {
        if(Auth::guard('customer')->check())
        {
            if($id)
            {
                return view('includes.sourcereduction', compact('id')); 
            }
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginsurveypatient()
    {
        if(Auth::guard('customer')->check())
        {
            $patients =  DB::table('survey_patients')->where('cust_id', Auth::guard('customer')->user()->id)->get();
            return view('includes.surveypatients',compact('patients')); 
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function surveypatientstore(Request $request)
    {
        if(Auth::guard('customer')->check())
        {
             $data['cust_id'] = Auth::guard('customer')->user()->id;
        $data['latit'] = $request->input('latit');
        $data['name'] = $request->input('name');
        $data['phone'] = $request->input('phone');
        $data['created_at'] = date('Y-m-d H:i:s');
       
        $result =  DB::table('survey_patients')->insert($data);

        if(!empty($result))
        {
            return redirect()->route('login.dashboard')->with('success', 'Form submitted successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Something wrong & invalid');
        }
        }
        else{
            return redirect()->route('login');
        }
    
    }
    
    public function datas()
    {
         $upid = Auth::guard('customer')->user()->id;
            $pick =  DB::table('pick')->where('cust_id', $upid)->where('created_at','LIke', \Carbon\Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
            $dump =  DB::table('dump')->where('cust_id', $upid)->where('created_at','LIke', \Carbon\Carbon::today()->format('Y-m-d').'%')->where('status', 1)->count();
    //   echo  $res = $pick + $dump;die;
       
    }
    public function loginbreedingspotlist()
    {
        if(Auth::guard('customer')->check())
        {
             $upid = Auth::guard('customer')->user()->id;
             $data =  DB::table('pick')->where('cust_id', $upid)->where('q1','=',"Yes")->where('status', 1)->orderBy('id', 'desc')->get();
            return view('includes.listdump', compact('data')); 
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginsurveylist()
    {
        if(Auth::guard('customer')->check())
        {
             $upid = Auth::guard('customer')->user()->id;
             $data =  DB::table('pick')->where('cust_id', $upid)->where('status', 1)->orderBy('id', 'desc')->get();
            return view('includes.listdump', compact('data')); 
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function historydetails($id)
    {
        if(Auth::guard('customer')->check())
        {
        $upid = Auth::guard('customer')->user()->id;
        $datadetails =  DB::table('pick')->where('cust_id', $upid)->where('id', $id)->first();
          return view('includes.historydetails', compact('datadetails')); 
        }
        else{
            return redirect()->route('login');
        }
        
    }
    public function loginhistory()
    {
        if(Auth::guard('customer')->check())
        {
             $upid = Auth::guard('customer')->user()->id;
        
             $data =  DB::table('pick')->where('cust_id', $upid)->where('status', 1)->get();
            return view('includes.history', compact('data')); 
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function dumpstore(Request $request)
    {
         if(Auth::guard('customer')->check())
        {
        $nme = \Carbon\Carbon::now()->format('YmdHis');
        $imageData = $request->input('image_data');
        $imageName = $nme.'.png'; // Provide a desired name for the uploaded image
        if(!empty($imageData)){
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);
        // dd($imageData);
        
        // Save the image to the desired location
        file_put_contents(public_path('uploads/dump/' . $imageName), $imageData);
        
        $data['image_data'] = $imageName;
        }
        $data['pid'] = $request->input('pid')? $request->input('pid') : '';
        $data['zone'] = $request->input('zone');
        $data['division'] = $request->input('division');
        $data['ward'] = $request->input('ward');
        $data['latit'] = $request->input('latit');
        $data['descp'] = $request->input('descp');
        $data['dstatus'] = $request->input('dstatus');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        // $uid = Str::random(4, '1234567890');
        // $data['uid'] = "BBMP".$uid;
        $data['uid'] = Str::uuid();
        $data['cust_id'] = Auth::guard('customer')->id();
       
        $result =  DB::table('dump')->insert($data);
        $did = DB::getPdo()->lastInsertId();
        if(!empty($result))
        {
            return redirect()->route('login.history')->with('success', 'Added successfully!');
        }
        else
        {
            return redirect()->route('login.dump')->with('error', 'Something wrong & invalid');
        }
        }
        else{
            return redirect()->route('login');
        }
    
    }
    public function pickstore(Request $request)
    {
         if(Auth::guard('customer')->check())
        {
            
        $nme = \Carbon\Carbon::now()->format('YmdHis');
        
        $images=array();
        if ($request->hasFile('image')) 
        {
            $files=$request->file('image');
                $i=1;
            foreach($files as $file)
            {
                // $image_name = date('Ymd-his').$i.'.'.$file->extension();
                $image_name = date('Ymdhis').$i.rand(10,99).'.'.$file->extension();
                $destinationPath = base_path('public/uploads/pick');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
                
            }
            $data['image_data'] = implode(",",$images);
            
        }
        
        $data['source_reduction'] = $request->input('source_reduction');
        $data['waste'] = $request->input('waste');
        $data['indoor'] = $request->input('indoor');
        $data['outdoor'] = $request->input('outdoor');
        $data['zone'] = $request->input('zone');
        $data['division'] = $request->input('division');
        $data['ward'] = Auth::guard('customer')->user()->ward;
        $data['latit'] = $request->input('latit');
        $data['descp'] = $request->input('descp');
        $data['q1'] = $request->input('q1');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        // $uid = Str::random(4, '1234567890');
        // $data['uid'] = "BBMP".$uid;
        $uid = $this->randomAlpha(2);
        $data['uid'] = "BBMP".date('Ymdhis').$uid;
        $data['cust_id'] = Auth::guard('customer')->id();
       
        $result =  DB::table('pick')->insert($data);
        $sid = DB::getPdo()->lastInsertId();
        $request->session()->put('sts' , $sid);
        if(!empty($result))
        {
            return redirect()->route('login.dump.list')->with('success', 'Added successfully!');
        }
        else
        {
            return redirect()->route('login.pick')->with('error', 'Something wrong & invalid');
        }
        
        }
        else{
            return redirect()->route('login');
        }
    
    }
    private function randomAlpha($n) {
      $chareacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      for($i = 0; $i < $n; $i++){
          $index = rand(0, strlen($chareacters)-1);
          $str .= $chareacters[$index];
      }
      return $str;
    }
     public function loginpick()
    {
        if(Auth::guard('customer')->check())
        {
            return view('includes.pick'); 
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function logindump()
    {
        if(Auth::guard('customer')->check())
        {
            
                return view('includes.dump'); 
            
             
        }
        else{
            return redirect()->route('login');
        }
    }
    public function logindum($id)
    {
        if(Auth::guard('customer')->check())
        {
            if($id){
                return view('includes.dump', compact('id')); 
            }
              
        }
        else{
            return redirect()->route('login');
        }
    }
    public function languagestore(Request $request){
        
        if($request->lang)
            {
        
        return redirect()->route('otp.register');
            }
            else{
                return redirect()->back();
            }
    }
    public function listlanguage(){
        
        return view('includes.listlanguage');
    }
   
    public function form(){
        
        return view('includes.otplogin');
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
            Session::put('error', 'Mobile number already registered');
            // return redirect()->route('otp.register')->with('error', 'Mobile number already registered');
            return redirect()->route('otp.register');
        }
        
        
    }
    public function logincalenderdetails($id)
    {
        $find = "EVENTS";
        $chkval = Str::contains($id, $find);
        if($chkval){
            //events
            $events =  DB::table('pwa_events')->where('eid', $id)->first();
            return redirect()->route('login.events.detail', ['id'=>$events->events_id]);
        }
        else{
            //meetings
            $meetings =  DB::table('pwa_meetings')->where('eid', $id)->first();
            return redirect()->route('login.meetings.detail', ['id'=>$meetings->id]);
        } 
        
    }
    
    public function enquirystore(Request $request)
    {
        $data['cust_id'] = Auth::guard('customer')->id();
        $data['opportunitytype'] = $request->input('opportunitytype');
        $data['referalstatus'] = $request->input('referalstatus');
        $data['referencetype'] = $request->input('referencetype');
        $data['descp'] = $request->input('descp');
        $data['phone'] = $request->input('phone');
        $data['name'] = $request->input('name');
        $data['member'] = $request->input('member');
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        if(Auth::guard('customer')->user()->roles == 1){
           
        // $data['chapter'] = Auth::guard('customer')->user()->category;
        $data['status'] = 2;
        }
        else if(Auth::guard('customer')->user()->roles == 2)
        {
            
            if($request->input('opportunitytype') == 4)
            {
                $data['category'] = NULL;
                $data['member'] = NULL;
                $data['status'] = 2;
                
            }
            // else
            // {
            //     $data['chapter'] = $request->input('chapter');
            // }
            
        }
       
        // dd($data);
        $result =  DB::table('opportunity')->insert($data);

        if(!empty($result))
        {
            return redirect()->route('login.media.list')->with('success', 'Your requiremnt is noted, Our registered member will reach you soon');
        }
        else
        {
            return redirect()->route('login.enquiry.add')->with('error', 'Something wrong & invalid');
        }
    
    }
    public function enquiryadd($id)
    {
        if(Auth::guard('customer')->check())
        {
        $enquiry =  DB::table('customers')->where('id', $id)->first();
        // dd($enquiry);
            return view('includes.addenquiry', compact('enquiry')); 
        }
        else{
            return redirect()->route('login');
        }
    }
   
    public function terms()
    {
        return view('includes.terms');
    }

    public function verifymobile(Request $request)
    {

        $details =  DB::table('customers')->where('phone', $request->input('phone'))->get();
        
        return view('includes.checkstatus', compact('details'));

        // if(!empty($chkexist))
        // {
        //     return redirect()->route('checkstatus')->with('error', 'Already Registered');
        // }
        // else
        // {
        //     return redirect()->route('checkstatus')->with('success', 'It is not registered, Kindly register');
        // }
    }
    
    public function checkstatus()
    {
        return view('includes.checkstatus');  
    }

    public function index()
    {
        if(Auth::guard('customer')->check())
        {
        
        $dash['banner'] = DB::table('pwa_banner')->select('*')->where('status',1)->get();
        $dash['news'] = DB::table('pwa_news')->select('*')->where('status',1)->get();
        $dash['activities'] = DB::table('pwa_activities')->select('*')->where('status',1)->get();
        $dash['updates'] = DB::table('pwa_updates')->select('*')->where('status',1)->get();
        $dash['events'] = DB::table('pwa_events')->select('*')->where('status',1)->limit('1')->first();
        $dash['scheme'] = DB::table('pwa_scheme')->select('*')->where('status',1)->get();
        $dash['about'] = DB::table('pwa_about')->select('*')->where('status',1)->get();
        $dash['content'] = DB::table('pwa_content')->select('*')->where('status',1)->limit('1')->first();
        $dash['services'] = DB::table('pwa_services')->select('*')->where('status',1)->get();
        
         $dash['past'] =  DB::table('pwa_meetings')
         ->where('date','<', \Carbon\Carbon::today()->format('m/d/Y'))
        //  ->where('time','<', \Carbon\Carbon::today()->format('H:i'))
         ->where('status', 1)->get();
            $dash['new'] =  DB::table('pwa_meetings')
            ->where('date','=', \Carbon\Carbon::today()->format('m/d/Y'))
            // ->where('time','>=', \Carbon\Carbon::today()->format('H:i'))
            ->where('status', 1)
            ->get();
            $dash['upcoming'] =  DB::table('pwa_meetings')
            ->where('date','>', \Carbon\Carbon::today()->format('m/d/Y'))
            // ->where('time','>', \Carbon\Carbon::today()->format('H:i'))
            ->where('status', 1)->get();
            
            // echo \Carbon\Carbon::today()->format('H:i');
            // dd( $dash['new']);
            
        return view('includes.index', compact('dash'));
        }
        else{
            return redirect()->route('login');
        }
    }

    public function register()
    {
      $roles = DB::table('roles')->where('id','!=',2)->where(['status'=>1,])->get();
        return view('includes.register', compact('roles'));  
    }

    public function registerstore(Request $request)
    {
            //registration
            
            // $chkexist =  DB::table('customers')->where('roles','=',1)->where('phone', $request->input('phone'))->first();
            $chkexist =  DB::table('customers')->where('roles','=',$request->input('roles'))->where('phone', $request->input('phone'))->first();
    
            if(!empty($chkexist))
            {
                return redirect()->route('register')->with('error', 'Mobile number already registered');
            }
            else
            {
                $data['phone'] = $request->input('phone');
                $data['username'] = $request->input('name');
                $data['email'] = $request->input('email');
                $data['ward'] = $request->input('ward');
                $data['roles'] = $request->input('roles');
                
                $data['password'] = Hash::make($request->password);
                $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['status'] = '1';
                if($request->hasFile('id_card') && $request->id_card){
                  $file = $request->id_card;
                  $extension = File::extension($file->getClientOriginalName());
                  $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
                  $file->move(public_path('uploads/id_cards/'), $filename);
                  $data['id_card'] = '/public/uploads/id_cards/'.$filename;
                }
                
                $cstresult = DB::table('customers')->insert($data);
                 
                
                $v =  DB::getPdo()->lastInsertId();
                $upd['reg_id'] = "BBMPMMS".$v;
                
               
                
                DB::table('customers')->where('id', $v)->update($upd);
                
                if($cstresult)
                {
                    return redirect()->route('login')->with('success','Registration was successful');
                 
                }
                else
                {
                    return redirect()->back()->with('error', 'Invalid inputs you entered');
                }
        }

    }

    public function dashboard()
    {
        $dashactive1 = "active-nav";
        return view('includes.index', compact('dashactive1')); 
    }

    public function maintanence()
    {
        return view('includes.maintanence');
    }

    public function logout()
    {
       if(Auth::guard('customer')->check())
        {

        
        Auth::logout();
       
        $upid = Auth::guard('customer')->user()->id;
        $user = DB::table('customers_logs')->where('custid', $upid)->first();
        if(!empty($user)){
        
            $updata['logout'] = date('Y-m-d H:i:s');
            DB::table('customers_logs')->where('custid',$upid)->update($updata);
        }
        Auth::guard('customer')->logout();
        return redirect()->route('login')->with('success','You account has been logged out successfully!');
        
        }
        else{
            return redirect()->route('login');
        }
        
    }

    public function forgotpassword()
    {
        return view('includes.forgot-password');  
    }

    public function confirm_otp(Request $request){
      $otp = $this->randomToken(4);
      $phone = $request->phone;
      DB::table('verification_otps')->where('phone',$request->phone)->delete();
      DB::table('verification_otps')->insert(['phone'=>$phone, 'otp'=>$otp]);
      $customer = DB::table('customers')->where('phone',$phone)->first();
      $res = $this->send_mail($customer->email, $otp);
      \Session::forget('error');
      return view('includes.confirm_otp', compact('phone'));
    }
    
    public function forgotpasswordstore(Request $request)
    {
      $phone = $request->input('phone');      
      $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->first();
      if(!empty($chkphone)){
        $check_otp = DB::table('verification_otps')->where(['phone'=>$request->phone, 'otp'=>$request->otp])->first();
        if(!$check_otp){
          \Session::put('error', 'Please enter correct OTP');
          return view('includes.confirm_otp', compact('phone'))->with('error', 'Please enter correct OTP');
        }
        \Session::forget('error');
        return view('includes.confirm-password', compact('phone'));
      }
      else
        return redirect()->route('forgot-password')->with('error', 'You entered phone number not registered');
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
    private function send_mail($to, $otp){
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
                        "subject": "Password change OTP.",
                        "content": [{
                          "type": "text/plain", 
                          "value": "'.$otp.' is OTP to change your password."
                        }]
                      }';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer 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',
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);  
        $response = curl_exec($ch);  
        curl_close($ch);
        return $response;
      }catch(\Exception $e){

      }
    }
    public function forgotverify(Request $request , $id){
        
        $details['id'] = decrypt($id);
        
        if ($request->session()->has('error')) {
            
            $value = $request->session()->get('error');
            return view('includes.forgotverify', compact('details'))->with('error', $value);
        }
        
        return view('includes.forgotverify', compact('details'));
    }
    public function forgotverifyOtp(Request $request)
    {
        
        $code = $request->otp;
        $id = $request->id;
        
        $result = DB::table('customer_otp')->where('id', $id)->where('otp', $code)->first();
        
        
        
        
        if(!empty($result)) {
            $phone = $result->cust_id;
            
            return view('includes.confirm-password', compact('phone'));  
            
                
        } else {
            
            return redirect()->route('otp.forgotverify', ['id' => encrypt($id)])->with('error', 'Invalid OTP');
        }
    }
    
    public function confirmpasswordstore(Request $request)
    {
       $data['password'] = Hash::make($request->password);
       $res = DB::table('customers')->where('phone', $request->input('phone'))->update($data);
       
    if(!empty($res))
    {
      DB::table('verification_otps')->where('phone',$request->phone)->delete();
       return redirect()->route('login')->with('success', 'Password Changed');
    }
    else{
        return redirect()->back()->with('error', 'Password is not updated, Please enter the new password');
    }
       
   }
   
    public function loginind()
    {
        
            return view('includes.login'); 
        
    }
    
    public function login(Request $request)
    {
    $chkphone =  DB::table('customers')->where('roles','=',1)->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();

    if(!empty($chkphone))
    {

        if(Hash::check($request->input('password'),$chkphone->password))
        {
            $credentials = $request->only('phone', 'password');
            // dd($credentials);
            if(Auth::guard('customer')->attempt($credentials))
            {
                //customer login session
                $dat = Auth::guard('customer')->user();
                $request->session()->put('customers' , $dat);
                $request->session()->save();
                
                //customer logs
                $updata['custid'] = Auth::guard('customer')->user()->id;
                $updata['login'] = date('Y-m-d H:i:s');
                $updata['ip'] = $request->ip();
                DB::table('customers_logs')->insert($updata);
                
                return redirect()->route('login.dashboard')->with('success','Your account has been logged in successfully!');
                
            }
            else
            {
                return redirect()->route('login');
            } 
        }
        else
        {
            return redirect()->route('login')->with('error','Incorrect password');
        }
    }
    else
    {
        return redirect()->route('login')->with('error','Invalid Credentials'); 
    }

}
    
    public function logindashboard()
    {
        if(Auth::guard('customer')->check())
        {
            // dd(Auth::guard('customer')->user()->roles);
            // return redirect()->route('dashboard');
            
                 $id = Auth::guard('customer')->id();
                 $chap = Auth::guard('customer')->user()->category;
                 $data['given'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id',$id)
        // ->where('opportunity.category', $chap)
        ->where('opportunity.status', 1)
        ->count();
        
        
        
        
        $data['received'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id','!=',$id)
        ->where('opportunity.category', $chap)
        ->orWhere('opportunity.member', '=', $id)
        ->where('opportunity.status', 1)
        ->count();
        
        $data['total'] = DB::table('pwa_meetings')
        ->where('status', 1)
        ->count();
        
        $data['attended'] = DB::table('pwa_meetings_attendance')->where('custid', $id)
        ->where('status', 1)
        ->count();
        
            return view('includes.dashboard', compact('data')); 
                
            
            
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginevents()
    {
        if(Auth::guard('customer')->check())
        {
            $events =  DB::table('pwa_events')->where('status', 1)->get();
        
        return view('includes.events', compact('events')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function logineventsdetails($id)
    {
        if(Auth::guard('customer')->check())
        {
            $events =  DB::table('pwa_events')->where('events_id', $id)->first();
            return view('includes.eventsdetail', compact('events')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginmeetings()
    {
        if(Auth::guard('customer')->check())
        {
           
           
            $meetings['past'] =  DB::table('pwa_meetings')->where('date','<', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
            $meetings['new'] =  DB::table('pwa_meetings')->where('date','=', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
            $meetings['upcoming'] =  DB::table('pwa_meetings')->where('date','>', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
           
        
        return view('includes.meetings', compact('meetings')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginmeetingsdetails($id)
    {
        if(Auth::guard('customer')->check())
        {
            $meetings =  DB::table('pwa_meetings')->where('id', $id)->first();
            return view('includes.meetingsdetail', compact('meetings')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginnews()
    {
        if(Auth::guard('customer')->check())
        {
             $news =  DB::table('pwa_news')->where('status', 1)->get();
        return view('includes.news', compact('news')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginnewsdetail($id)
    {
        if(Auth::guard('customer')->check())
        {
            $news =  DB::table('pwa_news')->where('news_id', $id)->first();
            return view('includes.newsdetail', compact('news')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function logincalender()
    {
        if(Auth::guard('customer')->check())
        {
             $calender =  DB::table('calender')->where('status', 1)->get();
            //  $calender = DB::table('calender')
            //  ->select('pwa_meetings.id as meetid','pwa_events.events_id as eveid', 'calender.*')
            //  ->join('pwa_meetings', 'pwa_meetings.eid', '=', 'calender.eid')
            //  ->join('pwa_events', 'pwa_events.eid', '=', 'calender.eid')
            //  ->where('calender.status', 1)
            //  ->get();
            // dd($calender);
    
            return view('includes.calender', compact('calender')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginprofile()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.profile'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function logingallery()
    {
        if(Auth::guard('customer')->check())
        {
            $gallery =  DB::table('pwa_gallery')->where('status', 1)->get();
        return view('includes.gallery', compact('gallery'));  
        }
    }
    
    public function loginsupport()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.maintanence'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function listmembers()
    {
        if(Auth::guard('customer')->check())
        {
        $members = Customer::select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
        ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
        ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
        ->where('customers.roles', 2)
        ->where('customers.status', 1)->get();
        // $members = Customer::all();
        return view('includes.listmembers', compact('members'));  
    }
        else{
            return view('includes.login'); 
        }
    }
    
    public function memberdetails($id)
    {
        $memberdetails = Customer::select('customers.*')
        
    //    $memberdetails = Customer::select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname', 'pwa_chapter.name as chaptername', 'pwa_country.name as countryname', 'pwa_state.name as statename')
        // ->join('pwa_category','customers.category','=', 'pwa_category.id')
        // ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id')
        // ->join('pwa_chapter','customers.chapter','=', 'pwa_chapter.id')
        // ->join('pwa_country','customers.country','=', 'pwa_country.id')
        // ->join('pwa_state','customers.state','=', 'pwa_state.id')
        ->where('customers.id', $id)->where('customers.status', 1)->first();
        
        return view('includes.memberdetails', compact('memberdetails'));  
    }
    
    public function opportunitylist()
    {
        if(Auth::guard('customer')->check())
        {
            $id = Auth::guard('customer')->id();
            $chap = Auth::guard('customer')->user()->category;
            
           $data['given'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id',$id)
        // ->where('opportunity.category', $chap)
        ->where('opportunity.status', 1)
        ->orderBy('id', 'desc')
        ->get();
        
        
        
        
        $data['received'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id','!=',$id)
        ->where('opportunity.category', $chap)
        ->orWhere('opportunity.member', '=', $id)
        ->where('opportunity.status', 1)
        ->orderBy('id', 'desc')
        ->get();
        
      
            
            
            
            return view('includes.listopportunity', compact('data')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function opportunitystore(Request $request)
    {
        $data['uid'] = "REQ".uniqid();
        $data['cust_id'] = Auth::guard('customer')->id();
        $data['opportunitytype'] = $request->input('opportunitytype');
        $data['opportunityto'] = $request->input('opportunityto');
        $data['referalstatus'] = $request->input('referalstatus');
        $data['referencetype'] = $request->input('referencetype');
        $data['descp'] = $request->input('descp');
        $data['phone'] = $request->input('phone');
        $data['name'] = $request->input('name');
        $data['member'] = $request->input('member');
        $data['category'] = $request->input('category');
        $data['subcategory'] = $request->input('subcategory');
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        if(Auth::guard('customer')->user()->roles == 1){
           
        // $data['chapter'] = Auth::guard('customer')->user()->category;
        $data['status'] = 2;
        }
        else if(Auth::guard('customer')->user()->roles == 2)
        {
            
            if($request->input('opportunitytype') == 4)
            {
                $data['category'] = NULL;
                $data['member'] = NULL;
                $data['status'] = 2;
                
            }
            // else
            // {
            //     $data['chapter'] = $request->input('chapter');
            // }
            
        }
       
        // dd($data);
        $result =  DB::table('opportunity')->insert($data);

        if(!empty($result))
        {
            
            $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = Auth::guard('customer')->user()->phone;
                $message = 'Your requirement has been posted. Our members from particular category will contact you shortly. For any details call back Vipra Business Forum on 9606274007';
                $templateid = '1207168343809077877';
                
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
                
                $status_code = $response->getStatusCode();
                if($status_code == '200')
                {
                    return redirect()->route('login.opportunity.list')->with('success', 'Your requiremnt is noted, Our registered member will reach you soon');
                }
                else{
                    return redirect()->route('login.opportunity.add')->with('error', 'Sms gateway invalid now!!!');
                }
        }
        else
        {
            return redirect()->route('login.opportunity.add')->with('error', 'Something wrong & invalid');
        }
    
    }
    public function opportunityadd()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.addopportunity'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function opportunitydetails($id)
    {
       
        $list = DB::table('opportunity')
        ->select('opportunity.name as opname','opportunity.descp as descpname','opportunity.phone','customers.username as custname', 'opportunity.created_at as dat', 'pwa_referencetype.name as refname', 'pwa_opportunitytype.name as optname', 'pwa_referalstatus.name as referalname', 'pwa_opportunityconnect.name as conname')
        ->join('customers','opportunity.cust_id','=', 'customers.id', 'left')
        ->join('pwa_referencetype','opportunity.referencetype','=', 'pwa_referencetype.id', 'left')
        ->join('pwa_opportunitytype','opportunity.opportunitytype','=', 'pwa_opportunitytype.id', 'left')
        ->join('pwa_referalstatus','opportunity.referalstatus','=', 'pwa_referalstatus.id', 'left')
        ->join('pwa_opportunityconnect','opportunity.opportunityto','=', 'pwa_opportunityconnect.id', 'left')
        ->where('opportunity.id', $id)->first();
        
        return view('includes.opportunitydetails', compact('list'));  
    }
     public function allmedia()
    {
        if(Auth::guard('customer')->check())
        {
            
            //checking expiry of business post
                $dae = \Carbon\Carbon::today()->subDay(7);  /*after one week expiry*/
                $items = DB::table('media')->select('*')->where('created_at', '<=', $dae)->where('status', 1)->get();
                // dd($items);
                if($items){
                    foreach($items as $item)
                    {
                        $daa['status'] = 4;
                        $res =  DB::table('media')->where('id', $item->id)->update($daa);
                    }
                }
                
                
                
         $data =  DB::table('media')->orderBy('id', 'desc')->where('status',1)->get();
            return view('includes.listmedia', compact('data')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function allmediaposts($id)
    {
        if(Auth::guard('customer')->check())
        {
            $media =  DB::table('media')->where('id', $id)->first();
            return view('includes.listmediaposts', compact('media')); 
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function addmedia()
    {
        if(Auth::guard('customer')->check())
        {
            
        return view('includes.addmedia'); 
        }
        else{
            return redirect()->route('login');
        }
    }
     public function addmediastore(Request $request)
    {
        if(Auth::guard('customer')->check())
        {
          
            //validation for daily once
            $chkmedia =  DB::table('media')
            ->where('cust_id','=' , Auth::guard('customer')->id())
            // ->where('created_at','LIke', date('Y-m-d').'%')
            ->where('created_at','LIKE', \Carbon\Carbon::today()->format('Y-m-d').'%')
            ->first();
            if(!empty($chkmedia))
            {
                return redirect()->route('login.media.add')->with('error', 'Business Posting is limited! You can add only one per day');
            }
            else{
                
                
                //validation for weekly twice 
                $weekmedia =  DB::table('media')
            ->where('cust_id','=' , Auth::guard('customer')->id())
            ->whereBetween('created_at', [\Carbon\Carbon::today()->startOfWeek(), \Carbon\Carbon::today()->endOfWeek()])
            ->count();
            
            if($weekmedia >= 2)
            {
                return redirect()->route('login.media.add')->with('error', 'Business Posting is limited! You can add only weekly twice');
            }
            
            
            $data['cust_id'] = Auth::guard('customer')->id();
            $data['title'] = $request->input('title');
            $data['category'] = $request->input('category');
            $data['uid'] = "BP".uniqid();
            $data['descp'] = $request->input('descp');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['status'] = 2;
            
            if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/media'), $filename);
            $data['image']= $filename;
        }
            
           
            
            $result =  DB::table('media')->insert($data);
    
            if(!empty($result))
            {
                return redirect()->route('login.media.list')->with('success', 'New Business Posted');
            }
            else
            {
                return redirect()->route('login.media.add')->with('error', 'Something wrong & invalid');
            }
        }
        }
        else{
            return redirect()->route('login');
        }
    
    }


}
