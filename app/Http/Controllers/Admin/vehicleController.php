<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

//use App\Models\{vehicle,Division,Ward};

use App\Models\vehicle;
use App\Models\Division;
use App\Models\Ward;

// use App\Models\reply;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use QrCode;
use Illuminate\Support\Facades\Storage;
use Str;
use Carbon\Carbon;

class vehicleController extends Controller
{
    public function vehicle()
    {

        $vehicle = vehicle::all();
        return view('admin.vehicle', compact('vehicle'));
        
    }







    // public function editvehicle($id)
    // {
    //     $vehicle = DB::table("ticket_mng")->where('id', $id)->first();
    //     if(!empty($vehicle))
    //     {
    //         return view("admin.editvehicle",['vehicle'=>$vehicle]);
    //     }
    // }

    // public function editvehicle($id)
    // {
    //     $vehicle = vehicle::where('id', $id)->first();
    //   //  $vehicle['category'] = Category::where('status', 1)->get();
    //     return view('admin.editvehicle', compact('vehicle'));
    //         // return view('admin.editvehicle');
    //        // return view('admin.editvehicle');

    // }
    public function editcat(Request $request, $id)
    {

        $data['ticket_cat'] = $request->new_categ_id;
        $data['ticket_subcat'] = $request->new_subcateg_id;
        
        
       $upcat = DB::table('ticket_mng')->where('id', $id)->update($data);
        
        if(!empty($upcat))
        {
          return redirect()->route('adminvehicle')->with ('succes', 'category and Subcategory updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
      
    }
     public function editvehicle($id)
    {
        $vehicle = vehicle::where('id', $id)->first();
      //  $vehicle['category'] = Category::where('status', 1)->get();
        return view('admin.editvehicle', compact('vehicle'));
            // return view('admin.editvehicle');
           // return view('admin.editvehicle');

    }
    public function replyvehicle(Request $request)
    {
        $id = $request->aptid;
                 // $vehicle = vehicle::where('id', $id)->first();
        $vehicle['replies'] = $request->reply; 
         $vehicle['admin_id'] =1; 
                 //   $vehicle['user_id'] =2 ;
 
        //$up = DB::table('ticket_mng')->select('tck_id')->where('id', $id);

        $dbTicketID = "";
        
        $ticketIDEx = DB::table('ticket_mng')->where('id', $id)->get();
        //checking if record exist in DB
        if($ticketIDEx) {
            foreach ($ticketIDEx as $tck) {
                $dbTicketID = $tck->tck_id; // assigning value to variable
            }
        } 

         $vehicle['user_id'] = $dbTicketID;
         $vehicle['status'] = $request->status_1;

         if($request->file('image'))
         {
             $file= $request->file('image');
             $filename= date('YmdHis').$file->getClientOriginalName();
             $file-> move(public_path('uploads/vehicle'), $filename);
             $vehicle['image']= $filename;
         }
        
       $upded = DB::table('reply_tck')->insert($vehicle);

       $st['status'] = $request->status_1; 
       $update = DB::table('ticket_mng')->where('tck_id', $dbTicketID  )->update($st);
        
        if(!empty($upded))
        {
          return redirect()->route('adminvehicle')->with ('succes', 'Replied successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }

    }





    // public function editcatt($id)
    // {
    //   //  $vehicle['subcat'] = Subcategory::where('tck_id ', $tck_id )->get();
    //   $vehicle['det'] = vehicle::where('id', $id)->first();
    //   $vehicle['category'] = vehicle::where('status', 1)->get();
    //   //  $vehicle['category'] = Category::where('tck_id', $tck_id )->get();
    //     return view('admin.editvehicle', compact('vehicle'));
          
    // }
    // public function editcat(Request $request){

    //     $vehicle['ticket_cat'] = $request->cat;
    //   //  $vehicle['ticket_subcat'] = $request->ticket_subcat;
          
    //    $upd = DB::table('ticket_mng')->where('tck_id', $tck_id)->update($vehicle);
        
    //    if(!empty($upd))
    //    {
    //      return redirect()->route('adminsubcategory')->with ('succes', 'Subcategory updated successfully');
    //    }
    //    else
    //    {
    //        return back()->with('error','something are wrong.');
    //    }
    // }

  
    public function deletevehicle($id)
    {
        $deletd = DB::table('ticket_mng')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminvehicle')->with ('succes', 'Ticket deleted successfully');
        }
        
    }
    public function viewvehicle($id)
    {
        $vehicle = DB::table('ticket_mng')->where('id', $id)->first();
        if(!empty($vehicle))
        {
            return view('admin.viewvehicle', compact('vehicle'));
        }
        
    }


    // public function active($id)
    // {
    //     $vehicle = DB::table('ticket_mng')->where('id', $id ,'status=1')->first();
    //     if(!empty($vehicle))
    //     {
    //         return view('admin.viewvehicle', compact('vehicle'));
    //     }
        
    // }


    //Functions added today

    public function getAllDivisionsForTheSelectedZone(Request $request)
    {
        $data['divisions'] = Division::where("zone_id",$request->zoneNum)->where("status",1)->get(["name","id"]);
        return response()->json($data);
    }    


    public function getAllWardsForTheSelectedDivision(Request $request)
    {
        $data['wards'] = Ward::where("division_id",$request->divisionNum)->where("status",1)->get(["name","id"]);
        return response()->json($data);
    }
    
    
    public function manageRegdVehs()
    {
        /*$datas = DB::table('customers')
            ->join('pick', 'customers.id', '=', 'pick.cust_id')
            ->join('dump', 'pick.id', '=', 'dump.pid')
            ->get(['customers.vno as Vehicle_num', 'pick.waste','pick.zone','pick.division','pick.ward', 'pick.created_at as Picked_up_on', 'dump.created_at as Dumped_on', "customers.status", "customers.id"]);
            
       
         
        return view('admin.vehicle', compact('datas'));*/
        
        
        
        if(request()->ajax()) {
            $data = DB::table('customers')
            ->get(["customers.id", 'customers.vno as Vehicle_num', 'customers.dname as Driver_name', 'customers.oname as Owner_name', "customers.status"])
            ->where("status",1);
            
           
            return DataTables::of($data)
        
           
            ->addColumn('Vehicle_num', function($data){
                
                if(empty($data)){
                    $vehnum = $data->Vehicle_num;
                }else{
                $vehnum = $data->Vehicle_num;
                }
                return $vehnum;
            })
            
            ->addColumn('Driver_name', function($data){
                
                if(empty($data)){
                    $driverHesaru = $data->Driver_name;
                }else{
                $driverHesaru = $data->Driver_name;
                }
                return $driverHesaru;
            })
            
            ->addColumn('Owner_name', function($data){
                
                if(empty($data)){
                    $ownerHesaru = $data->Owner_name;
                }else{
                $ownerHesaru = $data->Owner_name;
                }
                return $ownerHesaru;
            })
            
            ->addColumn('status', function($data){
    
                if($data->status != null){

                    if($data->status == 1){
                            $status = '<span class="badge badge-success">Registered</span>';
        
                    }
                   
                    else{
                        $status = '<span class="badge badge-danger">Another</span>';
                    }
    
                    return $status;
                }
            })
                
            ->addColumn('action', function($data){
    
                $button = '<div class = "">';
                
                $button .= ' <a href="'.url('admin/regdVehDetails/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';          
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['Vehicle_num', 'Driver_name', 'Owner_name', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.vehicle');
    }
    
    
    public function viewThisRegVehDetails($id)
    {
        /*$regdVehDets = DB::select("Select id, vimage, lcimage, oimage, oname, address, ophone, lcno, vno, dadrimage, dname, dphone, qrcode from customers where id=$id");
        
        return view('admin.viewThisRegVehicleDetails', compact('regdVehDets'));*/
        
        
        $regdVehDets = DB::select("Select id, phone, vno, vimage, oname, ophone, address, oimage, oadr, oadrimage, dname, dphone, daddress, lcno, lcimage, dadr, dadrimage, qrcode from customers where id=$id");
        
        return view('admin.viewThisRegVehicleDetails', compact('regdVehDets'));
    }
    
    
    public function showRegdVehsHistory($id)
    {
        /*echo "<script type='text/javascript'>alert('43'); </script>";
        exit();*/
        
        if(request()->ajax()) {
            $data = DB::table('customers')
            ->join('pick', 'customers.id', '=', 'pick.cust_id')
            ->join('dump', 'pick.id', '=', 'dump.pid')
            ->where("customers.id", $id)
            ->orderBy("pick.created_at", "asc")
            ->get(['customers.vno as Vehicle_num', 'pick.waste', 'pick.created_at as Picked_up_on', 'dump.created_at as Dumped_on', "customers.status", "customers.id"]);
    
        
            //dd($data);
    
            return DataTables::of($data)
        
            
            ->addColumn('Vehicle_num', function($data){
                
                if(empty($data)){
                    $vehnum = $data->Vehicle_num;
                }else{
                $vehnum = $data->Vehicle_num;
                }
                return $vehnum;
            })
            ->addColumn('waste', function($data){
                
                if(empty($data)){
                    $waste = $data->waste;
                }else{
                $waste = $data->waste;
                }
                return $waste;
            })
            
            ->addColumn('Picked_up_on', function($data){
                
                $arr1 = explode(" ", $data->Picked_up_on);
                $pickupDatePart = $arr1[0];
                
                $pickupDate = '<p>'.date("d/m/Y", strtotime($pickupDatePart)).'</p>';
                return $pickupDate;
            })
            
            ->addColumn('Dumped_on', function($data){
                
                $arr2 = explode(" ", $data->Dumped_on);
                $dumpDatePart = $arr2[0];
                
                $dumpDate = '<p>'.date("d/m/Y", strtotime($dumpDatePart)).'</p>';
                return $dumpDate;
            })
            
            ->addColumn('status', function($data){
    
                if($data->status != null){

                    if($data->status == 1){
                            $status = '<span class="badge badge-success">Registered</span>';
        
                    }
                   
                    else{
                        $status = '<span class="badge badge-danger">Another</span>';
                    }
    
                    return $status;
                }
            })
           
            ->rawColumns(['Vehicle_num', 'status', 'Dumped_on', 'Picked_up_on', 'waste'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.viewThisRegVehicleDetails');
    }
    
    
    public function addVehicle(Request $request)
    {
        //Admin adding vehicle
        
        $chkexist =  DB::table('customers')->where('phone', $request->input('custphone'))->first();

        if(!empty($chkexist))
        {
            //return redirect()->route('admincampaign.add')->with('error', 'This Mobile number is already registered');
            
            echo "<script type='text/javascript'>alert('This Mobile number is already registered'); location.href='campaign/add'; </script>";
            return;
        }
        
        else
        {
            $data['phone'] = $request->input('custphone');      //Customer phone#
            $data['vno'] = $request->input('vehno');        //Customer vehicle#
            $data['oname'] = $request->input('owner_name');     //Owner name
            $data['ophone'] = $request->input('owner_phone');   //Owner phone#
            $data['address'] = $request->input('owner_addr');   //Owner address
            $data['oadr'] = $request->input('owner_aadhar_num');    //Owner Aadhar#
            $data['dname'] = $request->input('driver_name');    //Driver name
            $data['dphone'] = $request->input('driver_phone');  //Driver phone#
            $data['daddress'] = $request->input('driver_addr');     //Driver address
            $data['lcno'] = $request->input('driver_licnum');       //Driver License Num
            $data['dadr'] = $request->input('driver_aadhar_num');   //Driver Aadhar#

            $data['password'] = Hash::make($request->pswd);
            $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $data['status'] = '1';
            
            
            if($request->file('vehphoto'))      //Customer vehicle photo
            {
                $file= $request->file('vehphoto');
               
                $filename= uniqid().$file->getClientOriginalName();
                $file->move(public_path('uploads/customer'), $filename);
                $data['vimage']= $filename;
            }
            
            if($request->file('owner_photo'))
            {
                $file= $request->file('owner_photo');
                $filename= uniqid().$file->getClientOriginalName();
                $file->move(public_path('uploads/customer'), $filename);
                $data['oimage']= $filename;
            }
            
            if($request->file('owner_aadhar_img'))      //Owner Aadhar Card image upload
            {
                $file= $request->file('owner_aadhar_img');
                $filename=  uniqid().$file->getClientOriginalName();
                $file->move(public_path('uploads/customer'), $filename);
                $data['oadrimage']= $filename;
            }
            
            if($request->file('driver_licimg'))
            {
                $file= $request->file('driver_licimg');
                $filename= uniqid().$file->getClientOriginalName();
                $file->move(public_path('uploads/customer'), $filename);
                $data['lcimage']= $filename;
            }
            
            if($request->file('driver_aadhar_img'))     //Driver Aadhar Card image upload
            {
                $file= $request->file('driver_aadhar_img');
                $filename= uniqid().$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['dadrimage']= $filename;
            }
            

            $cstresult = DB::table('customers')->insert($data);
             
            
            $v =  DB::getPdo()->lastInsertId();
            $upd['reg_id'] = "CDWMS00".$v;
            
            $url = $v;
            $qrCode = QrCode::format('png')->size(250)->margin(2)->generate($url); 
            $flname = date("dmyhis").".png";
            Storage::disk('img')->put("CDWMS00".$v.$flname, $qrCode);
            
            $upd["qrcode"] = "CDWMS00".$v.$flname;
            
            DB::table('customers')->where('id', $v)->update($upd);
            
            if($cstresult)
            {
                //return redirect()->route('adminvehicle')->with('success', 'Vehicle added successfully!!');
                
                echo "<script>alert('Vehicle added successfully!!'); location.href='vehicle'; </script>";
            }
            
            else
            {
                return redirect()->back()->with('error', 'Invalid inputs you entered');
            }
        }
    }
}