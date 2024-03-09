<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class VerificationController extends Controller
{
    public function manageverification()
    {
        $datas = DB::table('dump')->where('status', 1)->get();
        return view('admin.manageverification', compact('datas'));
        
    }
    public function verifyform($id)
    {
        return view('admin.verifyform', compact('id')); 
        
    }
    public function verifystore(Request $request)
    {
        
            if($request->has('verify')) 
            {
                $data['did'] = $request->input('did');
                $data['dstatus'] = $request->input('dstatus');
                $data['comments'] = $request->input('descp');
                $data['status'] = 1;
                $data['admin_id'] = session('admin.admin_id');
                
                if($request->file('image'))
                    {
                        $file= $request->file('image');
                        $filename= uniqid().$file->getClientOriginalName();
                        $file-> move(public_path('uploads/verify'), $filename);
                        $data['image']= $filename;
                    }
               
                $result =  DB::table('cdverify')->insert($data);
            }
            else
            {
                $data['did'] = $request->input('did');
                $data['dstatus'] = $request->input('dstatus');
                $data['comments'] = $request->input('descp');
                $data['status'] = 2;
                $data['admin_id'] = session('admin.admin_id');
                
                if($request->file('image'))
                    {
                        $file= $request->file('image');
                        $filename= uniqid().$file->getClientOriginalName();
                        $file-> move(public_path('uploads/verify'), $filename);
                        $data['image']= $filename;
                    }
               
                $result =  DB::table('cdverify')->insert($data);
                
            }
            if(!empty($result))
            {
                return redirect()->route('adminverification');
            }
            else
        {
            return back()->with('error','something are wrong.');
        }
        
    }
    
}