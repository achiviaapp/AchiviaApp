<?php

namespace App\Listeners;

use App\Models\SaleLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $salesLog = SaleLog::create([
            'userId' => $user->id ,
            'last_login_at' => date('Y-m-d H:i:s'),
             'sessionId'=>request()->session()->getId(),
        ]);
    }
}

