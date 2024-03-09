<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Submodule;

use App\Models\Module;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class SubmoduleController extends Controller
{
    public function managesubmodule()
    {
        $submodules = Submodule::all();
        
         
        return view('admin.managesubmodule', compact('submodules'));
        
    }
    public function addsubmodule()
    {
        $modules = Module::where('status', 1)->get();
        
        return view('admin.submodule',  compact('modules'));
        
    }
     public function submodule(Request $request)
    {
        $data['name'] = $request->name;
        $data['mod_id'] = $request->mod_id;
        $data['status'] = $request->status ? "1" : "2";

        $moduleresult = DB::table('submodules')->insert($data);
        if(!empty($moduleresult))
        {
           return redirect()->route('adminsubmodule')->with ('succes', 'Submodule added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editsubmodule($id)
    {
        $submodule['det'] = Submodule::where('id', $id)->first();
        $modules = Module::where('status', 1)->get();
        
        return view('admin.editsubmodule', compact('submodule', 'modules'));
    }
    public function updatesubmodule(Request $request, $id)
    {
        
        $submodule['name'] =$request->name;
        $submodule['mod_id'] = $request->mod_id;
        $submodule['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('submodules')->where('id', $id)->update($submodule);
        
        if(!empty($upded))
        {
          return redirect()->route('adminsubmodule')->with ('succes', 'Submodule updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletesubmodule($id)
    {
        $deletd = DB::table('submodules')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminsubmodule')->with ('succes', 'Submodule deleted successfully');
        }
        
    }
    
}