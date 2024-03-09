<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Permissions;

use App\Models\Roles;

use App\Models\Modules;

use App\Models\Submodules;

use App\Models\User;

use App\Models\Zone;

use App\Models\Division;

use App\Models\Ward;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class PermissionsController extends Controller
{
    public function managepermissions()
    {
        // $datas = Permissions::all();
          $datas = Permissions::select('permissions.*', 'roles.name as rolesname', 'pwa_admin.name as username')
            ->join('pwa_admin', 'pwa_admin.admin_id', '=', 'permissions.admin_id', 'left')
            ->join('roles', 'roles.id', '=', 'permissions.roles', 'left')
            ->get();
        
        if(request()->ajax()) {
            $data = Permissions::select('permissions.*', 'roles.name as rolesname', 'modules.name as modulesname', 'pwa_admin.name as username', 'zone.title as zonename')
            ->join('pwa_admin', 'pwa_admin.id', '=', 'permissions.admin_id', 'left')
            ->join('zone', 'zone.id', '=', 'permissions.zone', 'left')
            ->join('roles', 'roles.id', '=', 'permissions.roles', 'left')
            ->join('modules', 'modules.id', '=', 'permissions.modules', 'left')
            ->get();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->id;
                }else{
                $id = $data->id;
                }
                return $id;
            })
            ->addColumn('username', function($data){
                
                if(empty($data)){
                    $username = $data->username;
                }else{
                $username = $data->username;
                }
                return $username;
            })
            ->addColumn('zonename', function($data){
                
                if(empty($data)){
                    $zonename = $data->zonename;
                }else{
                $zonename = $data->zonename;
                }
                return $zonename;
            })
            ->addColumn('rolesname', function($data){
                
                if(empty($data)){
                    $rolesname = $data->rolesname;
                }else{
                $rolesname = $data->rolesname;
                }
                return $rolesname;
            })
            ->addColumn('modulesname', function($data){
                
                if(empty($data)){
                    $modulesname = $data->modulesname;
                }else{
                $modulesname = $data->modulesname;
                }
                return $modulesname;
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
                         $button .= ' <a href="'.url('admin/permissions/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="'.url('admin/permissions/delete/' . $data->id).'" class="btn btn-outline-danger-2x"><i class="icon-trash" ></i></a>
                            ';
                       }
                      
                        
                   }
                
                          
                           
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','username','rolesname','modulesname','id', 'zonename'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managepermissions', compact('datas'));
        
    }
    public function addpermissions()
    {
        $users = DB::table('pwa_admin')->select('pwa_admin.*')
        ->join('permissions', 'permissions.admin_id', '=', 'pwa_admin.admin_id','left')
        ->whereNull('permissions.admin_id') 
        ->where('pwa_admin.admin_id','>',1 )
        ->where('pwa_admin.status', 1)->get();
        return view('admin.permissions', compact('users'));
    }
     public function permissions(Request $request)
    {
        $data['roles'] = $request->roles;
        $data['modules'] = implode(",",$request->modules);
        // $data['submodules'] = $request->submodules;
        // $data['zone'] = $request->zone;
        // $data['division'] = $request->division;
        $data['ward'] = implode(",",$request->ward);
        $data['admin_id'] = $request->users;
        $data['status'] = $request->status ? "1" : "0";
       
        $permissionsresult = DB::table('permissions')->insert($data);
        
        
        //capabilities
        
        if(!empty($request->capab))
            {
                $capab['admin_id'] = $request->users;
                $capab['name'] = implode(",",$request->capab);
                DB::table('pwa_user_capabilities')->insert($capab);
            }
        
        // admin roles
        
        //  $re = $request->roles;
        //  foreach($re as $rolesdata){
        //     $rolesd['admin_id'] = $request->users;
        //     $rolesd['roles_id'] = $rolesdata;
        //     DB::table('pwa_user_roles')->insert($rolesd);
        //  }
        
        
        
        if(!empty($permissionsresult))
        {
           return redirect()->route('adminpermissions')->with ('succes', 'Permissions added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editpermissions($id)
    {
        
        $permissions['det'] = Permissions::where('id', $id)->first();
        $permissions['users'] = DB::table('pwa_admin')->where('admin_id','>',1 )->where('status', 1)->get();
        $permissions['roles'] = Roles::where('status', 1)->get();
        $permissions['modules'] = Modules::where('status', 1)->get();
        // $permissions['submodules'] = Submodules::where('status', 1)->get();
        // $permissions['zones'] = Zone::where('status', 1)->get();
        $permissions['wards'] = Ward::where('status', 1)->get();
        // $permissions['divisions'] = Division::where('status', 1)->get();
        return view('admin.editpermissions', compact('permissions'));
    }
    public function updatepermissions(Request $request, $id)
    {
        
        $permissions['roles'] = $request->roles;
        $permissions['modules'] = implode(",",$request->modules);
        $permissions['ward'] = implode(",",$request->ward);
        // $permissions['submodules'] = $request->submodules;
        // $permissions['zone'] = $request->zone;
        // $permissions['division'] = $request->division;
        // $permissions['ward'] = $request->ward;
        $permissions['admin_id'] = $request->users;
        $permissions['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('permissions')->where('id', $id)->update($permissions);
       
       DB::table('pwa_user_capabilities')->where('admin_id', $request->users)->delete();
        //capabilities
        
        if(!empty($request->capab))
            {
                $capab['admin_id'] = $request->users;
                $capab['name'] = implode(",",$request->capab);
                DB::table('pwa_user_capabilities')->insert($capab);
            }
        
        
        
        if(!empty($upded))
        {
          return redirect()->route('adminpermissions')->with ('succes', 'Permissions updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletepermissions($id)
    {
        $deletd = DB::table('permissions')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminpermissions')->with ('succes', 'Roles & Permissions deleted successfully');
        }
        
    }
    
}