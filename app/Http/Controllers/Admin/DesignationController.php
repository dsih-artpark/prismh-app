<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Designation;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class DesignationController extends Controller
{
    public function managedesignation()
    {
        
        if(request()->ajax()) {
            $data = Designation::all();
    
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
                
                $image = '<img src="'.asset('uploads/designation/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/designation/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/designation/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managedesignation');
        
    }
    public function adddesignation()
    {
         
        return view('admin.designation');
        
    }
     public function designation(Request $request)
    {
        $data['name'] = $request->name;
        $data['name_ka'] = $request->name_ka;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/designation'), $filename);
            $data['image']= $filename;
        }

        $designationresult = DB::table('pwa_designation')->insert($data);
        if(!empty($designationresult))
        {
           return redirect()->route('admindesignation')->with ('succes', 'Designation added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editdesignation($id)
    {
        $designation = Designation::where('id', $id)->first();
        return view('admin.editdesignation', compact('designation'));
    }
    public function updatedesignation(Request $request, $id)
    {
        
        $designation['name'] =$request->name;
        $designation['name_ka'] = $request->name_ka;
        $designation['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/designation'), $filename);
            $designation['image']= $filename;
        }
        
       $upded = DB::table('pwa_designation')->where('id', $id)->update($designation);
        
        if(!empty($upded))
        {
          return redirect()->route('admindesignation')->with ('succes', 'Designation updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletedesignation($id)
    {
        $deletd = DB::table('pwa_designation')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admindesignation')->with ('succes', 'Designation deleted successfully');
        }
        
    }
    public function viewdesignation($id)
    {
        $designation = DB::table('pwa_designation')->where('id', $id)->first();
        if(!empty($designation))
        {
            return view('admin.viewdesignation', compact('designation'));
        }
        
    }
}