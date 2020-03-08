<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class IsExpire
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
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();

        if ($user['expireDate'] || $user['active'] == 0) {
            $expireDate = Carbon::parse($user['expireDate'])->format('Y-m-d');
            $today = Carbon::now()->format('Y-m-d');
            if ($today < $expireDate || $user['active'] != 0 || $user['active'] == null) {
                return $next($request);
            } else {
                auth::logout();
            }
        }
        return $next($request);
    }
}
