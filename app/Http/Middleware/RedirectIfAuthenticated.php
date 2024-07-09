<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && $guard == 'web' && in_array(Auth::guard($guard)->user()->roles,[3,4])) {
              return redirect('executive/dashboard');
            }
            if (Auth::guard($guard)->check() && $guard == 'web' && in_array(Auth::guard($guard)->user()->roles,[5,6])) {
              return redirect('field-executive/dashboard');
            }
            else if(Auth::guard($guard)->check() && $guard == 'admin'){
              return redirect('admin/dashboard');
            }
            else if(Auth::guard($guard)->check() && $guard == 'customer' && Auth::guard($guard)->user()->roles == 1){
              return redirect('asha-worker/dashboard');
            }else if(Auth::guard($guard)->check()){
              return $next($request);
            }
        }

        return $next($request);
    }
}
