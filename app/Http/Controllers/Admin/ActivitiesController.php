<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Activities;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ActivitiesController extends Controller
{
    public function manageactivities()
    {
        
        if(request()->ajax()) {
            $data = Activities::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->activities_id;
                }else{
                $id = $data->activities_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/activities/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/activities/edit/' . $data->activities_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->activities_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->activities_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/activities/view/' . $data->activities_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                
                
                
                
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.manageactivities');
        
    }
    public function addactivities()
    {
         
        return view('admin.activities');
        
    }
     public function activities(Request $request)
    {
        $data['title'] = $request->title;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/activities'), $filename);
            $data['image']= $filename;
        }
        $images=array();
        if ($request->hasFile('image2')) 
        {
            
            $files=$request->file('image2');
            $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/activities/sub');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
            }
            $data['image2'] = implode("|",$images);
            
        }

        $activitiesresult = DB::table('pwa_activities')->insert($data);
        if(!empty($activitiesresult))
        {
           return redirect()->route('adminactivities')->with ('succes', 'Activities added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editactivities($id)
    {
        $activities = Activities::where('activities_id', $id)->first();
        return view('admin.editactivities', compact('activities'));
    }
    public function updateactivities(Request $request, $id)
    {
        
        $activities['title'] =$request->title;
        $activities['descp'] = $request->textbox;
        $activities['status'] = $request->status ? "1" : "0";
        $activities['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/activities'), $filename);
            $activities['image']= $filename;
        }
        
        
        
        $images=array();
        if ($request->hasFile('image2')) 
        {
            
            $files=$request->file('image2');
            $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/activities/sub');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
            }
            $activities['image2'] = implode("|",$images);
            
        }
        
       $upded = DB::table('pwa_activities')->where('activities_id', $id)->update($activities);
        
        if(!empty($upded))
        {
          return redirect()->route('adminactivities')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteactivities($id)
    {
        $deletd = DB::table('pwa_activities')->where('activities_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminactivities')->with ('succes', 'Activities added successfully');
        }
        
    }
    public function viewactivities($id)
    {
        $activities = DB::table('pwa_activities')->where('activities_id', $id)->first();
        if(!empty($activities))
        {
            return view('admin.viewactivities', compact('activities'));
        }
        
    }
}