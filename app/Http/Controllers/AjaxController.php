<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;


class AjaxController extends Controller
{
    public function passtest(Request $request)
    {
        $letter = 'a'; // The letter you want to filter by
$tables = ['customers', 'pwa_category', 'pwa_subcategory']; // Array of table names

$filteredRows = DB::table($tables[0]);
// dd($filteredRows);
foreach ($tables as $table) {
    $columns = DB::getSchemaBuilder()->getColumnListing($table);

    foreach ($columns as $column) {
        $filteredRows->orWhereRaw("UPPER($table.$column) LIKE ?", [$letter.'%']);
    }
}
// dd($filteredRows);
$results = $filteredRows->get();

// dd($results);
    }
    public function passtest2(Request $request)
    {
        $word = $request->search;
        $result ='';
        $word = '9633355366'; // The letter you want to filter by
        $table = 'customers'; 
        $tables = ['customers', 'pwa_category', 'pwa_subcategory']; // Array of table names

$filteredRows = DB::table($tables[0]);

foreach ($tables as $table) {
        
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        
        // $filteredRows = DB::table($table);
        
        foreach ($columns as $column) {
        $filteredRows->orWhereRaw("UPPER($table.$column) LIKE ?", [$word.'%']);
        }
}
        $results = $filteredRows->get();
        dd($results);
            if(count($results) > 0)
            {
                foreach ($results as $mem) {
            //  if(($mem->status == '1') && ($mem->roles == '2'))
            if($mem->roles == '2')
                 {
                $url = "url('login/memberdetails/'.$mem->id)";
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                    <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                            if(!empty($mem->profile)){
                            $result.='<img src="'.asset('uploads/customer/'.$mem->profile).'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                            else{
                            $result.='<img src="'.asset('images/avatars/12m.png').'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                        $result.='</a>
                    </div>
                    <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                           
                            $chk = Auth::guard('customer')->id();
                            if($chk == $mem->id){
                            $result.='<h5 class="mb-0 text-capitalize">Me</h5>';
                            }
                            else{
                            $result.='<h5 class="mb-0 text-capitalize">'.$mem->username.'</h5>';
                            }
                            $catdet = DB::table('pwa_category')->select('name as catname')->where('id', $mem->category)->where('status', 1)->first();
                            $subcatdet = DB::table('pwa_subcategory')->select('name as subcatname')->where('id', $mem->subcategory)->where('status', 1)->first();
                            $catname = $catdet ? $catdet->catname : '';
                            $subcatname = $subcatdet ? $subcatdet->subcatname : '';
                            $result.='<p class="mb-0 member-dir-1">'.$catname.'</p>
                            <p class="mb-0 member-dir-1">'.$subcatname.'</p>
                            <a class="member-dir" href="tel:+'.$mem->phone.'">'.$mem->phone.'</a>
                            <p class="mb-0 member-dir-1">'.$mem->bname.'</p>
                        </a>
                       
                    </div>
                    </a>
                </div>
            </div>
        </div>
                
                
                ';
            }
             
         }
            }
            else
            {
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                <h5 class="mb-0 text-capitalize">No data found</h5>
                
                </div>
                </div>
                </div>
                ';
            }
        
        
        
        
        
        
        
        
      
       
        $response = $result;
        return response()->json($response); 
    }
    public function membercategorylist()
    {
        $data = DB::table('pwa_document')->where('status', 1)->get();
        $response = $data;
        return response()->json($response); 
    }
    public function memberonlylist(Request $request)
    {
        $id = $request->val;
        $data = DB::table('customers')->select('customers.username as name','customers.id as id','pwa_category.name as categ')
        ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
        ->where('customers.id','!=', $id)
        ->where('customers.roles', 2)
        ->get();
        
        $response = $data;
        return response()->json($response); 
    }
   
    public function chaptercate(Request $request)
    {
        $id = $request->chapter;
        
            $data = DB::table('customers')
            ->select('customers.chapter','customers.category', 'pwa_category.name as catname', 'pwa_category.id as catid')
            ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
            ->where('customers.chapter', $id)
            // ->groupBy('customers.category')
            ->get();
        //   dd($data); 
        if(!empty($data))
        {
        $result ='';
            foreach($data as $cat)
            {
        
                $result .='
                            <a href="#" class="close-menu p-1 chaptlink" data-id="'.$cat->catid.'">
                            <span class="font-13">'.$cat->catname.'</span>
                        </a>';
            }
        }
        else
        {
            $result .='<a href="#" class="close-menu p-1" data-id=""><span class="font-13">Not Found</span></a>';
            
        }
        
        $response = $result;
        return response()->json($response); 
    }
    public function listchaptmembers(Request $request)
    {
         $word = $request->chapter;
        
            $result ='';
       if($word == 0){
            $data = DB::table('customers')
            ->select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
            ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
            ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
             ->orderBy('customers.id', 'desc')->where('customers.status', 1)->get();
    } 
    else{
        
    
             $data = DB::table('customers')
            ->select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
            ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
            ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
             ->orderBy('customers.id', 'desc')->where('customers.chapter', $word)->where('customers.status', 1)->get();
    }
            if(count($data) > 0)
            {
                foreach($data as $mem)
            {
                $url = "url('login/memberdetails/'.$mem->id)";
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                    <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                            if(!empty($mem->profile)){
                            $result.='<img src="'.asset('uploads/customer/'.$mem->profile).'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                            else{
                            $result.='<img src="'.asset('images/avatars/12m.png').'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                        $result.='</a>
                    </div>
                    <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                           
                            $chk = Auth::guard('customer')->id();
                            if($chk == $mem->id){
                            $result.='<h5 class="mb-0 text-capitalize">Me</h5>';
                            }
                            else{
                            $result.='<h5 class="mb-0 text-capitalize">'.$mem->username.'</h5>';
                            }
                            $result.='<p class="mb-0 member-dir-1">'.$mem->catname.'</p>
                            <p class="mb-0 member-dir-1">'.$mem->subcatname.'</p>
                            <a class="member-dir" href="tel:+'.$mem->phone.'">'.$mem->phone.'</a>
                            <p class="mb-0 member-dir-1">'.$mem->bname.'</p>
                        </a>
                       
                    </div>
                    </a>
                </div>
            </div>
        </div>
                
                
                ';
            }
            
            }
            else
            {
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                <h5 class="mb-0 text-capitalize">No data found</h5>
                
                </div>
                </div>
                </div>
                ';
                
            }
        
       
        $response = $result;
        return response()->json($response); 
    }
    public function listcatmembers(Request $request)
    {
        $word = $request->category;
        $result ='';
       
            $data = DB::table('customers')
            ->select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
            ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
            ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
             ->where('customers.category', $word)->where('customers.status', 1)->get();
            
            
            if(count($data) > 0)
            {
                foreach($data as $mem)
            {
                $url = "url('login/memberdetails/'.$mem->id)";
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                    <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                            if(!empty($mem->profile)){
                            $result.='<img src="'.asset('uploads/customer/'.$mem->profile).'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                            else{
                            $result.='<img src="'.asset('images/avatars/12m.png').'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                            }
                        $result.='</a>
                    </div>
                    <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point">
                        <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                           
                            $chk = Auth::guard('customer')->id();
                            if($chk == $mem->id){
                            $result.='<h5 class="mb-0 text-capitalize">Me</h5>';
                            }
                            else{
                            $result.='<h5 class="mb-0 text-capitalize">'.$mem->username.'</h5>';
                            }
                            $result.='<p class="mb-0 member-dir-1">'.$mem->catname.'</p>
                            <p class="mb-0 member-dir-1">'.$mem->subcatname.'</p>
                            <a class="member-dir" href="tel:+'.$mem->phone.'">'.$mem->phone.'</a>
                            <p class="mb-0 member-dir-1">'.$mem->bname.'</p>
                        </a>
                       
                    </div>
                    </a>
                </div>
            </div>
        </div>
                
                
                ';
            }
            
            }
            else{
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                <h5 class="mb-0 text-capitalize">No data found</h5>
                
                </div>
                </div>
                </div>
                ';
                
            }
            
            
            

        // }
        
       
        $response = $result;
        return response()->json($response); 
    }
    public function listmembersearch(Request $request)
    {
        $word = $request->search;
        $result ='';
        
        $letter = 'A'; // The letter you want to filter by
$tables = [
    'customers' => ['id', 'profile', 'username', 'phone', 'bname', 'status', 'category', 'subcategory'],
    'pwa_category' => ['id as catid', 'name as catname'],
    'pwa_subcategory' => ['id as subid', 'name as subcatname']
]; // Array of table names with arrays of their respective custom columns

// $filteredRows = DB::table($tables[0]);

foreach ($tables as $table => $customColumns) {
    $filteredRows->orWhere(function ($query) use ($table, $customColumns, $letter) {
        foreach ($customColumns as $customColumn) {
            $query->orWhereRaw("UPPER(SUBSTRING($table.$customColumn, 1, 1)) = ?", [$letter]);
        }
    });
}

$filteredRows->where('catid', '=' , 'category');
$filteredRows->where('subcatid', '=' , 'subcategory');
$filteredRows->where('status', 1);

$results = $filteredRows->get();
dd($results);
        
        // if (preg_match('/[^A-Za-z]/', $word)) 
        // {
            $data = DB::table('customers')
            ->select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
            ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
            ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
             ->where('customers.username','LIKE', $word."%")
             ->where('customers.status', 1)
             ->get();
             
             
            
            
            if(count($data) > 0)
            {
                foreach($data as $mem)
                {
                    $url = "url('login/memberdetails/'.$mem->id)";
                    $result.='
                    
                    <div class="card card-style member_directory mt-4">
               
                <div class="content page-profile-team">
                    <div class="row mb-0 align-items-center">
                        <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                            <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                                if(!empty($mem->profile)){
                                $result.='<img src="'.asset('uploads/customer/'.$mem->profile).'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                                }
                                else{
                                $result.='<img src="'.asset('images/avatars/12m.png').'" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">';
                                }
                            $result.='</a>
                        </div>
                        <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point">
                            <a href="'.route('login.member.details',['id'=> $mem->id]).'">';
                               
                                $chk = Auth::guard('customer')->id();
                                if($chk == $mem->id){
                                $result.='<h5 class="mb-0 text-capitalize">Me</h5>';
                                }
                                else{
                                $result.='<h5 class="mb-0 text-capitalize">'.$mem->username.'</h5>';
                                }
                                $result.='<p class="mb-0 member-dir-1">'.$mem->catname.'</p>
                                <p class="mb-0 member-dir-1">'.$mem->subcatname.'</p>
                                <a class="member-dir" href="tel:+'.$mem->phone.'">'.$mem->phone.'</a>
                                <p class="mb-0 member-dir-1">'.$mem->bname.'</p>
                            </a>
                           
                        </div>
                        </a>
                    </div>
                </div>
            </div>
                    
                    
                    ';
                }
            }
            else{
                $result.='
                
                <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                <h5 class="mb-0 text-capitalize">No data found</h5>
                
                </div>
                </div>
                </div>
                ';
                
            }
            
            
            

        // }
        
       
        $response = $result;
        return response()->json($response); 
    }
    public function chapmemberlist(Request $request)
    {
         $val = $request->val;
        $cate = Auth::guard('customer')->user()->category;
        //  die;
        if($val == 2)
        {
            $cate = Auth::guard('customer')->user()->chapter;
            
            $data = DB::table('customers')->select('customers.username as name','customers.id as id','pwa_category.name as categ')
                ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
                ->where('customers.chapter', $cate)
                ->where('customers.roles', 2)
                ->get();
                
               
                
                
        // dd($data);
            //     $data = DB::table('customers')->select('customers.username as name','customers.id as id','pwa_category.name as categ')
            // ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
            // ->where('pwa_category.id', $cate)
            // ->where('customers.status', 1)
            // ->get();
            
            // $data = DB::table('customers')->select('chapter as id','username as name')->where('chapter', $chap)->get();
            
        }
        else if($val ==3){
            $cate = Auth::guard('customer')->user()->chapter;
            $data = DB::table('customers')->select('customers.username as name','customers.id as id','pwa_category.name as categ')
        ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
        ->where('customers.chapter','!=', $cate)
        ->where('customers.roles', 2)
        ->get();
        
        // $data = DB::table('customers')->select('customers.username as name','customers.id as id','pwa_category.name as categ')
        // ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
        // ->where('pwa_category.id','!=',$cate)
        // ->where('customers.status', 1)
        // ->get();
            
            // $data = DB::table('customers')->select('chapter as id','username as name')->where('chapter','!=',$chap)->get();
            
            
            
        }
        $response = $data;
        return response()->json($response); 
    }
    public function subcategorymemlist(Request $request)
    {
        $resp_id = $request->val;
        $result = DB::table('pwa_subcategory')->where('cat_id',$resp_id)->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }
     public function chapmemberdetlist(Request $request)
    {
        $result = DB::table('pwa_chapter')->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function oppocategorylist()
    {
        $result = DB::table('pwa_category')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listopttype()
    {
        $result = DB::table('pwa_opportunitytype')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listoptto()
    {
        $result = DB::table('pwa_opportunityconnect')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listoptreferal()
    {
        $result = DB::table('pwa_referalstatus')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listoptreftype()
    {
        $result = DB::table('pwa_referencetype')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    
     public function listregisternature()
    {
        $result = DB::table('pwa_designation')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
     public function listregisterdesignation()
    {
        $result = DB::table('pwa_nature')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listareasearch(Request $request)
    {
        if (!preg_match('/[^A-Za-z]/', $request->search)) 
        {
            
            $result = DB::table('jm_blr_rs_vasathi')
            ->select('jm_blr_rs_vasathi.id','jm_blr_rs_vasathi.nagar_id','jm_blr_rs_vasathi.name', 'jm_blr_rs_vasathi.name_kn', 'jm_blr_rs_nagar.id as nid', 'jm_blr_rs_nagar.name as nname','jm_blr_rs_nagar.name_kn as nname_kn')
            ->join('jm_blr_rs_nagar', 'jm_blr_rs_vasathi.nagar_id', '=', 'jm_blr_rs_nagar.id')
            ->where('jm_blr_rs_vasathi.name','LIKE', $request->search."%")
            ->get();

        }
        else
        {
             $result = DB::table('jm_blr_rs_vasathi')
              ->select('jm_blr_rs_vasathi.id','jm_blr_rs_vasathi.nagar_id','jm_blr_rs_vasathi.name', 'jm_blr_rs_vasathi.name_kn', 'jm_blr_rs_nagar.id as nid', 'jm_blr_rs_nagar.name as nname','jm_blr_rs_nagar.name_kn as nname_kn')
            ->join('jm_blr_rs_nagar', 'jm_blr_rs_vasathi.nagar_id', '=', 'jm_blr_rs_nagar.id')
            ->where('jm_blr_rs_vasathi.name_kn','LIKE', $request->search."%")
            ->get();
        }
       
        $response = $result;
        return response()->json($response); 
    }
    public function listjag()
    {
        $result = DB::table('pwa_jagrithi')->orderBy('id', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }

    public function listintrarea()
    {
        $result = DB::table('pwa_intre_area')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listallareas()
    {
        $result = DB::table('jm_blr_rs_vasathi')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }

    public function listalltaluk(Request $request)
    {
        $nagar = $request->nagar;
        $areass = DB::table('jm_blr_rs_vasathi')->select('nagar_id')->where('id', $nagar)->first();
        $id = $areass->nagar_id;
        $data['nagar'] = DB::table('jm_blr_rs_nagar')->select('id','bhag_id','name','name_kn')->where('id',$id)->first();
        $bhag_id = $data['nagar']->bhag_id;
        $data['district'] = DB::table('jm_blr_rs_bhag')->select('id','vibhag_id','name','name_kn')->where('id',$bhag_id)->first();
        $vibhag_id = $data['district']->vibhag_id;
        $data['city'] = DB::table('jm_blr_rs_vibhag')->select('id','name','name_kn')->where('id',$vibhag_id)->first();
        $response = $data;
        return response()->json($response); 
    }

    public function listalldistrict(Request $request)
    {
        $taluk = $request->taluk;
        $nagar = DB::table('jm_blr_rs_nagar')->select('bhag_id')->where('id', $taluk)->first();
        $id = $nagar->bhag_id;
        $result = DB::table('jm_blr_rs_bhag')->where('id',$id)->get();
        $response = $result;
        return response()->json($response); 
    }

    public function listallcity(Request $request)
    {
        $district = $request->district;
        $nagar = DB::table('jm_blr_rs_bhag')->select('vibhag_id')->where('id', $district)->first();
        $id = $nagar->vibhag_id;
        $result = DB::table('jm_blr_rs_vibhag')->where('id',$id)->get();
        $response = $result;
        return response()->json($response); 
    }

    

    public function listregisterresp(Request $request)
    {
        $result = DB::table('pwa_responsibility')->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listregisterrespsub(Request $request)
    {
        $resp_id = $request->respid;
        $result = DB::table('pwa_responsibility_sub')->where('resp_id',$resp_id)->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }

    public function category(Request $request)
    {

        $category = $request->category;
// $result = DB::table('subcategorysd')->select('id','subcategoryname')->where('status', 1)->get();
        $result = DB::table('subcategorysd')->select('subcategorysd.id','subcategorysd.subcategoryname')
        ->leftJoin('subcategoryschild', 'subcategorysd.id', '=', 'subcategoryschild.subcategory_id')
        ->where('subcategoryschild.category_id', $category)
        ->where('subcategorysd.status', 1)
        ->get();
        $response = $result;
        return response()->json($response); 
// echo json_encode($response);
    }
    
    public function listregistercountry(Request $request)
    {
        $cat_id = $request->state;
        $state = DB::table('pwa_state')->where('id',$cat_id)->first();
        $id = $state->cou_id;
        $result = DB::table('pwa_country')->where('id',$id)->where('status',1)->orderBy('id', 'desc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listregisterstate(Request $request)
    {
        $result = DB::table('pwa_state')->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listregisterchapter(Request $request)
    {
        $result = DB::table('pwa_chapter')->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listregistercategory(Request $request)
    {
        $result = DB::table('pwa_category')->where('status',1)->get();
        $response = $result;
        return response()->json($response); 
    }

    public function listregistersubcategory(Request $request)
    {
        $cat_id = $request->category;
        $result = DB::table('pwa_subcategory')->where('cat_id',$cat_id)->where('status',1)->orderBy('id', 'desc')->get();
        $response = $result;
        return response()->json($response); 
    }
    
    public function listroles()
    {
        $result = DB::table('roles')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    
    public function listmodules()
    {
        $result = DB::table('modules')->orderBy('name', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    
    public function listsubmodules(Request $request)
    {
        $mod_id = $request->modules;
        $result = DB::table('submodules')->where('mod_id',$mod_id)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listzones()
    {
        $result = DB::table('zone')->orderBy('title', 'asc')->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listdivisions(Request $request)
    {
        $mod_id = $request->zone;
        $result = DB::table('division')->where('zone_id',$mod_id)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listwards(Request $request)
    {
        $mod_id = $request->division;
        $result = DB::table('ward')->where('division_id',$mod_id)->get();
        $response = $result;
        return response()->json($response); 
    }
    public function listallwards()
    {
        $result = DB::table('ward')->where('status', 1)->get();
        $response = $result;
        return response()->json($response); 
    }
    
}