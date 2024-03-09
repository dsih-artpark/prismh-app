<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Appversions;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class AppversionController extends Controller
{
    public function home()
    {
         $appversions = Appversions::where('status', 1)->get();
        return view('appversions', compact('appversions'));
        
    }
    public function manageappversions()
    {
         $appversions = Appversions::all();
        return view('admin.appversion.manageappversions', compact('appversions'));
        
    }
    public function addappversions()
    {
         
        return view('admin.appversion.appversions');
        
    }
     public function appversions(Request $request)
    {
        $data['versions'] = $request->versions;
        
        $data['title'] = ($request->title) ? implode('||', $request->title) : " ";
        $data['descp'] = ($request->textbox) ? implode('||', $request->textbox) : " ";
        
        
        $data['status'] = $request->status ? "1" : "0";
        
        $images=array();
        
        if ($request->hasFile('image')) 
        {
            $files=$request->file('image');
                $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/appversions');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
                
            }
            $data['image'] = implode("||",$images);
            
        }
        
        $appversionsresult = DB::table('appversions')->insert($data);
        if(!empty($appversionsresult))
        {
           return redirect()->route('adminappversions')->with ('succes', 'Version added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editappversions($id)
    {
        $appversions = Appversions::where('id', $id)->first();
        return view('admin.appversion.editappversions', compact('appversions'));
    }
    public function updateappversions(Request $request, $id)
    {
        
         $appversions['versions'] = $request->versions;
        
        $appversions['title'] = ($request->title) ? implode('||', $request->title) : " ";
        $appversions['descp'] = ($request->textbox) ? implode('||', $request->textbox) : " ";
        
        $appversions['status'] = $request->status ? "1" : "0";
        
        
        $images=array();
        
        if ($request->hasFile('image')) 
        {
            $files=$request->file('image');
                $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/appversions');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
                
            }
            $appversions['image'] = implode("||",$images);
            
        }
        
       $upded = DB::table('appversions')->where('id', $id)->update($appversions);
        
        if(!empty($upded))
        {
          return redirect()->route('adminappversions')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteappversions($id)
    {
        $deletd = DB::table('appversions')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminappversions')->with ('succes', 'Deleted successfully');
        }
        
    }
    public function viewappversions($id)
    {
        $appversions = DB::table('appversions')->where('id', $id)->first();
        if(!empty($appversions))
        {
            return view('admin.appversion.viewappversions', compact('appversions'));
        }
        
    }
}