<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Content;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class ContentController extends Controller
{
    public function managecontent()
    {
        
        if(request()->ajax()) {
            $data = Content::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->content_id;
                }else{
                $id = $data->content_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
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
                          $button .= ' <a href="'.url('admin/content/edit/' . $data->content_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->content_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->content_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/content/view/' . $data->content_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managecontent');
        
    }
    public function addcontent()
    {
         
        return view('admin.content');
        
    }
     public function content(Request $request)
    {
        $data['title'] = $request->title;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        $contentresult = DB::table('pwa_content')->insert($data);
        if(!empty($contentresult))
        {
           return redirect()->route('admincontent')->with ('succes', 'Content added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editcontent($id)
    {
        $content = Content::where('content_id', $id)->first();
        return view('admin.editcontent', compact('content'));
    }
    public function updatecontent(Request $request, $id)
    {
        
        $content['title'] =$request->title;
        $content['descp'] = $request->textbox;
        $content['status'] = $request->status ? "1" : "0";
        $content['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
       
       $upded = DB::table('pwa_content')->where('content_id', $id)->update($content);
        
        if(!empty($upded))
        {
          return redirect()->route('admincontent')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletecontent($id)
    {
        $deletd = DB::table('pwa_content')->where('content_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admincontent')->with ('succes', 'Content added successfully');
        }
        
    }
    public function viewcontent($id)
    {
        $content = DB::table('pwa_content')->where('content_id', $id)->first();
        if(!empty($content))
        {
            return view('admin.viewcontent', compact('content'));
        }
        
    }
}