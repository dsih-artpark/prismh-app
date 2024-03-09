<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Referencetype;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ReferencetypeController extends Controller
{
    public function managereferencetype()
    {
        
        if(request()->ajax()) {
            $data = Referencetype::all();
    
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
                          $button .= ' <a href="'.url('admin/referencetype/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/referencetype/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managereferencetype');
        
    }
    public function addreferencetype()
    {
         
        return view('admin.referencetype');
        
    }
     public function referencetype(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "0";
        
       
        $referencetyperesult = DB::table('pwa_referencetype')->insert($data);
        if(!empty($referencetyperesult))
        {
           return redirect()->route('adminreferencetype')->with ('succes', 'Referencetype added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editreferencetype($id)
    {
        $referencetype = Referencetype::where('id', $id)->first();
        return view('admin.editreferencetype', compact('referencetype'));
    }
    public function updatereferencetype(Request $request, $id)
    {
        
        $referencetype['name'] =$request->name;
        $referencetype['status'] = $request->status ? "1" : "0";
        
       
        
       $upded = DB::table('pwa_referencetype')->where('id', $id)->update($referencetype);
        
        if(!empty($upded))
        {
          return redirect()->route('adminreferencetype')->with ('succes', 'Referencetype updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletereferencetype($id)
    {
        $deletd = DB::table('pwa_referencetype')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminreferencetype')->with ('succes', 'Referencetype deleted successfully');
        }
        
    }
    public function viewreferencetype($id)
    {
        $referencetype = DB::table('pwa_referencetype')->where('id', $id)->first();
        if(!empty($referencetype))
        {
            return view('admin.viewreferencetype', compact('referencetype'));
        }
        
    }
}