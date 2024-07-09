<?php

namespace App\Http\Controllers\SprayTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Hash, DB, File, Session;
use Carbon\Carbon;

class AuthController extends Controller
{
  use AuthenticatesUsers;

  protected $redirectTo = '/spray-team/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm(Request $request)
  {
    return view('spray_team.auth.login');
  }

  public function login(Request $request)
  {
    $chkphone =  DB::table('customers')->where('roles','=', 2)->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();
    if(!empty($chkphone)){
      if(Hash::check($request->input('password'),$chkphone->password)){
        $credentials = $request->only('phone', 'password');
        $credentials['email']=$chkphone->email;
        if(Auth::guard('customer')->attempt($credentials)){
          $dat = Auth::guard('customer')->user();
          $request->session()->put('customers' , $dat);
          $request->session()->save();
          $updata['custid'] = Auth::guard('customer')->user()->id;
          $updata['login'] = date('Y-m-d H:i:s');
          $updata['ip'] = $request->ip();
          DB::table('customers_logs')->insert($updata);
          return redirect()->route('spray_team.dashboard')->with('success','Your account has been logged in successfully!');
        }else
          return redirect()->route('spray_team.login');
      }
      else
        return redirect()->route('spray_team.login')->with('error','Incorrect password');
    }
    else
      return redirect()->route('spray_team.login')->with('error','Invalid Credentials'); 
  }

  protected function loggedOut(Request $request)
  {
    return redirect('/login');
  }
}
