<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteDump;
use DataTables;
use Illuminate\Support\Facades\DB;

class WasteDumpController extends Controller
{
    public function openDumpsFetchPage()
    {
        $datas = WasteDump::all();
        
        return view('admin.wastedumps', compact('datas'));
    }
    
    public function fetchAllDumps()
    {
        if(request()->ajax()) {
            $data = WasteDump::all();

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
            
            ->addColumn('pid', function($data){
                $customerName = '<p>'.$this->getPickupName($data->pid).'</p>';
                return $customerName;
            })
            
            ->addColumn('image_data', function($data){
                
                if(!empty($data->image_data))    
                    $wasteDumpImg = '<img src="'.asset('uploads/dump/' . $data->image_data).'" class="rounded-circle" width="100" height="100" alt="No image">';
            
                else
                    $wasteDumpImg = '<img alt="Image not found">';
                
                return $wasteDumpImg;
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
            
            ->addColumn('created_at', function($data){
                
                $dumpTSArr = explode(" ", $data->created_at);
                $dumpDate = $dumpTSArr[0];
                
                $dumpDateDDMMYYYY = '<p>'.date("d/m/Y", strtotime($dumpDate)).'</p>';
                return $dumpDateDDMMYYYY;
            })
        
            
        ->rawColumns(["id", "uid", "cust_id", "pid", 'image_data', "zone", "division", "ward", 'descp', "created_at"])
        ->addIndexColumn()
        ->make(true);  
        }
         
        return view("admin.wastedumps");
    }
    
    
    function getCustomerName($custID)
    {
        $custData = DB::select("Select oname FROM customers where id=$custID");

        foreach($custData as $cu)
            $custName = $cu->oname;
    
        return $custName;
    }
    
    
    function getPickupName($pickupID)
    {
        $pickupData = DB::select("Select waste FROM pick where id=$pickupID");

        foreach($pickupData as $pi)
            $pickupWaste = $pi->waste;
    
        return $pickupWaste;
    }
}

?>