<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Scheme;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class SchemeController extends Controller
{
    public function managescheme()
    {
        
        if(request()->ajax()) {
            $data = Scheme::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->scheme_id;
                }else{
                $id = $data->scheme_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/scheme/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/scheme/edit/' . $data->scheme_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->scheme_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->scheme_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/scheme/view/' . $data->scheme_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managescheme');
        
    }
    public function addscheme()
    {
         
        return view('admin.scheme');
        
    }
     public function scheme(Request $request)
    {
        $data['title'] = $request->title;
        $data['count'] = $request->count;
        $data['status'] = $request->status ? "1" : "0";
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/scheme'), $filename);
            $data['image']= $filename;
        }

        $schemeresult = DB::table('pwa_scheme')->insert($data);
        if(!empty($schemeresult))
        {
           return redirect()->route('adminscheme')->with ('succes', 'Scheme added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editscheme($id)
    {
        $scheme = Scheme::where('scheme_id', $id)->first();
        return view('admin.editscheme', compact('scheme'));
    }
    public function updatescheme(Request $request, $id)
    {
        
        $scheme['title'] =$request->title;
        $scheme['count'] = $request->count;
        $scheme['status'] = $request->status ? "1" : "0";
        $scheme['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/scheme'), $filename);
            $scheme['image']= $filename;
        }
        
       $upded = DB::table('pwa_scheme')->where('scheme_id', $id)->update($scheme);
        
        if(!empty($upded))
        {
          return redirect()->route('adminscheme')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletescheme($id)
    {
        $deletd = DB::table('pwa_scheme')->where('scheme_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminscheme')->with ('succes', 'Scheme added successfully');
        }
        
    }
    public function viewscheme($id)
    {
        $scheme = DB::table('pwa_scheme')->where('scheme_id', $id)->first();
        if(!empty($scheme))
        {
            return view('admin.viewscheme', compact('scheme'));
        }
        
    }
}