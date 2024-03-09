<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Country;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class CountryController extends Controller
{
    public function managecountry()
    {
        
        if(request()->ajax()) {
            $data = Country::all();
    
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
                
                $image = '<img src="'.asset('uploads/country/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/country/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/country/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managecountry');
        
    }
    public function addcountry()
    {
         
        return view('admin.country');
        
    }
     public function country(Request $request)
    {
        $data['name'] = $request->name;
        $data['name_ka'] = $request->name_ka;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/country'), $filename);
            $data['image']= $filename;
        }

        $countryresult = DB::table('pwa_country')->insert($data);
        if(!empty($countryresult))
        {
           return redirect()->route('admincountry')->with ('succes', 'Country added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editcountry($id)
    {
        $country = Country::where('id', $id)->first();
        return view('admin.editcountry', compact('country'));
    }
    public function updatecountry(Request $request, $id)
    {
        
        $country['name'] =$request->name;
        $country['name_ka'] = $request->name_ka;
        $country['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/country'), $filename);
            $country['image']= $filename;
        }
        
       $upded = DB::table('pwa_country')->where('id', $id)->update($country);
        
        if(!empty($upded))
        {
          return redirect()->route('admincountry')->with ('succes', 'Country updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletecountry($id)
    {
        $deletd = DB::table('pwa_country')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admincountry')->with ('succes', 'Country deleted successfully');
        }
        
    }
    public function viewcountry($id)
    {
        $country = DB::table('pwa_country')->where('id', $id)->first();
        if(!empty($country))
        {
            return view('admin.viewcountry', compact('country'));
        }
        
    }
}