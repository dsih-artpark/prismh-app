<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminSession
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('admin')) {
            // user value cannot be found in session
            return redirect()->route('adminLogin')->with ('error', 'Please add login details');
        }

        return $next($request);
    }

}

