<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Document;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class DocumentController extends Controller
{
    public function managedocument()
    {
        
        if(request()->ajax()) {
            $data = Document::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->id;
                }else{
                $id = $data->id;
                }
                return $id;
            })
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
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
                          $button .= ' <a href="'.url('admin/document/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       
                        
                   }
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','name','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managedocument');
        
    }
    public function adddocument()
    {
         
        return view('admin.document');
        
    }
     public function document(Request $request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? "1" : "0";
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $documentresult = DB::table('pwa_document')->insert($data);
        if(!empty($documentresult))
        {
           return redirect()->route('admindocument')->with ('succes', 'Form Category added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editdocument($id)
    {
        $document = Document::where('id', $id)->first();
        return view('admin.editdocument', compact('document'));
    }
    public function updatedocument(Request $request, $id)
    {
        
        $document['name'] =$request->name;
        $document['status'] = $request->status ? "1" : "0";
        $document['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
       $upded = DB::table('pwa_document')->where('id', $id)->update($document);
        
        if(!empty($upded))
        {
          return redirect()->route('admindocument')->with ('succes', 'Form Category updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletedocument($id)
    {
        $deletd = DB::table('pwa_document')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('admindocument')->with ('succes', 'Form Category deleted successfully');
        }
        
    }
    public function viewdocument($id)
    {
        $document = DB::table('pwa_document')->where('id', $id)->first();
        if(!empty($document))
        {
            return view('admin.viewdocument', compact('document'));
        }
        
    }
}