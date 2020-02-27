<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use App\User;

class IsLimit
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
        $usersNo = count(User::where('roleId', '!=', 5)->get()->toArray());
        $limitation = Setting::where('name', 'limitation')->first();
        $limitationType = $limitation['type'];
        $limitationUsersNo = $limitation['usersNo'];

        if ($limitationUsersNo >= $usersNo && $limitationType == 1) {

            return $next($request);
        }

        return abort(404);
    }
}
