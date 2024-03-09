<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Division;

use App\Models\Zone;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class DivisionController extends Controller
{
    public function managedivision()
    {
        $divisions = Division::where('status', 1)->get();
        
         
        return view('admin.managedivision', compact('divisions'));
        
    }
    public function adddivision()
    {
        $zones = Zone::where('status', 1)->get();
         
        return view('admin.division',  compact('zones'));
        
    }
     public function division(Request $request)
    {
        $data['name'] = $request->name;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['zone_id'] = $request->zone_id;
        $data['status'] = $request->status ? "1" : "2";
        
        $zoneresult = DB::table('division')->insert($data);
        if(!empty($zoneresult))
        {
           return redirect()->route('admindivision')->with ('succes', 'Division added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editdivision($id)
    {
        $division['det'] = Division::where('id', $id)->first();
        $zones = Zone::where('status', 1)->get();
        
        return view('admin.editdivision', compact('division','zones'));
    }
    public function updatedivision(Request $request, $id)
    {
        
        $division['name'] =$request->name;
        $division['latitude'] = $request->latitude;
        $division['longitude'] = $request->longitude;
        $division['zone_id'] = $request->zone_id;
        $division['status'] = $request->status ? "1" : "2";
        
       $upded = DB::table('division')->where('id', $id)->update($division);
        
        if(!empty($upded))
        {
          return redirect()->route('admindivision')->with ('succes', 'Division updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletedivision($id)
    {
        $deletd = DB::table('division')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admindivision')->with ('succes', 'Division deleted successfully');
        }
        
    }
    
}