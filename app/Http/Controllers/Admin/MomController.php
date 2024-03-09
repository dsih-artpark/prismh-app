<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Mom;

use App\Models\Meetings;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class MomController extends Controller
{
    public function managemom()
    {
        
        if(request()->ajax()) {
            $data = Mom::Select('pwa_meetings.title as tcategory', 'pwa_meetings_mom.*')->join('pwa_meetings', 'pwa_meetings.id', '=', 'pwa_meetings_mom.category')->get();
            // dd($data);
    
            return DataTables::of($data)
        
            
            ->addColumn('topic',function($data){
                $topic =  '<p class="text-capitalize">'.$data->topic.'</p>';
                return $topic;
            })
             ->addColumn('hosted',function($data){
                $hosted =  '<p class="text-capitalize">'.$data->hosted.'</p>';
                return $hosted;
            })
            ->addColumn('category',function($data){
                $category =  '<p class="text-capitalize">'.$data->tcategory.'</p>';
                return $category;
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
                          $button .= ' <a href="'.url('admin/mom/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/mom/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                        
                        
                        
                   }
                   
                   $button .= ' <a href="'.url('admin/mom/agenda/' . $data->id).'" class="btn btn-outline-warning-2x"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a>';
                
                
                
                
                
                
                
                
                
                
                
                
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','hosted','topic','category'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managemom');
        
    }
    public function addmom()
    {
        $data['meetings'] = Meetings::where('status', 1)->get();
        $data['members'] = Customer::select('id as uid', 'username as uname')->where('status', 1)->get();
         
        return view('admin.mom',  compact('data'));
        
    }
     public function mom(Request $request)
    {
        $data['topic'] = $request->topic;
        $data['hosted'] = $request->hosted;
        $data['category'] = $request->category;
        $data['memberid'] = $request->memberid;
        $data['responsibility'] = $request->responsibility;
        $data['date'] = $request->date;
        $data['details'] = $request->details;
        
        $data['status'] = $request->status ? "1" : "0";
        
        // if($request->file('image'))
        // {
        //     $file= $request->file('image');
        //     $filename= date('YmdHis').$file->getClientOriginalName();
        //     $file-> move(public_path('uploads/subcategory'), $filename);
        //     $data['image']= $filename;
        // }

        $momresult = DB::table('pwa_meetings_mom')->insert($data);
        if(!empty($momresult))
        {
           return redirect()->route('adminmom')->with ('succes', 'Mom added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editmom($id)
    {
        $mom['det'] = Mom::where('id', $id)->first();
        $mom['meetings'] = Meetings::where('status', 1)->get();
        $mom['members'] = Customer::select('id as uid', 'username as uname')->where('status', 1)->get();
        
        return view('admin.editmom', compact('mom'));
    }
    public function updatemom(Request $request, $id)
    {
        
        $mom['topic'] =$request->topic;
        $mom['hosted'] = $request->hosted;
        $mom['category'] = $request->category;
        $mom['status'] = $request->status ? "1" : "0";
        
        
        // if($request->file('image'))
        // {
        //     $file= $request->file('image');
        //     $filename= date('YmdHis').$file->getClientOriginalName();
        //     $file-> move(public_path('uploads/category'), $filename);
        //     $mom['image']= $filename;
        // }
        
       $upded = DB::table('pwa_meetings_mom')->where('id', $id)->update($mom);
        
        if(!empty($upded))
        {
          return redirect()->route('adminmom')->with ('succes', 'Mom updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletemom($id)
    {
        $deletd = DB::table('pwa_meetings_mom')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminmom')->with ('succes', 'Mom deleted successfully');
        }
        
    }
    public function viewmom($id)
    {
        $mom = DB::table('pwa_meetings_mom')->select('pwa_meetings.title as category', 'pwa_meetings_mom.*')->join('pwa_meetings', 'pwa_meetings.id', '=', 'pwa_meetings_mom.category')->where('pwa_meetings_mom.id', $id)->first();
        if(!empty($mom))
        {
            return view('admin.viewmom', compact('mom'));
        }
        
    }
    public function addagenda($id)
    {
        $mom['det'] = Mom::where('id', $id)->first();
        $mom['topic'] = DB::table('pwa_meetings_mom')->where('status',1)->get();
        $mom['departments'] = DB::table('pwa_department')->where('status',1)->get();
        $mom['meetings'] = Meetings::where('status', 1)->get();
        $mom['members'] = Customer::select('id as uid', 'username as uname')->where('status', 1)->get();
        
        return view('admin.addmomagenda', compact('mom'));
    }
    public function momtopiclist(Request $request)
    {
       $data = DB::table('pwa_meetings_mom')->where('status',1)->get();
       
        return response()->json($data); 
        
    }
    public function mommemlist(Request $request)
    {
       $data = DB::table('pwa_department')->where('status',1)->get();
       
        return response()->json($data); 
        
    }
     public function topiclist()
    {
       $res = DB::table('pwa_meetings_mom')->where('status',1)->get();
        $response = $res;
        return response()->json($response); 
        
    }
     public function detaillist(Request $request)
    {
        $id = $request->id;
        $mom = DB::table('pwa_meetings_mom')->where('id',$id)->first();
        $result = $mom->details;
        
        $response = $result;
        return response()->json($response); 
    }
    public function departlist(Request $request)
    {
        $id = $request->id;
        $mom = DB::table('pwa_department_mem')->where('depid',$id)->first();
        // $result = $mom->memid;

          $x = explode ("|||", $mom->memid);
          $i = 1;
        //   $da = ' ';
         foreach($x as $key => $val){
              $da[] = DB::table('customers')->select('id', 'username as name')->where('id', $val)->first();
             
         }
        
        $response = $da;
        return response()->json($response); 
    }
}