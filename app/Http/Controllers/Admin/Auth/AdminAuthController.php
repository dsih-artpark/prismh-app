<?php
namespace App\Http\Controllers\Admin\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;


use Illuminate\Support\Facades\DB;

use Auth;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = Admin::where('email', $request->email)->where('password',$request->password)->first();
       
        if($user){
            Session::put('admin', $user);
            $updata['adminid'] = $user->admin_id;
            $updata['login'] = date('Y-m-d H:i:s');
            $updata['ip'] = $request->ip();
            DB::table('pwa_admin_logs')->insert($updata);
            
             return redirect()->route('admindashboard')->with ('succes', 'You are loggedin Successfully');
        }
        
        else{
            //check email
             $checkemail = Admin::where('email', $request->email)->first();
             if(!empty($checkemail))
             {
                  Session::put('email', $request->email); 
                 return back()->with('error','password are wrong.');
                 
             }
             else
             {
                return back()->with('error','Entered email and password are wrong.');
             }
            
            
        }
        
        // $cred = ['email' => $request->input('email'), 'password' => $request->input('password')];
        // // dd($cred);
        // Auth::guard('admin')->check($cred);
       
        // dd(Auth::guard('admin')->user());
        
        //  if (auth()->guard('admin')->attempt($cred))
        // {
        //     $user = auth()->guard('admin')->user();
            
        //     \Session::put('success','You are Login successfully!!');
        //     return redirect()->route('admindashboard');
            
        // } else {
        //     return back()->with('error','your email and password are wrong.');
        // }
        
        
        // $user = Admin::where('email', $request->email)
        //           ->where('password',md5($request->password))
        //           ->first();
                  
        //           if($user)
        //           {
        //           echo "s";die;      
        //     // \Session::put('success','You are Login successfully!!');
        //     return redirect()->route('admindashboard');
        //           }
               
    //  dd(auth()->guard('admin')->attempt(['email' => $user->email, 'password' =>$user->password]));
     
        
      
    //     dd(Auth::guard('admin')->attempt($credentials));
        
        
        
    //          dd(auth()->guard('admin')->attempt($credentials));
    //     dd(auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' =>$request->input('password')]));
    //     if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => md5($request->input('password'))]))
    //     {
    //         $user = auth()->guard('admin')->user();
            
    //         \Session::put('success','You are Login successfully!!');
    //         return redirect()->route('admindashboard');
            
    //     } 
        // else {
        //     return back()->with('error','your email and password are wrong.');
        // }

    }

    public function logout()
    {

        Auth::guard('admin')->logout();
        
        $sessdata = Session::get('admin');
        $upid = $sessdata->admin_id;
        $user = DB::table('pwa_admin_logs')->where('adminid', $upid)->first();
        if(!empty($user)){
        
            $updata['logout'] = date('Y-m-d H:i:s');
            DB::table('pwa_admin_logs')->where('adminid',$upid)->update($updata);
        }
        
        \Session::flush();
        \Session::put('success','You have logged out successfully');        
        return redirect(route('adminLogin'));
    }
    
    public function dashboard()
    {
         
        
        return view('admin.dashboard');
        
    }
}