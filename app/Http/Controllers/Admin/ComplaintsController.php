<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Complaints;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ComplaintsController extends Controller
{
    public function managecomplaints()
    {

        $data = Complaints::all();
        
        // if(request()->ajax()) {
        //     $data = complaints::all();
    
        //     return DataTables::of($data)
        
        //     ->addColumn('id', function($data){
                
        //         if(empty($data)){
        //             $id = $data->id;
        //         }else{
        //         $id = $data->id;
        //         }
        //         return $id;
        //     })
            
        //     ->addColumn('name',function($data){
        //         $name =  '<p class="text-capitalize">'.$data->name.'</p>';
        //         return $name;
        //     })
           
        //     ->addColumn('status', function($data){
    
                    

        //                 if($data->status == 1){
        //                         $status = '<span class="badge badge-success"> Activated</span>';
            
        //                     }
                           
        //                     else if($data->status == 0){
        //                         $status = '<span class="badge badge-danger">Not Activated</span>';
        //                     }
        //                     else{
        //                         $status = '<span class="badge badge-danger">Not defined</span>';
        //                     }
            
        //                     return $status;

                    
                    
        //         })
        //     ->addColumn('action', function($data){
    
        //         $button = '<div class = "">';
                
                 
        //         $rolid = session('admin.admin_id');
        //         $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
        //         $va = explode(',', $rol->name);
                  
        //            foreach($va as $resd)
        //            {
        //                if($resd == "Edit")
        //                {
        //                   $button .= ' <a href="'.url('admin/complaints/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
        //                }
        //                if($resd == "Delete")
        //                {
                           
        //                    $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
        //                     ';
        //                }
        //                if($resd == "View"){
        //                     $button .= ' <a href="'.url('admin/complaints/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
        //                }
                        
        //            }
                
                
        //         $button .= '</div>';
        //         return $button;
        //     })
           
        //     ->rawColumns(['action','status','name','id'])
        //     ->addIndexColumn()
        //     ->make(true);
                
        // }
         
        return view('admin.managecomplaints', compact('data'));
        
    }
    public function addcomplaints()
    {
         
        return view('admin.complaints');
        
    }
     public function complaints(Request $request)
    {
        $data['name'] = $request->name;
        // $data['name_ka'] = $request->name_ka;
        $data['status'] = $request->status ? "1" : "0";
        
        // if($request->file('image'))
        // {
        //     $file= $request->file('image');
        //     $filename= date('YmdHis').$file->getClientOriginalName();
        //     $file-> move(public_path('uploads/complaints'), $filename);
        //     $data['image']= $filename;
        // }

        $complaintsresult = DB::table('complaints_pwa')->insert($data);
        if(!empty($complaintsresult))
        {
           return redirect()->route('admincomplaints')->with ('succes', 'complaints added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editcomplaints($id)
    {
        $complaints = complaints::where('id', $id)->first();
        return view('admin.editcomplaints', compact('complaints'));
    }
    public function updatecomplaints(Request $request, $id)
    {
        
        $complaints['name'] =$request->name;
        // $complaints['name_ka'] = $request->name_ka;
        $complaints['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/complaints'), $filename);
            $complaints['image']= $filename;
        }
        
       $upded = DB::table('complaints_pwa')->where('id', $id)->update($complaints);
        
        if(!empty($upded))
        {
          return redirect()->route('admincomplaints')->with ('succes', 'complaints updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletecomplaints($id)
    {
        $deletd = DB::table('complaints_pwa')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admincomplaints')->with ('succes', 'complaints deleted successfully');
        }
        
    }
    public function viewcomplaints($id)
    {
        $complaints = DB::table('complaints_pwa')->where('id', $id)->first();
        if(!empty($complaints))
        {
            return view('admin.viewcomplaints', compact('complaints'));
        }
        
    }
}