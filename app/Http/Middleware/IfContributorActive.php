<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IfContributorActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->user_type === "1" && Auth::user()->active_status === "1") {
                return $next($request);
            }
            else {
                return redirect('/your-dashboard');
            }
        }
        else {
            return redirect('/login');
        }
    }
}
