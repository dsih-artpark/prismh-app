<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Campaign;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class CampaignController extends Controller
{
    public function managecampaign()
    {
        
        if(request()->ajax()) {
            $data = Campaign::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->id;
                }else{
                $id = $data->id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/campaign/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/campaign/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/campaign/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                 
                 
                  
               
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managecampaign');
        
    }
    public function addcampaign()
    {
         
        return view('admin.campaign');
        
    }
     public function campaign(Request $request)
    {
        $data['title'] = $request->title;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/campaign'), $filename);
            $data['image']= $filename;
        }

        $campaignresult = DB::table('pwa_campaign')->insert($data);
        if(!empty($campaignresult))
        {
           return redirect()->route('admincampaign')->with ('succes', 'Campaign added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editcampaign($id)
    {
        $campaign = Campaign::where('id', $id)->first();
        return view('admin.editcampaign', compact('campaign'));
    }
    public function updatecampaign(Request $request, $id)
    {
        
        $campaign['title'] =$request->title;
        $campaign['descp'] = $request->textbox;
        $campaign['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/campaign'), $filename);
            $campaign['image']= $filename;
        }
        
       $upded = DB::table('pwa_campaign')->where('id', $id)->update($campaign);
        
        if(!empty($upded))
        {
          return redirect()->route('admincampaign')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletecampaign($id)
    {
        $deletd = DB::table('pwa_campaign')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admincampaign')->with ('succes', 'Campaign added successfully');
        }
        
    }
    public function viewcampaign($id)
    {
        $campaign = DB::table('pwa_campaign')->where('id', $id)->first();
        if(!empty($campaign))
        {
            return view('admin.viewcampaign', compact('campaign'));
        }
        
    }
}