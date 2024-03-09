<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Department;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class DepartmentController extends Controller
{
    public function managedepartment()
    {
        
        if(request()->ajax()) {
            $data = Department::all();
    
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
                          $button .= ' <a href="'.url('admin/department/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                    //   if($resd == "View"){
                    //         $button .= ' <a href="'.url('admin/department/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                    //   }
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managedepartment');
        
    }
    public function adddepartment()
    {
         
        return view('admin.department');
        
    }
     public function department(Request $request)
    {
        $data['name'] = $request->name;
        
        $data['status'] = $request->status ? "1" : "0";

        $departmentresult = DB::table('pwa_department')->insert($data);
        if(!empty($departmentresult))
        {
           return redirect()->route('admindepartment')->with ('succes', 'Department added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editdepartment($id)
    {
        $department = Department::where('id', $id)->first();
        return view('admin.editdepartment', compact('department'));
    }
    public function updatedepartment(Request $request, $id)
    {
        $department['name'] =$request->name;
        $department['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('pwa_department')->where('id', $id)->update($department);
        
        if(!empty($upded))
        {
          return redirect()->route('admindepartment')->with ('succes', 'Department updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
    }
    public function deletedepartment($id)
    {
        $deletd = DB::table('pwa_department')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admindepartment')->with ('succes', 'Department deleted successfully');
        }
        
    }
    public function viewdepartment($id)
    {
        $department = DB::table('pwa_department')->where('id', $id)->first();
        if(!empty($department))
        {
            return view('admin.viewdepartment', compact('department'));
        }
        
    }
}