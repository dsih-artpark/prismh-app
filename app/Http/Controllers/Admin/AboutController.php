<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\About;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class AboutController extends Controller
{
    public function manageabout()
    {
        
        if(request()->ajax()) {
            $data = About::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->about_id;
                }else{
                $id = $data->about_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/about/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/about/edit/' . $data->about_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->about_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->about_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/about/view/' . $data->about_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                 
                 
                  
               
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.manageabout');
        
    }
    public function addabout()
    {
         
        return view('admin.about');
        
    }
     public function about(Request $request)
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
            $file-> move(public_path('uploads/about'), $filename);
            $data['image']= $filename;
        }

        $aboutresult = DB::table('pwa_about')->insert($data);
        if(!empty($aboutresult))
        {
           return redirect()->route('adminabout')->with ('succes', 'About added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editabout($id)
    {
        $about = About::where('about_id', $id)->first();
        return view('admin.editabout', compact('about'));
    }
    public function updateabout(Request $request, $id)
    {
        
        $about['title'] =$request->title;
        $about['descp'] = $request->textbox;
        $about['status'] = $request->status ? "1" : "0";
        $about['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/about'), $filename);
            $about['image']= $filename;
        }
        
       $upded = DB::table('pwa_about')->where('about_id', $id)->update($about);
        
        if(!empty($upded))
        {
          return redirect()->route('adminabout')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deleteabout($id)
    {
        $deletd = DB::table('pwa_about')->where('about_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminabout')->with ('succes', 'Deleted successfully');
        }
        
    }
    public function viewabout($id)
    {
        $about = DB::table('pwa_about')->where('about_id', $id)->first();
        if(!empty($about))
        {
            return view('admin.viewabout', compact('about'));
        }
        
    }
}