<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\State;

use App\Models\Country;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class StateController extends Controller
{
    public function managestate()
    {
        
        if(request()->ajax()) {
            $data = State::Select('pwa_country.name as country', 'pwa_state.*')->join('pwa_country', 'pwa_country.id', '=', 'pwa_state.cou_id')->get();
            // dd($data);
    
            return DataTables::of($data)
        
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
            })
            ->addColumn('country',function($data){
                $country =  '<p class="text-capitalize">'.$data->country.'</p>';
                return $country;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/state/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                       if($resd == "Edit")
                       {
                          $button .= ' <a href="'.url('admin/state/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/state/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
               
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','country'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managestate');
        
    }
    public function addstate()
    {
        $country = Country::where('status', 1)->get();
         
        return view('admin.state',  compact('country'));
        
    }
     public function state(Request $request)
    {
        $data['name'] = $request->name;
        $data['name_ka'] = $request->name_ka;
        $data['cou_id'] = $request->cou_id;
        
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/state'), $filename);
            $data['image']= $filename;
        }

        $countryresult = DB::table('pwa_state')->insert($data);
        if(!empty($countryresult))
        {
           return redirect()->route('adminstate')->with ('succes', 'State added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editstate($id)
    {
        $state['det'] = State::where('id', $id)->first();
        $state['country'] = Country::where('status', 1)->get();
        
        return view('admin.editstate', compact('state'));
    }
    public function updatestate(Request $request, $id)
    {
        
        $state['name'] =$request->name;
        $state['name_ka'] = $request->name_ka;
        $state['cou_id'] = $request->cou_id;
        $state['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/country'), $filename);
            $state['image']= $filename;
        }
        
       $upded = DB::table('pwa_state')->where('id', $id)->update($state);
        
        if(!empty($upded))
        {
          return redirect()->route('adminstate')->with ('succes', 'State updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletestate($id)
    {
        $deletd = DB::table('pwa_state')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminstate')->with ('succes', 'State deleted successfully');
        }
        
    }
    public function viewstate($id)
    {
        $state = DB::table('pwa_state')->select('pwa_country.name as country', 'pwa_state.*')->join('pwa_country', 'pwa_country.id', '=', 'pwa_state.cou_id')->where('pwa_state.id', $id)->first();
        if(!empty($state))
        {
            return view('admin.viewstate', compact('state'));
        }
        
    }
}