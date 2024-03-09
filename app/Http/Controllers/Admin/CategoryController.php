<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Category;
use App\Models\Division;
use App\Models\Ward;
use App\Models\Complaints;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class CategoryController extends Controller
{
    public function managecategory()
    {
        
        $datas = DB::table('customers')
            ->join('pick', 'customers.id', '=', 'pick.cust_id')
            ->join('dump', 'dump.pid', '=', 'pick.id')
            ->get(['pick.id','pick.zone','pick.division','pick.ward', 'customers.vno as vehicle_num', 'pick.waste as waste_type', 'pick.created_at as waste_picked_up_on', 'dump.created_at as waste_dumped_on', 'pick.status']);
        
        
         
        return view('admin.managecategory', compact('datas'));
    }
    
    
    
    public function managecategoryOldCode()
    {
        
        if(request()->ajax()) {
            $data = Category::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->id;
                }else{
                $id = $data->id;
                }
                return $id;
            })
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/category/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/category/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/category/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managecategory');
        
    }
    public function addcategory()
    {
         
        return view('admin.category');
        
    }
     public function category(Request $request)
    {
        $data['name'] = $request->name;
        $data['name_ka'] = $request->name_ka;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/category'), $filename);
            $data['image']= $filename;
        }

        $categoryresult = DB::table('pwa_category')->insert($data);
        if(!empty($categoryresult))
        {
           return redirect()->route('admincategory')->with ('succes', 'Category added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editcategory($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.editcategory', compact('category'));
    }
    public function updatecategory(Request $request, $id)
    {
        
        $category['name'] =$request->name;
        $category['name_ka'] = $request->name_ka;
        $category['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/category'), $filename);
            $category['image']= $filename;
        }
        
       $upded = DB::table('pwa_category')->where('id', $id)->update($category);
        
        if(!empty($upded))
        {
          return redirect()->route('admincategory')->with ('succes', 'Category updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletecategory($id)
    {
        $deletd = DB::table('pwa_category')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admincategory')->with ('succes', 'Category deleted successfully');
        }
        
    }
    public function viewcategory($id)
    {
        $category = DB::table('pwa_category')->where('id', $id)->first();
        if(!empty($category))
        {
            return view('admin.viewcategory', compact('category'));
        }
        
    }
    
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
    
    
    public function viewThisWasteInfoDetails($id)
    {
        //New SQL query
        
        //$pickUpWasteInfo = DB::select("Select image_data as 'Pickup_img', latit as 'Pickup_Geolocn', created_at as 'Pick_up_timestamp', latit as 'Pickup_ImgGeolocn', descp, phone, waste from pick where id=$id");
        
        $pickUpWasteInfo = DB::select("Select wp.image_data as 'Pickup_img', wp.created_at as 'Pick_up_timestamp', wp.descp, wp.phone, wp.waste, z.title as 'Zone', d.name as 'Division', w.name as 'Ward' from pick wp inner join zone z on wp.zone=z.id inner join division d on wp.division=d.id inner join ward w on wp.ward=w.id and wp.id=$id");
        
        //$dumpWasteInfo = DB::select("Select image_data as 'Dump_img', latit as 'Dump_Geolocn', latit as 'Dump_ImgGeolocn', created_at as 'Dump_timestamp', descp, phone from dump where pid=$id");
        
        $dumpWasteInfo = DB::select("Select wd.image_data as 'Dump_img', wd.created_at as 'Dump_timestamp', wd.descp, wd.phone, wd.dstatus as 'Dump_status', z.title as 'Zone', d.name as 'Division', w.name as 'Ward' from dump wd inner join zone z on wd.zone=z.id inner join division d on wd.division=d.id inner join ward w on wd.ward=w.id and wd.pid=$id");
        $driverDetails = DB::select("Select cust.dname, cust.dphone, cust.daddress from customers cust inner join pick p on cust.id=p.cust_id and p.id=$id");
        $ownerDetails = DB::select("Select cust.oname, cust.ophone, cust.address from customers cust inner join pick p on cust.id=p.cust_id and p.id=$id");
        
        /*print_r($fetchSpecificWasteInfoQ);
        exit();*/
        
        /*if(!empty($pickUpWasteInfo))
        {*/
            return view('admin.viewThisWasteInfo', compact("pickUpWasteInfo", "dumpWasteInfo", 'driverDetails', 'ownerDetails'));
        //}
        
        /*if(!empty($dumpWasteInfo))
        {
            return view('admin.viewThisWasteInfo', compact("dumpWasteInfo"));
        }*/
    }
}