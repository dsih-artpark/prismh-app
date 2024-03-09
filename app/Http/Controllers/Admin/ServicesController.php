<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Services;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ServicesController extends Controller
{
    public function managereports()
    {
        $reports = DB::table('customers')->where('status', 1)->paginate(10);
        return view('admin.managereport', compact('reports'));
        
    }
    public function addservices()
    {
         
        return view('admin.services');
        
    }
     public function services(Request $request)
    {
        $data['title'] = $request->title;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/services'), $filename);
            $data['image']= $filename;
        }

        $servicesresult = DB::table('pwa_services')->insert($data);
        if(!empty($servicesresult))
        {
           return redirect()->route('adminservices')->with ('succes', 'Services added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editservices($id)
    {
        $services = Services::where('services_id', $id)->first();
        return view('admin.editservices', compact('services'));
    }
    public function updateservices(Request $request, $id)
    {
        
        $services['title'] =$request->title;
        $services['descp'] = $request->textbox;
        $services['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/services'), $filename);
            $services['image']= $filename;
        }
        
       $upded = DB::table('pwa_services')->where('services_id', $id)->update($services);
        
        if(!empty($upded))
        {
          return redirect()->route('adminservices')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteservices($id)
    {
        $deletd = DB::table('pwa_services')->where('services_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminservices')->with ('succes', 'Services added successfully');
        }
        
    }
    public function viewservices($id)
    {
        $services = DB::table('pwa_services')->where('services_id', $id)->first();
        if(!empty($services))
        {
            return view('admin.viewservices', compact('services'));
        }
        
    }
}