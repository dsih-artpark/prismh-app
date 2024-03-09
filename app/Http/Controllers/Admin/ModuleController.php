<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Module;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ModuleController extends Controller
{
    public function managemodule()
    {
        $modules = Module::all();
         
        return view('admin.managemodule', compact('modules'));
        
    }
    public function addmodule()
    {
         
        return view('admin.module');
        
    }
     public function module(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "2";
        $moduleresult = DB::table('modules')->insert($data);
        if(!empty($moduleresult))
        {
           return redirect()->route('adminmodule')->with ('succes', 'Module added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editmodule($id)
    {
        $module = Module::where('id', $id)->first();
        return view('admin.editmodule', compact('module'));
    }
    public function updatemodule(Request $request, $id)
    {
        
        $module['name'] =$request->name;
        $module['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('modules')->where('id', $id)->update($module);
        
        if(!empty($upded))
        {
          return redirect()->route('adminmodule')->with ('succes', 'Module updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletemodule($id)
    {
        $deletd = DB::table('modules')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminmodule')->with ('succes', 'Module deleted successfully');
        }
        
    }
    public function viewmodule($id)
    {
        $module = DB::table('modules')->where('id', $id)->first();
        if(!empty($module))
        {
            return view('admin.viewmodule', compact('module'));
        }
        
    }
}