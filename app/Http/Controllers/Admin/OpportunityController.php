<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Opportunitytype;

use App\Models\Opportunityconnect;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class OpportunityController extends Controller
{
    public function manageopportunitytype()
    {
        
        if(request()->ajax()) {
            $data = Opportunitytype::all();
    
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
                          $button .= ' <a href="'.url('admin/opportunitytype/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/opportunitytype/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.manageopportunitytype');
        
    }
    public function addopportunitytype()
    {
         
        return view('admin.opportunitytype');
        
    }
     public function opportunitytype(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "0";
        
        $opportunitytyperesult = DB::table('pwa_opportunitytype')->insert($data);
        if(!empty($opportunitytyperesult))
        {
           return redirect()->route('adminopportunitytype')->with ('succes', 'Requirement Type added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editopportunitytype($id)
    {
        $opportunitytype = Opportunitytype::where('id', $id)->first();
        return view('admin.editopportunitytype', compact('opportunitytype'));
    }
    public function updateopportunitytype(Request $request, $id)
    {
        
        $opportunitytype['name'] =$request->name;
        $opportunitytype['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('pwa_opportunitytype')->where('id', $id)->update($opportunitytype);
        
        if(!empty($upded))
        {
          return redirect()->route('adminopportunitytype')->with ('succes', 'Requirement Type updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteopportunitytype($id)
    {
        $deletd = DB::table('pwa_opportunitytype')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminopportunitytype')->with ('succes', 'Requirement Type deleted successfully');
        }
        
    }
    public function viewopportunitytype($id)
    {
        $opportunitytype = DB::table('pwa_opportunitytype')->where('id', $id)->first();
        if(!empty($opportunitytype))
        {
            return view('admin.viewopportunitytype', compact('opportunitytype'));
        }
        
    }
    
    
    public function manageopportunityconnect()
    {
        
        if(request()->ajax()) {
            $data = Opportunityconnect::all();
    
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
                          $button .= ' <a href="'.url('admin/opportunityconnect/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/opportunityconnect/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.manageopportunityconnect');
        
    }
    public function addopportunityconnect()
    {
         
        return view('admin.opportunityconnect');
        
    }
     public function opportunityconnect(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "0";
        
        $opportunityconnectresult = DB::table('pwa_opportunityconnect')->insert($data);
        if(!empty($opportunityconnectresult))
        {
           return redirect()->route('adminopportunityconnect')->with ('succes', 'Opportunityconnect added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editopportunityconnect($id)
    {
        $opportunityconnect = Opportunityconnect::where('id', $id)->first();
        return view('admin.editopportunityconnect', compact('opportunityconnect'));
    }
    public function updateopportunityconnect(Request $request, $id)
    {
        
        $opportunityconnect['name'] =$request->name;
        $opportunityconnect['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('pwa_opportunityconnect')->where('id', $id)->update($opportunityconnect);
        
        if(!empty($upded))
        {
          return redirect()->route('adminopportunityconnect')->with ('succes', 'Opportunityconnect updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteopportunityconnect($id)
    {
        $deletd = DB::table('pwa_opportunityconnect')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminopportunityconnect')->with ('succes', 'Opportunityconnect deleted successfully');
        }
        
    }
    public function viewopportunityconnect($id)
    {
        $opportunityconnect = DB::table('pwa_opportunityconnect')->where('id', $id)->first();
        if(!empty($opportunityconnect))
        {
            return view('admin.viewopportunityconnect', compact('opportunityconnect'));
        }
        
    }
}