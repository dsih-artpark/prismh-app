<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Role;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class RoleController extends Controller
{
    public function managerole()
    {
        $roles = Role::all();
         
        return view('admin.managerole', compact('roles'));
        
    }
    public function addrole()
    {
         
        return view('admin.role');
        
    }
     public function role(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "2";
        
        $roleresult = DB::table('roles')->insert($data);
        if(!empty($roleresult))
        {
           return redirect()->route('adminrole')->with ('succes', 'Role added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editrole($id)
    {
        $role = Role::where('id', $id)->first();
        return view('admin.editrole', compact('role'));
    }
    public function updaterole(Request $request, $id)
    {
        
        $role['name'] =$request->name;
        $role['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('roles')->where('id', $id)->update($role);
        
        if(!empty($upded))
        {
          return redirect()->route('adminrole')->with ('succes', 'Role updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleterole($id)
    {
        $deletd = DB::table('roles')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminrole')->with ('succes', 'Role deleted successfully');
        }
        
    }
    public function viewrole($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();
        if(!empty($role))
        {
            return view('admin.viewrole', compact('role'));
        }
        
    }
}