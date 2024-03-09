<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Referalstatus;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ReferalstatusController extends Controller
{
    public function managereferalstatus()
    {
        
        if(request()->ajax()) {
            $data = Referalstatus::all();
    
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
                          $button .= ' <a href="'.url('admin/referalstatus/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/referalstatus/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managereferalstatus');
        
    }
    public function addreferalstatus()
    {
         
        return view('admin.referalstatus');
        
    }
     public function referalstatus(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "0";
        
       
        $referalstatusresult = DB::table('pwa_referalstatus')->insert($data);
        if(!empty($referalstatusresult))
        {
           return redirect()->route('adminreferalstatus')->with ('succes', 'Priorities added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editreferalstatus($id)
    {
        $referalstatus = Referalstatus::where('id', $id)->first();
        return view('admin.editreferalstatus', compact('referalstatus'));
    }
    public function updatereferalstatus(Request $request, $id)
    {
        
        $referalstatus['name'] =$request->name;
        $referalstatus['status'] = $request->status ? "1" : "0";
        
       
        
       $upded = DB::table('pwa_referalstatus')->where('id', $id)->update($referalstatus);
        
        if(!empty($upded))
        {
          return redirect()->route('adminreferalstatus')->with ('succes', 'Priorities updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletereferalstatus($id)
    {
        $deletd = DB::table('pwa_referalstatus')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminreferalstatus')->with ('succes', 'Priorities deleted successfully');
        }
        
    }
    public function viewreferalstatus($id)
    {
        $referalstatus = DB::table('pwa_referalstatus')->where('id', $id)->first();
        if(!empty($referalstatus))
        {
            return view('admin.viewreferalstatus', compact('referalstatus'));
        }
        
    }
}