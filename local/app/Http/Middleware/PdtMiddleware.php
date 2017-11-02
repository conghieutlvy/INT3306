<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
class PdtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('pdt')->check()) {
            return $next($request);
        } else if(Auth::guard('sinhvien')->check())
        {
            return Redirect::back();
        }
		return redirect()->route('login');
    }
}
