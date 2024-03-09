<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Ward;

use App\Models\Division;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class WardController extends Controller
{
    public function manageward()
    {
        $wards = Ward::where('status', 1)->get();
        
         
        return view('admin.manageward', compact('wards'));
        
    }
    public function addward()
    {
        $divisions = Division::where('status', 1)->get();
        $data['ward'] = Ward::where('status', 1)->get();
         
        return view('admin.ward',  compact('data','divisions'));
        
    }
     public function ward(Request $request)
    {
        $data['name'] = $request->name;
        $data['number'] = $request->number;
        $data['division_id'] = $request->division_id;
        $data['status'] = $request->status ? "1" : "2";

        $divisionresult = DB::table('ward')->insert($data);
        if(!empty($divisionresult))
        {
           return redirect()->route('adminward')->with ('succes', 'Ward added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editward($id)
    {
        $ward['det'] = Ward::where('id', $id)->first();
        $divisions = Division::where('status', 1)->get();
        
        return view('admin.editward', compact('ward','divisions'));
    }
    public function updateward(Request $request, $id)
    {
        
        $ward['name'] =$request->name;
        $ward['number'] = $request->number;
        $ward['division_id'] = $request->division_id;
        $ward['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('ward')->where('id', $id)->update($ward);
        
        if(!empty($upded))
        {
          return redirect()->route('adminward')->with ('succes', 'Ward updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteward($id)
    {
        $deletd = DB::table('ward')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminward')->with ('succes', 'Ward deleted successfully');
        }
        
    }
    
}