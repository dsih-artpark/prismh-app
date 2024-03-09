<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class UserController extends Controller
{
    public function manageuser()
    {
        
        if(request()->ajax()) {
            $data = User::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->admin_id;
                }else{
                $id = $data->admin_id;
                }
                return $id;
            })
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/profile/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                       if($rolid > 1){
                       if($resd == "Edit")
                       {
                          $button .= '
                 <a href="'.url('admin/user/edit/' . $data->admin_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                  
                  ';
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '
                <a href="javascript:void(0)" data-id="'.$data->admin_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->admin_id.'"></i></a>
                  ';
                       }
                      
                       }
                       if($rolid == 1){
                          
                               if($resd == "Edit")
                               {
                                  $button .= '<a href="'.url('admin/user/edit/' . $data->admin_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                               }
                               if($resd == "Delete")
                               {
                               $button .= '<a href="javascript:void(0)" data-id="'.$data->admin_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->admin_id.'"></i></a>';
                               }
                           
                      
                       }
                   }
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.manageuser');
        
    }
    public function adduser()
    {
         
        return view('admin.user');
        
    }
     public function user(Request $request)
    {

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/profile'), $filename);
            $data['image']= $filename;
        }

        $userresult = DB::table('pwa_admin')->insert($data);
        $adid =  DB::getPdo()->lastInsertId();
        
        //capabilities
        
        // if(!empty($request->capab))
        //     {
        //         $capab['admin_id'] = $adid;
        //         $capab['name'] = implode(",",$request->capab);
        //         DB::table('pwa_user_capabilities')->insert($capab);
        //     }
        
        // admin roles
        
        //  $re = $request->roles_id;
        //  foreach($re as $rolesdata){
        //     $rolesd['admin_id'] = $adid;
        //     $rolesd['roles_id'] = $rolesdata;
        //     DB::table('pwa_user_roles')->insert($rolesd);
        //  }
       
        
        
        
        if(!empty($userresult))
        {
           return redirect()->route('adminuser')->with ('succes', 'User added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function edituser($id)
    {
        $user['det'] = User::where('admin_id', $id)->first();
        return view('admin.edituser', compact('user'));
    }
    public function updateuser(Request $request, $id)
    {
        
        $user['name'] =$request->name;
        $user['email'] = $request->email;
        $user['password'] = $request->password;
        $user['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/profile'), $filename);
            $user['image']= $filename;
        }
        
        
       $upded = DB::table('pwa_admin')->where('admin_id', $id)->update($user);
       
        // $adid =  $id;
        //  DB::table('pwa_user_capabilities')->where('admin_id', $adid)->delete();
        //   DB::table('pwa_user_roles')->where('admin_id', $adid)->delete();
          
        //capabilities
        
        // if(!empty($request->capab))
        //     {
        //         $capab['admin_id'] = $adid;
        //         $capab['name'] = implode(",",$request->capab);
        //         DB::table('pwa_user_capabilities')->insert($capab);
        //     }
            
        // admin roles
        
        //  $re = $request->roles_id;
        //  foreach($re as $rolesdata){
        //     $rolesd['admin_id'] = $adid;
        //     $rolesd['roles_id'] = $rolesdata;
        //     $al = DB::table('pwa_user_roles')->insert($rolesd);
        //  }
         
         
        if(!empty($upded))
        {
          return redirect()->route('adminuser')->with ('succes', 'User updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteuser($id)
    {
        $deletd = DB::table('pwa_admin')->where('admin_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminuser')->with ('succes', 'User deleted successfully');
        }
        
    }
    public function viewuser($id)
    {
        $user = DB::table('pwa_admin')->where('admin_id', $id)->first();
        if(!empty($user))
        {
            return view('admin.viewuser', compact('user'));
        }
        
    }
    public function modules()
    {
        $result = DB::table('pwa_admin_roles')->get();
         $response = $result;
        return response()->json($response); 
        
    }
}