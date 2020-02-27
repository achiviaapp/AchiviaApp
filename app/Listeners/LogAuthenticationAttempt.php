<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SaleLog;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class LogAuthenticationAttempt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Attempting $event
     * @return void
     */
    public function handle(Attempting $event)
    {
//        $user = $event->credentials;
//        $expireDate = User::where('email', $user['email'])->first()['expireDate'];
//        if ($expireDate) {
//            $expireDate = Carbon::parse($expireDate)->format('Y-m-d');
//            $today = Carbon::now()->format('Y-m-d');
//            if ($today < $expireDate) {
//
//            }
//        }
    }
}

