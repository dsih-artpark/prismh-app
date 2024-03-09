<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Zone;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ZoneController extends Controller
{
    public function managezone()
    {
        $zones = Zone::all();
         
        return view('admin.managezone', compact('zones'));
        
    }
    public function addzone()
    {
         
        return view('admin.zone');
        
    }
     public function zone(Request $request)
    {
        $data['title'] = $request->name;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['status'] = $request->status ? "1" : "2";
        
        $zoneresult = DB::table('zone')->insert($data);
        if(!empty($zoneresult))
        {
           return redirect()->route('adminzone')->with ('succes', 'Zone added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editzone($id)
    {
        $zone = Zone::where('id', $id)->first();
        return view('admin.editzone', compact('zone'));
    }
    public function updatezone(Request $request, $id)
    {
        
        $zone['title'] =$request->name;
        $zone['latitude'] = $request->latitude;
        $zone['longitude'] = $request->longitude;
        $zone['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('zone')->where('id', $id)->update($zone);
        
        if(!empty($upded))
        {
          return redirect()->route('adminzone')->with ('succes', 'Zone updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletezone($id)
    {
        $deletd = DB::table('zone')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminzone')->with ('succes', 'Zone deleted successfully');
        }
        
    }
    public function viewzone($id)
    {
        $zone = DB::table('zone')->where('id', $id)->first();
        if(!empty($zone))
        {
            return view('admin.viewzone', compact('zone'));
        }
        
    }
}