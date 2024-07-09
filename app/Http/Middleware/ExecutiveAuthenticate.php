<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ExecutiveAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // If Logged IN
      if (Auth::guard()->user() && in_array(Auth::guard()->user()->roles, [3,4])) {
        return $next($request);
      }

      if ($request->ajax() || $request->wantsJson()) {
          return response('Unauthorized.', 401);
      } else {
          return redirect(route('executive.login'));
      }
    }
}
