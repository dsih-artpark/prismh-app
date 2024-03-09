<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Support;

use App\Models\Category;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class SupportController extends Controller
{
    public function managesupport()
    {
        
        if(request()->ajax()) {
            $data = Support::Select('pwa_category.name as cate', 'pwa_support.*')->join('pwa_category', 'pwa_category.id', '=', 'pwa_support.category')->get();
            // dd($data);
    
            return DataTables::of($data)
        
            
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.$data->title.'</p>';
                return $title;
            })
            ->addColumn('category',function($data){
                $category =  '<p class="text-capitalize">'.$data->cate.'</p>';
                return $category;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/support/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/support/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/support/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                
                
                
                
                
                
                
                
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','category'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managesupport');
        
    }
    public function addsupport()
    {
        $category = Category::where('status', 1)->get();
         
        return view('admin.support',  compact('category'));
        
    }
     public function support(Request $request)
    {
        $data['title'] = $request->title;
        $data['descp'] = $request->textbox;
        $data['category'] = $request->category;
        
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/support'), $filename);
            $data['image']= $filename;
        }

        $categoryresult = DB::table('pwa_support')->insert($data);
        if(!empty($categoryresult))
        {
           return redirect()->route('adminsupport')->with ('succes', 'Support added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editsupport($id)
    {
        $support['det'] = Support::where('id', $id)->first();
        $support['category'] = Category::where('status', 1)->get();
        
        return view('admin.editsupport', compact('support'));
    }
    public function updatesupport(Request $request, $id)
    {
        
        $support['title'] =$request->title;
        $support['descp'] = $request->textbox;
        $support['category'] = $request->category;
        $support['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/support'), $filename);
            $support['image']= $filename;
        }
        
       $upded = DB::table('pwa_support')->where('id', $id)->update($support);
        
        if(!empty($upded))
        {
          return redirect()->route('adminsupport')->with ('succes', 'Support updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletesupport($id)
    {
        $deletd = DB::table('pwa_support')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminsupport')->with ('succes', 'Support deleted successfully');
        }
        
    }
    public function viewsupport($id)
    {
        $support = DB::table('pwa_support')
        ->select('pwa_category.name as cate', 'pwa_support.*')
        ->join('pwa_category', 'pwa_category.id', '=', 'pwa_support.category')
        ->where('pwa_support.id', $id)
        ->first();
        if(!empty($support))
        {
            return view('admin.viewsupport', compact('support'));
        }
        
    }
}