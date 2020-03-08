<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class leaveDecision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'root' || Auth::user()->role->name ==  'Sales Team Leader' || Auth::user()->role->name ==  ' Sales Manager') {

            return $next($request);
        }

        return redirect('/');
    }
}
