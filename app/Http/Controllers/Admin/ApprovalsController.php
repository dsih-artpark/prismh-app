<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use App\Models\Media;

use App\Models\Opportunity;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

use Illuminate\Support\Facades\Storage;

use File;

use GuzzleHttp\Client as Guzle;

use Response;

class ApprovalsController extends Controller
{
    public function downloadmembers($id)
    {
        $filepath = public_path('uploads/customer').'/'.$id;
        return Response::download($filepath); 
    }
    public function manageapprovals()
    {
        $data['pending'] = Customer::where('status', 2)->get();
        $data['members'] = Customer::where('roles', 2)->where('status', 1)->get();
        $data['guest'] = Customer::where('roles', 1)->where('status', 3)->get();
        $data['rejected'] = Customer::where('roles', 1)->where('status', 1)->get();
        $data['all'] = Customer::get();
        // dd($data);
         
        return view('admin.manageapprovals', compact('data'));
        
    }
    public function viewmembers($id)
    {
        $member = Customer::where('id', $id)->first();
        if(!empty($member))
        {
            return view('admin.viewmember', compact('member'));
        }
        
    }
    public function statusapprovals($id , $row)
    {
        $status = $row;
         
        if($status == 1)
        {
             $upd['roles'] = 2;
             $upd['status'] = 1;
             
            $result =  DB::table('customers')->where('id', $id)->update($upd);
            if($result)
            {
                $memdet = DB::table('customers')->where('id', $id)->first();
                $memno = $memdet->reg_id;
                $sst = $memdet->roles; 
                if($sst == '2')
                {
                    $ssts = 'Member';
                }
                else
                {
                    $ssts = 'Guest';
                }
                $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = $memdet->phone;
                $message = 'Happy to inform you that your membership has been approved by Vipra Business Forum. Your Membership No '.$memno.' Membership Type '.$ssts.' For details call 9606274007';
                $templateid = '1207168343793461078';
                
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
                    //check
                    $chcknotif = DB::table('customer_notification')->where('custid',$id)->first();
                    if($chcknotif)
                    {
                        $delresult =  DB::table('customer_notification')->where('custid', $id)->delete();
                    }
                    //insert
                    $notif['custid'] = $id;
                    $notif['status'] = 2;
                    DB::table('customer_notification')->insert($notif);
        
                    return redirect()->route('adminapprovals')->with ('succes', ' Approved Successfully');
                }
                else
                {
                    return redirect()->route('adminapprovals')->with ('error', 'Sms Gateway invalid now');
                }
            
            }
            else
            {
                return redirect()->route('adminapprovals')->with ('error', 'Not Approved');
            }
         
         
        
         
         }
         else if($status == 2){
              $upd['roles'] = 1;
             $upd['status'] = 1;
             
             $result =  DB::table('customers')->where('id', $id)->update($upd);
         if($result){
             
            return redirect()->route('adminapprovals')->with ('succes', 'Rejected Successfully');
             
         }
         else{
             return redirect()->route('adminapprovals')->with ('error', 'Not Rejected');
         }
             
         }
        
    }
    public function managesocialmedia()
    {
        
         //checking expiry of business post
               echo  $dae = \Carbon\Carbon::today('Asia/Kolkata')->subDay(+7);  
               echo  $startOfWeek = \Carbon\Carbon::today('Asia/Kolkata')->startOfWeek();  
               echo  $endOfWeek = \Carbon\Carbon::today('Asia/Kolkata')->endOfWeek();  
               /*after one week expiry*/
               
               $currentDate = date('Y-m-d'); // Get the current date
$newDate = date('Y-m-d', strtotime($currentDate . ' +7 days')); // Add 7 days to the current date

                $items = DB::table('media')->select('*')
                ->where('created_at','LIKE', $dae.'%')
                // ->where('created_at', '<=', $dae)
                // ->where('status', 1)
                ->get();
                // dd($items);
                
                
                $red =  DB::table('media')->whereBetween('created_at', [\Carbon\Carbon::today()->startOfWeek(), \Carbon\Carbon::today()->endOfWeek()])
            ->get();
            $red =  DB::table('media')->select('id','created_at')->get();
            // dd($red);
            
                
                
                
                
        $data['all'] = Media::select('media.*', 'customers.username as custname')
            ->leftjoin('customers','customers.id', '=', 'media.cust_id')
            ->get();
        
        $data['pending'] = Media::select('media.*', 'customers.username as custname')
            ->leftjoin('customers','customers.id', '=', 'media.cust_id')
            ->where('media.status', 2)
            ->get();
            
        $data['rejected'] = Media::select('media.*', 'customers.username as custname')
            ->leftjoin('customers','customers.id', '=', 'media.cust_id')
            ->where('media.status', 3)
            ->get();
            
        $data['expired'] = Media::select('media.*', 'customers.username as custname')
            ->leftjoin('customers','customers.id', '=', 'media.cust_id')
            ->where('media.status', 4)
            ->get();
         
        return view('admin.managesocialmedia', compact('data'));
        
    }
    public function socialmediastatusapprovals($id , $row)
    {
        
        //  $id = $request->row;
         $status = $row;
       
         $upd['status'] = $status;
         
        //  if($status == 2){
        //       $upd['roles'] = 2;
        //  }
         
        
        $result =  DB::table('media')->where('id', $id)->update($upd);
         if($result){
             
             if($status == 1){
                 
          return redirect()->route('adminapprovals.socialmedia')->with ('succes', 'Approved Successfully');
                                    
                                    
}
                   
                                    elseif($status == 2){
                                        
          return redirect()->route('adminapprovals.socialmedia')->with ('succes', 'Pending Successfully');
                                   
}
                                    else{
                                        
          return redirect()->route('adminapprovals.socialmedia')->with ('succes', 'Rejected Successfully');
                                    
}
    
             
             
             
             
         }
         else{
             return redirect()->route('adminapprovals.socialmedia')->with ('error', 'Already Updated');
         }
           
    }
    
     public function manageopportunity()
    {
        $data['pending'] = Opportunity::select('opportunity.*', 'customers.username', 'customers.subcategory as subcateid')
        ->leftjoin('customers','customers.id', '=', 'opportunity.cust_id')
        ->where('opportunity.status', 2)
        ->get();
        $data['all'] = Opportunity::select('opportunity.*', 'customers.username', 'customers.subcategory as subcateid')
        ->leftjoin('customers','customers.id', '=', 'opportunity.cust_id')
        ->get();
         
        return view('admin.manageopportunity', compact('data'));
        
    }
    public function opportunitystatus(Request $request)
    {
        
        // dd($request);
        if($request->category)
        {
            $id = $request->row;
            
        $update['member'] = "";
        $update['chapter'] = "";
        $update['category'] = $request->category;
        $update['subcategory'] = $request->subcategory;
        $update['status'] = 1;
        
        $result =  DB::table('opportunity')->where('id', $id)->update($update);
        
         if($result)
         {
             
            $memdet = DB::table('customers')->where('category', $request->category)->get();
             
            foreach($memdet as $dat)
            {
                $memno = $dat->reg_id;
                $sst = $dat->roles; 
                
                $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = $dat->phone;
                $message = 'Requirement received for your Product / Service through Vipra Business Forum. Please log in to the V-Biz app and Check from your message box.';
                $templateid = '1207168343802545896';
                
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
                
                
            }
                return redirect()->route('adminapprovals.opportunity')->with ('succes', 'Forward successfully');
                
         }
         else{
             return redirect()->route('adminapprovals.opportunity')->with ('error', 'Already forwarded');
         }
            
        }
        
        if($request->member)
        {
             $id = $request->row;
             
        $update['category'] = "";
        $update['subcategory'] = "";
        $update['chapter'] = "";
        $update['member'] = $request->member;
        $update['status'] = 1;
        
        $result =  DB::table('opportunity')->where('id', $id)->update($update);
        
        if($result)
        {
            $memdet = DB::table('customers')->where('id', $request->member)->first();
                
                
                $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = $memdet->phone;
                $message = 'Requirement received for your Product / Service through Vipra Business Forum. Please log in to the V-Biz app and Check from your message box.';
                $templateid = '1207168343802545896';
                
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
                    return redirect()->route('adminapprovals.opportunity')->with ('succes', 'Forward successfully');

                }
                else
                {
                    return redirect()->route('adminapprovals.opportunity')->with ('error', 'Sms Gateway invalid now');
                }
         }
         else{
             return redirect()->route('adminapprovals.opportunity')->with ('error', 'Already forwarded');
         }
            
        }
        
        
        if($request->opportunitytype == '3')
        {
            $id = $request->row;
            
             $update['member'] = "";
        $update['category'] = "";
        $update['subcategory'] = "";
        $update['chapter'] = $request->chapter;
        $update['status'] = 1;
        
        $result =  DB::table('opportunity')->where('id', $id)->update($update);
        
         if($result)
         {
              $memdet = DB::table('customers')->where('chapter', $request->chapter)->get();
             
            foreach($memdet as $dat)
            {
                $memno = $dat->reg_id;
                $sst = $dat->roles; 
                
                $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = $dat->phone;
                $message = 'Requirement received for your Product / Service through Vipra Business Forum. Please log in to the V-Biz app and Check from your message box.';
                $templateid = '1207168343802545896';
                
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
                
                
            }
            
            
            
            return redirect()->route('adminapprovals.opportunity')->with ('succes', 'Forward successfully');
         }
         else{
             return redirect()->route('adminapprovals.opportunity')->with ('error', 'Already forwarded');
         }
            
        }
           
    }
    
    public function listsubcategory(Request $request)
    {
        
        $id = $request->category;
        
        $data =  DB::table('pwa_subcategory')->where('cat_id', $id)->get();
        
        $response = $data;
        return response()->json($response); 
        
    }
     
    public function opportunityrejected($id)
    {
        
        // $id = $request->row;
        $update['status'] = 3;
        
        $result =  DB::table('opportunity')->where('id', $id)->update($update);
        // dd($result);
         if($result)
         {
            return redirect()->route('adminapprovals.opportunity')->with ('succes', 'Rejected successfully');
         }
         else{
             return redirect()->route('adminapprovals.opportunity')->with ('error', 'Already rejected');
         }
           
    }
     public function editmembers($id)
    {
        $member = customer::where('id', $id)->first();
        return view('admin.editmembers', compact('member'));
    }
    public function updatemembers(Request $request, $id)
    {
        
        $about['username'] =$request->username;
        $about['phone'] = $request->phone;
        $about['password'] = Hash::make($request->input('password'));
        
         $chkexist =  DB::table('customers')->select('*')->where('phone' , '=' , $request->phone)->first();
        //  dd($chkexist);
    
            if($chkexist)
            {
                //echo"exist";die;
                
                if($chkexist->id == $id){
                    
                   
                    
                    if($request->file('profile'))
                {
                $file= $request->file('profile');
                $filename= "prof".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['profile']= $filename;
                }
                
                 $about['gender'] = $request->input('gender');
                $about['email'] = $request->input('email');
                $about['address'] = $request->input('address');
                $about['dob'] = $request->input('dob');
                $about['martial'] = $request->input('martial');
                 $about['martial_date'] = $request->input('martial_date');
                $about['gotra'] = $request->input('gotra');
                $about['paddress'] = $request->input('paddress');
                $about['bname'] = $request->input('bname');
                $about['baddress'] = $request->input('baddress');
                $about['bdate'] = $request->input('bdate');
                $about['designation_id'] = $request->designation_id;
                $about['nature'] = $request->nature;
                $about['bphone'] = $request->bphone;
                $about['bemail'] = $request->bemail;
                $about['website'] = $request->website;
                $about['idproof'] = $request->idproof;
                
                
                if($request->file('idimage'))
                {
                $file= $request->file('idimage');
                $filename= "idimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['idimage']= $filename;
                }
                if($request->file('idaddress'))
                {
                $file= $request->file('idaddress');
                $filename= "idaddress".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['idaddress']= $filename;
                }
                if($request->file('breg'))
                {
                $file= $request->file('breg');
                $filename= "breg".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['breg']= $filename;
                }
                
                $about['gst'] = $request->gst;
                if($request->file('gstcer'))
                {
                $file= $request->file('gstcer');
                $filename= "gstcer".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['gstcer']= $filename;
                }
                
                $about['pan'] = $request->pan;
                if($request->file('panimage'))
                {
                $file= $request->file('panimage');
                $filename= "panimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['panimage']= $filename;
                }
                $about['others'] = $request->others;
                if($request->file('doc'))
                {
                $file= $request->file('doc');
                $filename= "doc".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['doc']= $filename;
                }
                $about['rname'] = $request->rname;
                $about['rmem'] = $request->rmem;
                $about['rphone'] = $request->rphone;
                $about['remail'] = $request->remail;
                if($request->file('signature'))
                {
                $file= $request->file('signature');
                $filename= "signature".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['signature']= $filename;
                }
                
                
                
                $about['category'] = $request->input('category');
                $about['subcategory'] = $request->input('subcategory');
                $about['chapter'] = $request->input('chapter');
                $about['descp'] = $request->input('descp');
                $about['keyword'] = $request->input('keyword');
                $about['city'] = $request->input('city');
                $about['state'] = $request->input('state');
                $about['country'] = $request->input('country');
                $about['pincode'] = $request->input('pincode');
                
                $about['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
               $upded = DB::table('customers')->where('id', $id)->update($about);
        
        if(!empty($upded))
        {
          return redirect()->route('adminapprovals')->with ('succes', 'Updated successfully');
        }
        else
        {
            return redirect()->route('adminmember.edit', ['id'=>$id])->with('error', 'Already use this mobile number');
                }
                    
                }
                else{
                return redirect()->route('adminmember.edit', ['id'=>$id])->with('error', 'Already use this mobile number');
                }
            }
            else
            {
            
        
         if($request->file('profile'))
                {
                $file= $request->file('profile');
                $filename= "prof".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['profile']= $filename;
                }
                
                 $about['gender'] = $request->input('gender');
                $about['email'] = $request->input('email');
                $about['address'] = $request->input('address');
                $about['dob'] = $request->input('dob');
                $about['martial'] = $request->input('martial');
                 $about['martial_date'] = $request->input('martial_date');
                $about['gotra'] = $request->input('gotra');
                $about['paddress'] = $request->input('paddress');
                $about['bname'] = $request->input('bname');
                $about['baddress'] = $request->input('baddress');
                $about['bdate'] = $request->input('bdate');
                $about['designation_id'] = $request->designation_id;
                $about['nature'] = $request->nature;
                $about['bphone'] = $request->bphone;
                $about['bemail'] = $request->bemail;
                $about['website'] = $request->website;
                $about['idproof'] = $request->idproof;
                
                
                if($request->file('idimage'))
                {
                $file= $request->file('idimage');
                $filename= "idimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['idimage']= $filename;
                }
                if($request->file('idaddress'))
                {
                $file= $request->file('idaddress');
                $filename= "idaddress".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['idaddress']= $filename;
                }
                if($request->file('breg'))
                {
                $file= $request->file('breg');
                $filename= "breg".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['breg']= $filename;
                }
                
                $about['gst'] = $request->gst;
                if($request->file('gstcer'))
                {
                $file= $request->file('gstcer');
                $filename= "gstcer".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['gstcer']= $filename;
                }
                
                $about['pan'] = $request->pan;
                if($request->file('panimage'))
                {
                $file= $request->file('panimage');
                $filename= "panimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['panimage']= $filename;
                }
                $about['others'] = $request->others;
                if($request->file('doc'))
                {
                $file= $request->file('doc');
                $filename= "doc".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['doc']= $filename;
                }
                $about['rname'] = $request->rname;
                $about['rmem'] = $request->rmem;
                $about['rphone'] = $request->rphone;
                $about['remail'] = $request->remail;
                if($request->file('signature'))
                {
                $file= $request->file('signature');
                $filename= "signature".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $about['signature']= $filename;
                }
                
                
                
                $about['category'] = $request->input('category');
                $about['subcategory'] = $request->input('subcategory');
                $about['chapter'] = $request->input('chapter');
                $about['descp'] = $request->input('descp');
                $about['keyword'] = $request->input('keyword');
                $about['city'] = $request->input('city');
                $about['state'] = $request->input('state');
                $about['country'] = $request->input('country');
                $about['pincode'] = $request->input('pincode');
                
                $about['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
               
            }
       $upded = DB::table('customers')->where('id', $id)->update($about);
        
        if(!empty($upded))
        {
          return redirect()->route('adminapprovals')->with ('succes', 'Updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletemembers($id)
    {
        $deletd = DB::table('customers')->where('id', $id)->delete();
        if(!empty($deletd))
        {
            //check requirement with same member
            $custdeletd = DB::table('opportunity')->where('cust_id', $id)->delete();
            //check requirement with same member
            $custdeletd2 = DB::table('opportunity')->where('member', $id)->delete();
            
            //check media with same memeber
            $busdeletd = DB::table('media')->where('cust_id', $id)->delete();
            
            //check meeting attendance with same memeber
            $meddeletd = DB::table('pwa_meetings_attendance')->where('custid', $id)->delete();
            
            // echo json_encode($deletd);
          return redirect()->route('adminapprovals')->with ('succes', 'Deleted successfully');
        }
        
    }
    
    
}