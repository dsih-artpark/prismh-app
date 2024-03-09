<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\News;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth, File;

use Redirect;

use DataTables;

use Str;

use QrCode;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use App\Models\Division;
use App\Models\Ward;
use App\Models\Zone;
use App\Models\WastePickup;
use App\Models\WasteDump;

class AdminController extends Controller
{
    public function adminusers()
    {
         
        return view('admin.users');
        
    }
    public function users(Request $request)
    {
        $chkexist =  DB::table('customers')->where('roles', 2)->where('phone', $request->input('phone'))->first();
    
            if(!empty($chkexist))
            {
                return redirect()->back()->with('error', 'Mobile number already registered');
            }
            else
            {
                 $data['phone'] = $request->input('phone');
                $data['username'] = $request->input('name');
                $data['email'] = $request->input('email');
                $data['ward'] =  implode(",",$request->ward);
                
                $data['password'] = Hash::make($request->password);
                $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['status'] = '1';
                $data['roles'] = '2';
                
                $custdet = DB::table('customers')->insert($data);
                 
                
                $v =  DB::getPdo()->lastInsertId();
                $upd['reg_id'] = "BBMPMMS".$v;
                
                
                
                DB::table('customers')->where('id', $v)->update($upd);
                
                if(!empty($custdet))
                {
                   return redirect()->route('adminusers')->with ('succes', 'User added successfully');
                }
                else
                {
                    return back()->with('error','something are wrong.');
                }
        
            }
        
        
    }

    public function adminusersedit($id)
    {
      $user = DB::table('customers')->find($id);
      $roles = DB::table('roles')->get();
      $wards = DB::table('ward')->where('status', 1)->get();
      return view('admin.usersEdit', compact('user','roles','wards'));
    }
    public function usersupdate(Request $request, $id)
    {
      try{
        $data = $request->except('_token', 'password');
        if($request->password) 
        $data['password'] = Hash::make($request->password);
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        if($request->hasFile('id_card') && $request->id_card){
          $file = $request->id_card;
          $extension = File::extension($file->getClientOriginalName());
          $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
          $file->move(public_path('uploads/id_cards/'), $filename);
          $data['id_card'] = '/public/uploads/id_cards/'.$filename;
        }
        $user = DB::table('customers')->where('id', $id)->update($data);
        return redirect()->route('adminusers')->with ('succes', 'User updated successfully');
      } catch(\Throwable $e){
        return back()->with('error','Something went wrong.');
      }
    }
    public function manageusersapprovalsid($id, $sts)
    {
        if(Auth::guard('admin'))
        {
            
            $updata['status'] = $sts;
            
                 $data =  DB::table('customers')->where('id', $id)->update($updata);
                
                 if(!empty($data)){
                       return redirect()->route('adminusers')->with ('succes', 'Users status changed successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
                 }
           
        
        }
        else{
            return redirect()->route('adminLogin');
        }
    }
    public function listusers() 
    {
        if(Auth::guard('admin'))
        {
        
        $data =  DB::table('customers')->where('roles', 2)->get();
        
        return view('admin.manageuserslist', compact('data'));
        
        
        }
        else{
        return redirect()->route('adminLogin');
        }
    }
    public function dashboard()
    {
        if(Auth::guard('admin'))
        {
            $date = Carbon::now()->format('Y-m-d');
            
        $reports['reg'] = DB::table('customers')->where('status', 1)->paginate(10);
        $reports['count'] = DB::table('customers')->where('status', 1)->count();
        $reports['today'] = DB::table('customers')->where('created_at','like', $date.'%')->count();
        $reports['vibhag'] = DB::table('jm_blr_rs_vibhag')->orderBy('name','asc')->get();
             
        $zoneWiseWastePickUpCounts = DB::select("SELECT COUNT(p.id) as 'waste_pick_up_counts_in_all_active_zones' FROM `pick` p inner JOIN zone z on p.zone=z.id where z.status=1 group by p.zone"); 
        $zoneWiseWasteDumpCounts = DB::select("SELECT COUNT(d.id) as 'waste_dump_counts_in_all_active_zones' FROM `dump` d inner JOIN pick p on d.pid=p.id group by d.zone");
             
            //  dd($reports);
            return view('admin.dashboard', compact('reports', 'zoneWiseWastePickUpCounts', 'zoneWiseWasteDumpCounts'));
        }  
    }
    
    
    /*public function barGraph()
    {
        echo "<script type='text/javascript'>alert('I am in the barGraph func'); </script>";
    }*/
    
    public function getAllDivisionsForTheSelectedZone(Request $request)
    {
        $data['divisions'] = Division::where("zone_id",$request->zoneNum)->where("status",1)->get(["name", "id"]);
        return response()->json($data);
    }    


    public function getAllWardsForTheSelectedDivision(Request $request)
    {
        $data['wards'] = Ward::where("division_id",$request->divisionNum)->where("status",1)->get(["name","id"]);
        return response()->json($data);
    }
    
    public function edit_profile($id)
    {
        
         $profile = DB::table('pwa_admin')->select('*')->where('admin_id', $id)->first();
         
        return view('admin.editprofile', compact('profile'));
        
    }
    public function update_profile(Request $request, $id)
    {
        $profile['name'] =$request->name;
        $profile['email'] = $request->email;
        $profile['password'] = $request->password;
        $profile['address'] =$request->address;
        $profile['city'] = $request->city;
        $profile['country'] = $request->country;
        $profile['pin'] = $request->pincode;
        
        $profile['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/profile'), $filename);
            $profile['image']= $filename;
        }
        
       $upded = DB::table('pwa_admin')->where('admin_id', $id)->update($profile);
        
        if(!empty($upded))
        {
          return redirect()->route('admindashboard')->with ('succes', 'Updated admin details');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
    }
    public function managenews()
    {
        
        if(request()->ajax()) {
            $data = News::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->news_id;
                }else{
                $id = $data->news_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/news/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
                return $image;
            })
            ->addColumn('status', function($data){
    
                    if($data->status != null){

                        if($data->status == 1){
                                $status = '<span class="badge badge-success"> Activated</span>';
            
                            }
                           
                            else{
                                $status = '<span class="badge badge-danger">Not Activated</span>';
                            }
            
                            return $status;

                    }
                    
                })
            ->addColumn('action', function($data){
    
                $button = '<div class = "">';
                
                 $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                          $button .= ' <a href="'.url('admin/news/edit/' . $data->news_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->news_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->news_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/news/view/' . $data->news_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managenews');
        
    }
    public function addnews()
    {
         
        return view('admin.news');
        
    }
     public function news(Request $request)
    {
        $data['title'] = $request->title;
        $data['about'] = $request->about;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/news'), $filename);
            $data['image']= $filename;
        }

        $newsresult = DB::table('pwa_news')->insert($data);
        if(!empty($newsresult))
        {
           return redirect()->route('adminnews')->with ('succes', 'News added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editnews($id)
    {
        $news = News::where('news_id', $id)->first();
        return view('admin.editnews', compact('news'));
    }
    public function updatenews(Request $request, $id)
    {
        
        $news['title'] =$request->title;
        $news['about'] = $request->about;
        $news['descp'] = $request->textbox;
        $news['status'] = $request->status ? "1" : "0";
        $news['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/news'), $filename);
            $news['image']= $filename;
        }
        
       $upded = DB::table('pwa_news')->where('news_id', $id)->update($news);
        
        if(!empty($upded))
        {
          return redirect()->route('adminnews')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletenews($id)
    {
        $deletd = DB::table('pwa_news')->where('news_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminnews')->with ('succes', 'News added successfully');
        }
        
    }
    
    public function viewnews($id)
    {
        $news = DB::table('pwa_news')->where('news_id', $id)->first();
        if(!empty($news))
        {
            return view('admin.viewnews', compact('news'));
        } 
    }
    
    
    //Show active zone names in the bar graph
    
    /*public function fetchActiveZones()
    {
        $data['allzones'] = Zone::where("status",1)->get(["title"]);
        return response()->json($data);
    }*/
    
    
    //Get waste pickup counts in all active zones to show in the bar graph
    
    public function fetchPickupCounts()
    {
        //$data['allpickupcnts'] = DB::table('pick')->join('zone', 'pick.zone', '=', 'zone.id')->groupBy("pick.zone")->get(['pick.id'])->count();
        
        $data['allpickupcnts'] = DB::select("SELECT COUNT(p.id) as 'waste_pick_up_counts_in_all_active_zones' FROM `pick` p inner JOIN zone z on p.zone=z.id where z.status=1 group by p.zone");
        return response()->json($data);
    }
    
    
    //Zone filter only
    
    public function getTotalCandDPickedCntITZ(Request $request)
    {
        $data['wasteTotalPckITZCnt'] = WastePickup::where("zone", $request->zone)->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDPickedCntITZToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZCntToday'] = WastePickup::where("zone", $request->zone)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDDumpedCntITZ(Request $request)
    {
        $data['wasteTotalDmpITZCnt'] = WasteDump::where("zone", $request->dumpingzone)->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDDumpedCntITZToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wasteDmpITZCntToday'] = WasteDump::where("zone", $request->dumpingzone)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDUndumpedCntITZ(Request $request)
    {
        /*$g1 = getTotalCandDPickedCntITZ($request);
        $g2 = getTotalCandDDumpedCntITZ($request);*/
        
        //echo "<script>alert('$g1') alert('$g2'); </script>";
        
        
        $data['wasteTotalPckITZCnt'] = WastePickup::where("zone", $request->zone)->get(["id"])->count();
        $data['wasteTotalDmpITZCnt'] = WasteDump::where("zone", $request->zone)->get(["id"])->count();
        
        if($data['wasteTotalPckITZCnt'] > $data['wasteTotalDmpITZCnt'])
            $data['wasteTotalUndumpedITZCnt'] = $data['wasteTotalPckITZCnt']-$data['wasteTotalDmpITZCnt'];
            
        else
            $data['wasteTotalUndumpedITZCnt'] = $data['wasteTotalDmpITZCnt']-$data['wasteTotalPckITZCnt'];
            
        return response()->json($data);
    }
    
    
    public function getCandDUndumpedCntITZToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZCntToday'] = WastePickup::where("zone", $request->zone)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        $data['wasteDmpITZCntToday'] = WasteDump::where("zone", $request->zone)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        
        if($data['wastePckITZCntToday'] > $data['wasteDmpITZCntToday'])
            $data['wasteUndumpedITZCntToday'] = $data['wastePckITZCntToday']-$data['wasteDmpITZCntToday'];
            
        else
            $data['wasteUndumpedITZCntToday'] = $data['wasteDmpITZCntToday']-$data['wastePckITZCntToday'];
            
        return response()->json($data);
    }
    
    
    //Zone and division filters
    
    public function getTotalCandDPickedCntITZnD(Request $request)
    {
        $data['wasteTotalPckITZnDCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->get(["id"])->count();
        return response()->json($data);
    }
    
    
    public function getCandDPickedCntITZnDToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZnDCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDDumpedCntITZnD(Request $request)
    {
        $data['wasteTotalDmpITZnDCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDDumpedCntITZnDToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['totWasteDumpedITZToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDUndumpedCntITZnD(Request $request)
    {
        /*$g1 = getTotalCandDPickedCntITZ($request);
        $g2 = getTotalCandDDumpedCntITZ($request);*/
        
        //echo "<script>alert('$g1') alert('$g2'); </script>";
        
        
        $data['wasteTotalPckITZnDCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->get(["id"])->count();
        $data['wasteTotalDmpITZnDCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->get(["id"])->count();
        
        if($data['wasteTotalPckITZnDCnt'] > $data['wasteTotalDmpITZnDCnt'])
            $data['wasteTotalUndumpedITZCnt'] = $data['wasteTotalPckITZnDCnt']-$data['wasteTotalDmpITZnDCnt'];
            
        else
            $data['wasteTotalUndumpedITZCnt'] = $data['wasteTotalDmpITZnDCnt']-$data['wasteTotalPckITZnDCnt'];
            
        return response()->json($data);
    }
    
    public function getCandDUndumpedCntITZnDToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZnDCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        $data['totWasteDumpedITZToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        
        if($data['wastePckITZnDCntToday'] > $data['totWasteDumpedITZToday'])
            $data['wasteUndumpedITZCntToday'] = $data['wastePckITZnDCntToday']-$data['totWasteDumpedITZToday'];
            
        else
            $data['wasteUndumpedITZCntToday'] = $data['totWasteDumpedITZToday']-$data['wastePckITZnDCntToday'];
            
        return response()->json($data);
    }
    
    
    
    //Zone, division and ward filters
    
    public function getTotalCandDPickedCntITZDnW(Request $request)
    {
        $data['wasteTotalPckITZDnWCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDPickedCntITZDnWToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZDnWCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDDumpedCntITZDnW(Request $request)
    {
        $data['wasteTotalDmpITZDnWCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDDumpedCntITZDnWToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wasteTotalDmpITZDnWCntToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDUndumpedCntITZDnW(Request $request)
    {
        /*$g1 = getTotalCandDPickedCntITZ($request);
        $g2 = getTotalCandDDumpedCntITZ($request);*/
        
        //echo "<script>alert('$g1') alert('$g2'); </script>";
        
        
        $data['wasteTotalPckITZDnWCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->get(["id"])->count();
        $data['wasteTotalDmpITZDnWCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->get(["id"])->count();
        
        if($data['wasteTotalPckITZDnWCnt'] > $data['wasteTotalDmpITZDnWCnt'])
            $data['wasteTotalUndumpedITZDnWCnt'] = $data['wasteTotalPckITZDnWCnt']-$data['wasteTotalDmpITZDnWCnt'];
            
        else
            $data['wasteTotalUndumpedITZDnWCnt'] = $data['wasteTotalDmpITZDnWCnt']-$data['wasteTotalPckITZDnWCnt'];
            
        return response()->json($data);
    }
    
    public function getCandDUndumpedCntITZDnWToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZDnWCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        $data['wasteTotalDmpITZDnWCntToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        
        if($data['wastePckITZDnWCntToday'] > $data['wasteTotalDmpITZDnWCntToday'])
            $data['wasteUndumpedITZDnWCntToday'] = $data['wastePckITZDnWCntToday']-$data['wasteTotalDmpITZDnWCntToday'];
            
        else
            $data['wasteUndumpedITZDnWCntToday'] = $data['wasteTotalDmpITZDnWCntToday']-$data['wastePckITZDnWCntToday'];
            
        return response()->json($data);
    }
    
    
    //Zone, division, ward and date selection filters
    
    public function getTotalCandDPickedCntITZDWnDate(Request $request)
    {
        $data['wasteTotalPckITZDWnDateCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $request->selectDate." 00:00:00")->where("created_at", '<=', $request->selectDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDPickedCntITZDWnDateToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZDWnDateCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDDumpedCntITZDWnDate(Request $request)
    {
        $data['wasteTotalDmpITZDWnDateCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $request->selectDate." 00:00:00")->where("created_at", '<=', $request->selectDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDDumpedCntITZDWnDateToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wasteTotalDmpITZDWnDateCntToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDUndumpedCntITZDWnDate(Request $request)
    {
        $data['wasteTotalPckITZDWnDateCnt'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $request->selectDate." 00:00:00")->where("created_at", '<=', $request->selectDate." 23:59:59")->get(["id"])->count();
        $data['wasteTotalDmpITZDWnDateCnt'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $request->selectDate." 00:00:00")->where("created_at", '<=', $request->selectDate." 23:59:59")->get(["id"])->count();
        
        if($data['wasteTotalPckITZDWnDateCnt'] > $data['wasteTotalDmpITZDWnDateCnt'])
            $data['wasteTotalUndumpedITZDWnDateCnt'] = $data['wasteTotalPckITZDWnDateCnt']-$data['wasteTotalDmpITZDWnDateCnt'];
            
        else
            $data['wasteTotalUndumpedITZDWnDateCnt'] = $data['wasteTotalDmpITZDWnDateCnt']-$data['wasteTotalPckITZDWnDateCnt'];
            
        return response()->json($data);
    }
    
    public function getCandDUndumpedCntITZDWnDateToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckITZDWnDateCntToday'] = WastePickup::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        $data['wasteTotalDmpITZDWnDateCntToday'] = WasteDump::where("zone", $request->zone)->where("division", $request->mlacons)->where("ward", $request->ward)->where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        
        if($data['wastePckITZDWnDateCntToday'] > $data['wasteTotalDmpITZDWnDateCntToday'])
            $data['wasteUndumpedITZDWnDateCntToday'] = $data['wastePckITZDWnDateCntToday']-$data['wasteTotalDmpITZDWnDateCntToday'];
            
        else
            $data['wasteUndumpedITZDWnDateCntToday'] = $data['wasteTotalDmpITZDWnDateCntToday']-$data['wastePckITZDWnDateCntToday'];
            
        return response()->json($data);
    }
    
    
    //Date filter only
    
    public function getTotalCandDPickedCntFTD(Request $request)
    {
        $data['wasteTotalPckFTDCnt'] = WastePickup::where("created_at", '>=', $request->chosenDate." 00:00:00")->where("created_at", '<=', $request->chosenDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDPickedCntForToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckForTodayCnt'] = WastePickup::where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDDumpedCntFTD(Request $request)
    {
        $data['wasteTotalDmpFTDCnt'] = WasteDump::where("created_at", '>=', $request->chosenDumpDate." 00:00:00")->where("created_at", '<=', $request->chosenDumpDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getCandDDumpedCntForToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wasteDmpForTodayCnt'] = WasteDump::where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        return response()->json($data);
    }
    
    public function getTotalCandDUndumpedCntFTD(Request $request)
    {
        $data['wasteTotalPckFTDCnt'] = WastePickup::where("created_at", '>=', $request->undumpDate." 00:00:00")->where("created_at", '<=', $request->undumpDate." 23:59:59")->get(["id"])->count();
        $data['wasteTotalDmpFTDCnt'] = WasteDump::where("created_at", '>=', $request->undumpDate." 00:00:00")->where("created_at", '<=', $request->undumpDate." 23:59:59")->get(["id"])->count();
        
        if($data['wasteTotalPckFTDCnt'] > $data['wasteTotalDmpFTDCnt'])
            $data['wasteTotalUndumpedFTDCnt'] = $data['wasteTotalPckFTDCnt']-$data['wasteTotalDmpFTDCnt'];
            
        else
            $data['wasteTotalUndumpedFTDCnt'] = $data['wasteTotalDmpFTDCnt']-$data['wasteTotalPckFTDCnt'];
            
        return response()->json($data);
    }
    
    public function getCandDUndumpedCntForToday(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $presentDate = date("Y-m-d");
        
        $data['wastePckForTodayCnt'] = WastePickup::where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        $data['wasteDmpForTodayCnt'] = WasteDump::where("created_at", '>=', $presentDate." 00:00:00")->where("created_at", '<=', $presentDate." 23:59:59")->get(["id"])->count();
        
        if($data['wastePckForTodayCnt'] > $data['wasteDmpForTodayCnt'])
            $data['wasteUndumpedForTodayCnt'] = $data['wastePckForTodayCnt']-$data['wasteDmpForTodayCnt'];
            
        else
            $data['wasteUndumpedForTodayCnt'] = $data['wasteDmpForTodayCnt']-$data['wastePckForTodayCnt'];
            
        return response()->json($data);
    }
}