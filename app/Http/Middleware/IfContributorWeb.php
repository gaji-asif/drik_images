<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfContributorWeb
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
            if(Auth::user()->user_type == 1) {
                return $next($request);
            }
            return redirect('/your-dashboard');
        } else {
            return redirect('/login');
        }
    }
}
