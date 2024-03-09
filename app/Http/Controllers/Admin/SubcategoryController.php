<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Subcategory;

use App\Models\Category;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class SubcategoryController extends Controller
{
    public function managesubcategory()
    {
        
        if(request()->ajax()) {
            $data = Subcategory::Select('pwa_category.name as category', 'pwa_subcategory.*')->join('pwa_category', 'pwa_category.id', '=', 'pwa_subcategory.cat_id')->get();
            // dd($data);
    
            return DataTables::of($data)
        
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
            })
            ->addColumn('category',function($data){
                $category =  '<p class="text-capitalize">'.$data->category.'</p>';
                return $category;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/subcategory/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
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
                          $button .= ' <a href="'.url('admin/subcategory/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/subcategory/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                
                
                
                
                
                
                
                
                
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','name','category'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managesubcategory');
        
    }
    public function addsubcategory()
    {
        $category = Category::where('status', 1)->get();
         
        //return view('admin.subcategory',  compact('category'));
        
        return view('admin.viewThisRegVehicleDetails');
        
    }
     public function subcategory(Request $request)
    {
        $data['name'] = $request->name;
        $data['name_ka'] = $request->name_ka;
        $data['cat_id'] = $request->cat_id;
        
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/subcategory'), $filename);
            $data['image']= $filename;
        }

        $categoryresult = DB::table('pwa_subcategory')->insert($data);
        if(!empty($categoryresult))
        {
           return redirect()->route('adminsubcategory')->with ('succes', 'Subcategory added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editsubcategory($id)
    {
        $subcategory['det'] = Subcategory::where('id', $id)->first();
        $subcategory['category'] = Category::where('status', 1)->get();
        
        return view('admin.editsubcategory', compact('subcategory'));
    }
    public function updatesubcategory(Request $request, $id)
    {
        
        $subcategory['name'] =$request->name;
        $subcategory['name_ka'] = $request->name_ka;
        $subcategory['cat_id'] = $request->cat_id;
        $subcategory['status'] = $request->status ? "1" : "0";
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/category'), $filename);
            $subcategory['image']= $filename;
        }
        
       $upded = DB::table('pwa_subcategory')->where('id', $id)->update($subcategory);
        
        if(!empty($upded))
        {
          return redirect()->route('adminsubcategory')->with ('succes', 'Subcategory updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletesubcategory($id)
    {
        $deletd = DB::table('pwa_subcategory')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminsubcategory')->with ('succes', 'Subcategory deleted successfully');
        }
        
    }
    public function viewsubcategory($id)
    {
        $subcategory = DB::table('pwa_subcategory')->select('pwa_category.name as category', 'pwa_subcategory.*')->join('pwa_category', 'pwa_category.id', '=', 'pwa_subcategory.cat_id')->where('pwa_subcategory.id', $id)->first();
        if(!empty($subcategory))
        {
            return view('admin.viewsubcategory', compact('subcategory'));
        }
        
    }
}