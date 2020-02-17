<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SaleLog;
use Illuminate\Http\Request;

class LogSuccessfulLogout
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
     * @param  Logout $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = $event->user;

        $log = SaleLog::where('userId', $user->id)
            ->latest('last_login_at')
            ->first();

        if ($log) {
            $log->last_logout_at = date('Y-m-d H:i:s');
            $log->save();
        }
    }
}

