<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Meetings;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class MeetingsController extends Controller
{
    public function managemeetings()
    {
        
        if(request()->ajax()) {
            $data = Meetings::all();
    
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
                $title =  '<p class="text-capitalize">'.$data->title.'</p>';
                return $title;
            })
             ->addColumn('location',function($data){
                $location =  '<p class="text-capitalize">'.$data->location.'</p>';
                return $location;
            })
             ->addColumn('date',function($data){
                $date =  '<p class="text-capitalize">'.$data->date.'</p>';
                return $date;
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
                          $button .= ' <a href="'.url('admin/meetings/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                           $button .= '<a href="'.url('admin/meetings/attendance/' . $data->id).'" class="btn btn-outline-warning-2x"><i class="fa fa-tasks" aria-hidden="true"></i></a>';
                 
                       }
                       
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                           $button .= ' <a href="'.url('admin/meetings/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                      
                            // $button .= '<a href="'.url('admin/meetings/attendance/' . $data->id).'" class="btn btn-outline-warning-2x"><i class="fa fa-tasks" aria-hidden="true"></i></a>';
                       }
                       
                          
                        
                   }
                  
                       
               
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','title','date','location','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managemeetings');
        
    }
    public function addmeetings()
    {
         
        return view('admin.meetings');
        
    }
     public function meetings(Request $request)
    {
        $data['eid'] = "MEETINGS".uniqid();
        $data['mominv'] = "BBMP/WARROOM/".date('Y')."/".uniqid();
        $data['modeid'] = $request->modeid;
        $data['details'] = $request->details;
        $data['date'] = $request->date;
        $data['mode'] = $request->mode;
        $data['title'] = $request->title;
        $data['time'] =$request->time;
        $data['descp'] = $request->textbox;
        $data['location'] = $request->location;
        $data['prime_member'] =$request->name;
        $data['prime_member_desig'] = $request->desig;
        // $data['secondary_member'] = ($request->secondary_name) ? implode(',', $request->secondary_name) : " ";
        $data['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= uniqid().date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/meetings'), $filename);
            $data['prime_member_image']= $filename;
        }
        
        $images=array();
        
        if ($request->hasFile('image2')) 
        {
            $files=$request->file('image2');
                $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/meetings');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
                
            }
            $data['secondary_member_image'] = implode("|",$images);
            
        }
       
        $meetingsresult = DB::table('pwa_meetings')->insert($data);
      
        if(!empty($meetingsresult))
        {
             $dsa = date('Y-m-d', strtotime($request->date));
            $tya = date('H:i:s', strtotime($request->time));
            $cal['eid'] = $data['eid'];
            $cal['name'] = $request->title;
            $cal['color'] = "#F41A03";
            $cal['start_time'] = $dsa." ".$tya;
            DB::table('calender')->insert($cal);
            
           return redirect()->route('adminmeetings')->with ('succes', 'Meetings added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editmeetings($id)
    {
        $meetings['det'] = Meetings::where('id', $id)->first();
        $meetings['departments'] = DB::table('pwa_department')->where('status', 1)->get();
        return view('admin.editmeetings', compact('meetings'));
    }
    public function updatemeetings(Request $request, $id)
    {
        
        $meetings['eid'] = $request->eid ? $request->eid : "MEETINGS".uniqid();
        $meetings['modeid'] = $request->modeid;
        $meetings['details'] = $request->details;
         $meetings['title'] = $request->title;
         $meetings['mode'] = $request->mode;
        $meetings['date'] = $request->date;
        $meetings['time'] =$request->time;
        $meetings['descp'] = $request->textbox;
        $meetings['location'] = $request->location;
        $meetings['prime_member'] =$request->name;
        $meetings['prime_member_desig'] = $request->desig;
        // $meetings['secondary_member'] = ($request->secondary_name) ? implode(',', $request->secondary_name) : " ";
        $meetings['status'] = $request->status ? "1" : "0";
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= uniqid().date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/meetings'), $filename);
            $meetings['prime_member_image']= $filename;
        }
        
        $images=array();
        
        if ($request->hasFile('image2')) 
        {
            $files=$request->file('image2');
                $i=1;
            foreach($files as $file)
            {
                $image_name = uniqid().date('YmdHis').$i.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/meetings');
                $file->move($destinationPath, $image_name);
                $images[]=$image_name;
                $i++;
                
            }
            $meetings['secondary_member_image'] = implode("|",$images);
            
        }
       
       $upded = DB::table('pwa_meetings')->where('id', $id)->update($meetings);
       
      
        
        if(!empty($upded))
        {
            $chkcal =  DB::table('calender')->where('eid', $meetings['eid'])->first();
            
            if(!empty($chkcal)){
            $dsa = date('Y-m-d', strtotime($request->date));
            $tya = date('H:i:s', strtotime($request->time));
            $cal['name'] = $request->title;
            $cal['color'] = "#F41A03";
            $cal['start_time'] = $dsa." ".$tya;
            DB::table('calender')->where('eid',$chkcal->eid)->update($cal);
           }
           else
           {
                $dsa = date('Y-m-d', strtotime($request->date));
                $tya = date('H:i:s', strtotime($request->time));
                $cal['eid'] = $meetings['eid'];
                $cal['name'] = $request->title;
                $cal['color'] = "#F41A03";
                $cal['start_time'] = $dsa." ".$tya;
                DB::table('calender')->insert($cal);
           }
          return redirect()->route('adminmeetings')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletemeetings($id)
    {
         $events = DB::table('pwa_meetings')->where('id', $id)->first();
         $calid = $events->eid;
         if($calid){
             DB::table('calender')->where('eid', $calid)->delete();
         }
        
        $deletd = DB::table('pwa_meetings')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminmeetings')->with ('succes', 'Meetings deleted successfully');
        }
        
    }
    public function viewmeetings($id)
    {
        $meetings = DB::table('pwa_meetings')->where('id', $id)->first();
        if(!empty($meetings))
        {
            return view('admin.viewmeetings', compact('meetings'));
        }
        
    }
    public function attendancemeetings($id)
    {
        $meetings['det'] = Meetings::where('id', $id)->first();
        $meetings['members'] = DB::table('customers')->get();
        $meetings['attendance'] = DB::table('pwa_meetings_attendance')->where('mid', $id)->get();
        // dd($meetings);
        return view('admin.attendancemeetings', compact('meetings'));
    }
    public function updateattendancemeetings(Request $request, $id)
    {
       //delete existing all
       DB::table('pwa_meetings_attendance')->where('mid', $id)->delete(); 
       
        $meetings['mid'] = $id;
        $meetings['status'] = 1;
        
        foreach($request->custid as $cst)
            {
                
                $meetings['custid'] =$cst;
                $upded = DB::table('pwa_meetings_attendance')->insert($meetings);
               
                
            }
           
        
        if(!empty($upded))
        {
          return redirect()->route('adminmeetings')->with ('succes', 'Attendance Marked');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
}