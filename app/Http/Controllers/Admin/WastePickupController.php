<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WastePickup;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WastePickupController extends Controller
{
    
    public function managepatientsurvey()
    {
        // $rolid = session('admin.admin_id');
        
        // $datas = DB::table('survey_patients')
        //         ->select('survey_patients.*','customers.username')
        //         ->join('customers','survey_patients.cust_id','=','customers.id','left')
        //         ->orderBy('survey_patients.id','desc')
        //         ->paginate(10);
    
                
        // return view('admin.managepatientsurvey', compact('datas'));
        return view('admin.managepatientsurvey');
    }

    public function getmanagepatientsurvey(Request $request){

      ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); 

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data']; 
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];
      
      // Total records
        $totalRecords = DB::table('survey_patients')
        ->select('survey_patients.*','customers.username')
        ->join('customers','survey_patients.cust_id','=','customers.id','left')
        ->count();
        $totalRecordswithFilter = DB::table('survey_patients')
        ->select('survey_patients.*','customers.username')
        ->join('customers','survey_patients.cust_id','=','customers.id','left')
        ->where(function($q) use($searchValue) {
          $q->where('customers.username', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.name', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.phone', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.latit', 'like', '%' .$searchValue . '%');
          $q->orWhere('survey_patients.created_at', 'like', '%' .$searchValue . '%');
        })
        ->count();

      // Fetch records
        $records = DB::table('survey_patients')->orderBy($columnName,$columnSortOrder)
              ->join('customers','survey_patients.cust_id','=','customers.id','left')
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.name', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.phone', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.latit', 'like', '%' .$searchValue . '%');
                $q->orWhere('survey_patients.created_at', 'like', '%' .$searchValue . '%');
              })
              ->select('survey_patients.*','customers.username')
              ->skip($start)
              ->take($rowperpage)
              ->get();

        $data_arr = array();

      foreach($records as $key => $record){
        $id = $start+$key+1;
        $username = ucfirst($record->username);
        $name = ucfirst($record->name);
        $phone = $record->phone;
        $latit = $record->latit;
        $created_at = date("Y-m-d", strtotime($record->created_at));        
        $action = '<a href="'.route('admin.patient-survey.view' , ['id' => $record->id]).'"  class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';

        $data_arr[] = array(
            "id" => $id,
            "username" => $username,
            "name" => $name,
            "phone" => $phone,
            "latit" => $latit,
            "created_at" => $created_at,
            "action" => $action,
        );
      }

      $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordswithFilter,
         "aaData" => $data_arr
      );

      return response()->json($response); 
    }
    public function viewpatientsurvey($id)
    {
        $data = DB::table('survey_patients')
                ->select('survey_patients.*','customers.username','customers.roles')
                ->join('customers','survey_patients.cust_id','=','customers.id','left')
                ->where('survey_patients.id',$id)->first();
        
            return view('admin.viewpatientsurvey', compact('data'));
        
        
    }
    
    public function managedumps()
    {
        $rolid = session('admin.admin_id');
        if($rolid == 1){
        $datas = DB::table('dump')
                ->select('dump.*','customers.username','pick.q1')
                ->join('pick','dump.pid','=','pick.id','left')
                ->join('customers','dump.cust_id','=','customers.id','left')
                ->orderBy('dump.id','desc')
                ->get();
    }
    else{
        $per = DB::table('permissions')->where('admin_id', $rolid)->first();
        $ward = explode(',',$per->ward);
        $datas = DB::table('dump')
                ->select('dump.*','customers.username','pick.q1')
                ->join('pick','dump.pid','=','pick.id','left')
                ->join('customers','dump.cust_id','=','customers.id','left')
                ->whereIn('pick.ward',$ward)
                ->orderBy('dump.id','desc')
                ->get();
    }
               
        return view('admin.wastedumps', compact('datas'));
    }
    
    public function managepickups()
    {
    //     $dumps = DB::table('pick')->get();
    //   foreach ($dumps as $key => $dump) {
    //     DB::table('pick')->whereId($dump->id)->update(['uid'=>Str::uuid()]);
    //   }
    //     $rolid = session('admin.admin_id');
    //     if($rolid == 1){
    //     $datas = DB::table('pick')
    //             ->select('pick.*','customers.username')
    //             ->join('customers','pick.cust_id','=','customers.id','left')
    //             ->orderBy('pick.id','desc')
    //             ->paginate(10);
    // }
    // else{
    //     $per = DB::table('permissions')->where('admin_id', $rolid)->first();
    //     $ward = explode(',',$per->ward);
    //     $datas = DB::table('pick')
    //             ->select('pick.*','customers.username')
    //             ->join('customers','pick.cust_id','=','customers.id','left')
    //             ->whereIn('pick.ward',$ward)
    //              ->orderBy('pick.id','desc')
    //              ->paginate(10);
    // }
                
        // return view('admin.wastepickups', compact('datas'));
        return view('admin.wastepickups');
    }

    public function getmanagepickups(Request $request){

      ## Read value
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); 

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column'];
      $columnName = $columnName_arr[$columnIndex]['data']; 
      $columnSortOrder = $order_arr[0]['dir']; 
      $searchValue = $search_arr['value']; 

      $rolid = session('admin.admin_id');
      
      if($rolid == 1){
        // Total records
        $totalRecords = DB::table('pick')
        ->join('customers','pick.cust_id','=','customers.id','left')
        ->select('pick.*','customers.username','count(*) as allcount')
        ->count();
        $totalRecordswithFilter = DB::table('pick')
        ->join('customers','pick.cust_id','=','customers.id','left')
        ->select('pick.*','customers.username','count(*) as allcount')
        ->where(function($q) use($searchValue) {
          $q->where('customers.username', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
          $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
        })
        ->count();

        // Fetch records
        $records = DB::table('pick')->orderBy($columnName,$columnSortOrder)
              ->join('customers','pick.cust_id','=','customers.id','left')
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
              })
              ->select('pick.*','customers.username')
              ->skip($start)
              ->take($rowperpage)
              ->get();
      }
      else{
        $per = DB::table('permissions')->where('admin_id', $rolid)->first();
        $ward = explode(',',$per->ward);
        // Total records
        $totalRecords = DB::table('pick')
                    ->whereIn('pick.ward',$ward)
                    ->join('customers','pick.cust_id','=','customers.id','left')
                    ->select('pick.*','customers.username','count(*) as allcount')
                    ->count();
        $totalRecordswithFilter = DB::table('pick')
                    ->whereIn('pick.ward',$ward)
                    ->join('customers','pick.cust_id','=','customers.id','left')
                    ->select('pick.*','customers.username','count(*) as allcount')
                    ->where(function($q) use($searchValue) {
                      $q->where('customers.username', 'like', '%' .$searchValue . '%');
                      $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                      $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                      $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                      $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
                    })
                    ->count();

        // Fetch records
        $records = DB::table('pick')->orderBy($columnName,$columnSortOrder)
              ->join('customers','pick.cust_id','=','customers.id','left')
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
              })
              ->whereIn('pick.ward',$ward)
              ->select('pick.*','customers.username')
              ->skip($start)
              ->take($rowperpage)
              ->get();
      }

      $data_arr = array();

      foreach($records as $key => $record){
        $id = $start+$key+1;
        $uid = $record->uid;
        $username = strtoupper($record->username);
        $spot = strtoupper($record->q1);
        if(!empty($record->image_data))
        $image = '<img src="'.asset('uploads/pick/' . $record->image_data).'" class="rounded-circle" width="80" height="80" alt="No image">';
        else
        $image = '<img alt="Image not found">';
        $remark = $record->descp ?? '-';
        $date = date("Y-m-d", strtotime($record->created_at));
        $action = '<a href="'.route('admin.breedingspots.view' , ['id' => $record->id]).'" class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';

        $data_arr[] = array(
            "id" => $id,
            "uid" => $uid,
            "username" => $username,
            "q1" => $spot,
            "image_data" => $image,
            "descp" => $remark,
            "created_at" => $date,
            "action" => $action,
        );
      }

      $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordswithFilter,
         "aaData" => $data_arr
      );

      return response()->json($response); 
    }

    public function managebreedingspot()
    {
        // $rolid = session('admin.admin_id');
    //     if($rolid == 1){
    //     $datas = DB::table('pick')
    //             ->select('pick.*','customers.username')
    //             ->join('customers','pick.cust_id','=','customers.id','left')
    //             ->where('pick.q1','=',"Yes")
    //             ->orderBy('pick.id','desc')
    //             ->paginate(10);
    // }
    // else{
    //     $per = DB::table('permissions')->where('admin_id', $rolid)->first();
    //     $ward = explode(',',$per->ward);
    //     $datas = DB::table('pick')
    //             ->select('pick.*','customers.username')
    //             ->join('customers','pick.cust_id','=','customers.id','left')
    //             ->whereIn('pick.ward',$ward)
    //             ->where('pick.q1','=',"Yes")
    //              ->orderBy('pick.id','desc')
    //              ->paginate(10);
    // }
                
        // return view('admin.managebreedingspot', compact('datas'));
        return view('admin.managebreedingspot');
    }
    

    public function getmanagebreedingspot(Request $request){

      ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); 

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data']; 
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value']; 

      $rolid = session('admin.admin_id');
      
      if($rolid == 1){
        // Total records
        $totalRecords = DB::table('pick')
                    ->where('pick.q1','=',"Yes")
                    ->join('customers','pick.cust_id','=','customers.id','left')
                    ->select('pick.*','customers.username','count(*) as allcount')
                    ->count();
        $totalRecordswithFilter = DB::table('pick')
                            ->where('pick.q1','=',"Yes")
                            ->join('customers','pick.cust_id','=','customers.id','left')
                            ->select('pick.*','customers.username','count(*) as allcount')
                            ->where(function($q) use($searchValue) {
                              $q->where('customers.username', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
                            })
                            ->count();

        // Fetch records
        $records = DB::table('pick')->orderBy($columnName,$columnSortOrder)
              ->join('customers','pick.cust_id','=','customers.id','left')
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
              })
              ->where('pick.q1','=',"Yes")
              ->select('pick.*','customers.username')
              ->skip($start)
              ->take($rowperpage)
              ->get();
      }
      else{
        $per = DB::table('permissions')->where('admin_id', $rolid)->first();
        $ward = explode(',',$per->ward);
        // Total records
        $totalRecords = DB::table('pick')
                ->where('pick.q1','=',"Yes")
                ->whereIn('pick.ward',$ward)
                ->join('customers','pick.cust_id','=','customers.id','left')
                ->select('pick.*','customers.username','count(*) as allcount')
                ->count();
        $totalRecordswithFilter = DB::table('pick')
                            ->where('pick.q1','=',"Yes")
                            ->whereIn('pick.ward',$ward)
                            ->join('customers','pick.cust_id','=','customers.id','left')
                            ->select('pick.*','customers.username','count(*) as allcount')
                            ->where(function($q) use($searchValue) {
                              $q->where('customers.username', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                              $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
                            })
                            ->count();

        // Fetch records
        $records = DB::table('pick')->orderBy($columnName,$columnSortOrder)
              ->join('customers','pick.cust_id','=','customers.id','left')
              ->where(function($q) use($searchValue) {
                $q->where('customers.username', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.uid', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.q1', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.descp', 'like', '%' .$searchValue . '%');
                $q->orWhere('pick.created_at', 'like', '%' .$searchValue . '%');
              })
              ->where('pick.q1','=',"Yes")
              ->whereIn('pick.ward',$ward)
              ->select('pick.*','customers.username')
              ->skip($start)
              ->take($rowperpage)
              ->get();
      }

      $data_arr = array();

      foreach($records as $key => $record){
        $id = $start+$key+1;
        $uid = $record->uid;
        $username = strtoupper($record->username);
        $spot = strtoupper($record->q1);
        if(!empty($record->image_data))
        $image = '<img src="'.asset('uploads/pick/' . $record->image_data).'" class="rounded-circle" width="80" height="80" alt="No image">';
        else        
        $image = '<img alt="Image not found">';
        $remark = $record->descp ?? '-';
        $date = date("d/m/Y", strtotime($record->created_at));
        $action = '<a href="'.route('admin.breedingspots.view' , ['id' => $record->id]).'" class="btn btn-outline-primary-2x"><i class="fa fa-eercast" aria-hidden="true"></i></a>';
        if($record->source_reduction == "Done"){
          $source_reduction = '<a class="text-decoration-none text-dark" href="#" role="button" data-bs-toggle="modal" data-bs-target="#sourcered'.$record->id.'">Done</a>
                              <div class="modal fade" id="sourcered'.$record->id.'" tabindex="-1" aria-labelledby="sourceredLabel" aria-hidden="true">
                              <div class="modal-dialog"> <div class="modal-content"> <div class="modal-body">
                              <div class="row"> <h6>Image</h6>';
          if(!empty($record->source_reduction_img)) 
            $source_reduction .= '<img src="'.asset('uploads/pick/' . $record->source_reduction_img).'" class="img-thumbnail" width="180" height="180" alt="No image">';
          else
            $source_reduction .= '<img alt="Image not found">';                                          
          $source_reduction .= '</div></div></div></div></div>';
        }
        else if($record->source_reduction == "Not Done")
          $source_reduction = '<p>'.$record->source_reduction.'</p>';
        else
          $source_reduction = '<p>-</p>';

        $data_arr[] = array(
            "id" => $id,
            "uid" => $uid,
            "username" => $username,
            "q1" => $spot,
            "image_data" => $image,
            "descp" => $remark,
            "created_at" => $date,
            'source_reduction'=>$source_reduction,
            "action" => $action,
        );
      }

      $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordswithFilter,
         "aaData" => $data_arr
      );

      return response()->json($response); 
    }
    public function viewspot($id)
    {
        $data = DB::table('pick')
                ->select('pick.*','customers.username','customers.roles','ward.name as wardname')
                ->join('customers','pick.cust_id','=','customers.id','left')
                ->join('ward','pick.ward','=','ward.id','left')
                ->where('pick.id',$id)->first();
        
        // dd($data);
            return view('admin.viewspot', compact('data'));
        
        
    }
    public function openPickupsFetchPage()
    {
        $datas = WastePickup::all();
        return view('admin.wastepickups', compact('datas'));
    }
    
    public function fetchAllPickUps()
    {
        
        
        if(request()->ajax()) {
            $data = WastePickup::all();

        return DataTables::of($data)
    
        ->addColumn('id', function($data){
                
            if(empty($data)){
                $id = $data->id;
            }else{
            $id = $data->id;
            }
            return $id;
        })

        ->addColumn('uid', function($data){
            $userID = '<p>'.$data->uid.'</p>';
            return $userID;
        })
        ->addColumn('cust_id', function($data){
            $customerName = '<p>'.$this->getCustomerName($data->cust_id).'</p>';
            return $customerName;
        })
        ->addColumn('waste', function($data){
            $waste = '<p>'.$data->waste.'</p>';
            return $waste;
        })
        ->addColumn('image_data', function($data){
                
            if(!empty($data->image_data))    
                $wastePickUpImg = '<img src="'.asset('uploads/pick/' . $data->image_data).'" class="rounded-circle" width="100" height="100" alt="No image">';
        
            else
                $wastePickUpImg = '<img alt="Image not found">';
            
            return $wastePickUpImg;
        })
        ->addColumn('zone', function($data){
            
            if($data->zone){
            $rol = DB::table('zone')->where('id', $data->zone)->first();
            $zone = '<p>'.$rol->title.'</p>';
            }
            else{
            $zone = "Not available";
            }
            return $zone;
        })
         ->addColumn('division', function($data){
            
            if($data->division){
            $rol = DB::table('division')->where('id', $data->division)->first();
            $division = '<p>'.$rol->name.'</p>';
            }
            else{
            $division = "Not available";
            }
            return $division;
        })
         ->addColumn('ward', function($data){
            
            if($data->ward){
            $rol = DB::table('ward')->where('id', $data->ward)->first();
            $ward = '<p>'.$rol->name.'</p>';
            }
            else{
            $ward = "Not available";
            }
            return $ward;
        })
        ->addColumn('descp', function($data){
            
            if(!empty($data->descp))  
            $descr = '<p>'.$data->descp.'</p>';
            
            else
            $descr = "Not available";
            
            return $descr;
        })
        ->addColumn('phone', function($data){
            
            if(!empty($data->phone))  
            $phoneNum = '<p>'.$data->phone.'</p>';
            
            else
            $phoneNum = "Not available";
            
            return $phoneNum;
        })
        
        
        ->addColumn('created_at', function($data){
            
            $pickUpTSArr = explode(" ", $data->created_at);
            $pickUpDate = $pickUpTSArr[0];
            
            $pickUpDateDDMMYYYY = '<p>'.date("d/m/Y", strtotime($pickUpDate)).'</p>';
            return $pickUpDateDDMMYYYY;
        })
        
        /*->addColumn('status', function($data){

            if($data->status != null){

                if($data->status == 1){
                    $status = '<span>Progress</span>';    
                }

                else if($data->status == 2){
                    $status = '<span>Picked Up</span>';    
                }
                    
                else{
                    $status = '<span>Dropped</span>';
                }
    
                return $status;
            } 
        })
        ->addColumn('action', function($data){

            $button = '<div class = "">';
            
            $button .= ' <a href="'.url('admin/wasteInfo/view/' . $data->id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                    
            $button .= '</div>';
            return $button;
        })*/
           
        /*->rawColumns(['action', 'status', 'dropped_on', 'picked_on', 'waste_type', 'vehicle_num', "id"])*/
        
        ->rawColumns(["id", "uid", "cust_id",'image_data', 'waste', "zone", "division", "ward", "phone", 'descp', "created_at"])
        ->addIndexColumn()
        ->make(true);  
        }
         
        return view('admin.wastepickups');
    }
    
    
    function getCustomerName($custID)
    {
        $custData = DB::select("Select oname FROM customers where id=$custID");

        foreach($custData as $cu)
            $custName = $cu->oname;
    
        return $custName;
    }
}
?>