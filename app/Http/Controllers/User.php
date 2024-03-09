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

use Response;

use Illuminate\Support\Facades\Http;


class User extends Controller
{
    public function loginprofile()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.user.profile'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function dumpstore(Request $request)
    {
         if(Auth::guard('customer')->check())
        {
        $nme = \Carbon\Carbon::now()->format('YmdHis').rand(10,99);
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
        
        $data['latit'] = $request->input('latit');
        $data['descp'] = $request->input('descp');
        $data['dstatus'] = $request->input('dstatus');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $uid = Str::random(4, '1234567890');
        $data['uid'] = "BBMPMMS".$uid;
        $data['cust_id'] = Auth::guard('customer')->id();
       
        $result =  DB::table('dump')->insert($data);
        $did = DB::getPdo()->lastInsertId();
        if(!empty($result))
        {
            return redirect()->route('user.history')->with('success', 'Added successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'Something wrong & invalid');
        }
        }
        else{
            return redirect()->route('user.login');
        }
    
    }
    public function logindum($id)
    {
        if(Auth::guard('customer')->check())
        {
            if($id){
                return view('includes.user.dump', compact('id')); 
            }
              
        }
        else{
            return redirect()->route('user.login');
        }
    }
    public function notice()
    {
        if(Auth::guard('customer')->check())
        {
        $data =  DB::table('dump')->get();
        
        return view('includes.user.notice', compact('data')); 
        }
        else{
            return redirect()->route('user.login');
        }
   
    }
     public function history()
    {
        if(Auth::guard('customer')->check())
        {
            $wardd = session('customers.ward');
            
            $ward = explode(',',$wardd);
             
        $data =  DB::table('pick')->whereIn('ward',$ward)
        ->where(function ($query) {
        $query->where('source_reduction', '=', null)
              ->orWhere('source_reduction', '=', 'Not Done');
    })
    ->where('q1','=','Yes')
        ->where('status', 1)->orderBy('id', 'desc')->get();
        
        return view('includes.user.history', compact('data')); 
        }
        else{
            return redirect()->route('user.login');
        }
   
    }
    public function historydetails($id)
    {
        if(Auth::guard('customer')->check())
        {
            
        $datadetails =  DB::table('pick')->where('id', $id)->first();
          return view('includes.user.historydetails', compact('datadetails')); 
        }
        else{
            return redirect()->route('login');
        }
        
    }
    public function verifystore(Request $request)
    {
        
        if(Auth::guard('customer')->check())
        {
            if($request->has('verify')) 
            {
                $data['did'] = $request->input('did');
                $data['dstatus'] = $request->input('dstatus');
                $data['comments'] = $request->input('descp');
                $data['status'] = 1;
                $data['cust_id'] = Auth::guard('customer')->id();
                
                if($request->file('image'))
                    {
                        $file= $request->file('image');
                        $filename= uniqid().$file->getClientOriginalName();
                        $file-> move(public_path('uploads/verify'), $filename);
                        $data['image']= $filename;
                    }
               
                $result =  DB::table('cdverify')->insert($data);
            }
            else{
                $data['did'] = $request->input('did');
                $data['dstatus'] = $request->input('dstatus');
                $data['comments'] = $request->input('descp');
                $data['status'] = 2;
                $data['cust_id'] = Auth::guard('customer')->id();
                
                if($request->file('image'))
                    {
                        $file= $request->file('image');
                        $filename= uniqid().$file->getClientOriginalName();
                        $file-> move(public_path('uploads/verify'), $filename);
                        $data['image']= $filename;
                    }
               
                $result =  DB::table('cdverify')->insert($data);
                
            }
            if(!empty($result))
            {
                return redirect()->route('user.dump');
            }
        }
        else{
            return redirect()->route('user.login');
        }
    }
    public function loginverify($id)
    {
        if(Auth::guard('customer')->check())
        {
            return view('includes.user.cdverify', compact('id')); 
            
        }
        else{
            return redirect()->route('user.login');
        }
    }
    
     public function dump()
    {
        if(Auth::guard('customer')->check())
        {
        $data =  DB::table('dump')->get();
        
        return view('includes.user.listdump', compact('data')); 
        }
        else{
            return redirect()->route('user.login');
        }
   
    }
    
    public function loginind()
    {
        
            return view('includes.user.login'); 
        
    }
    
    public function login(Request $request)
    {
    $chkphone =  DB::table('customers')->where('roles','=', 2)->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();

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
                
                return redirect()->route('user.login.dashboard')->with('success','Your account has been logged in successfully!');
                
            }
            else
            {
                return redirect()->route('user.login');
            } 
        }
        else
        {
            return redirect()->route('user.login')->with('error','Incorrect password');
        }
    }
    else
    {
        return redirect()->route('user.login')->with('error','Invalid Credentials'); 
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
        
            return view('includes.user.dashboard', compact('data')); 
                
            
            
            
        }
        else{
            return redirect()->route('user.login');
        }
    }
    public function logout()
    {
        Auth::logout();
       
        $upid = Auth::guard('customer')->user()->id;
        $user = DB::table('customers_logs')->where('custid', $upid)->first();
        if(!empty($user)){
        
            $updata['logout'] = date('Y-m-d H:i:s');
            DB::table('customers_logs')->where('custid',$upid)->update($updata);
        }
        Auth::guard('customer')->logout();
        return redirect()->route('user.login')->with('success','You account has been logged out successfully!');
    }


    public function scanner($id)
    {
        
        if($id){
            $datadetails =  DB::table('pick')->where('cust_id', $id)->where('id', $id)->first();
        echo json_encode($datadetails);
        // return redirect()->route('user.detail', ['id'=>$id]); 
        }
        else{
            $datadetails = "Wrong data";
            echo json_encode($datadetails);
        }
   
    }
    
    public function details($id)
    {
        $datadetail =  DB::table('pick')->where('cust_id', $id)->get();
        
        return view('includes.user.details', compact('datadetail')); 
   
    }

    public function mail_test(){
      $postfields = '{
                      "personalizations": [{
                        "to": [{
                          "email": "dheerajzxx@gmail.com"
                        }]
                      }],
                      "from": {
                        "email": "delegate@biffes.org"
                      },
                      "subject": "Sending with SendGrid is Fun",
                      "content": [{
                        "type": "text/plain", 
                        "value": "and easy to do anywhere, even with cURL"
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
      dd($response);
    }
    
    
    
}