<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CkeckAbssentSaleEvent;
use App\Models\Leave;
use App\User;

class CkeckAbssentSaleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(CkeckAbssentSaleEvent $event)
    {
        $today = date('Y-m-d');
        $sale = $event->user;

        $lastLeave = Leave::where('userId', $sale['id'])->latest('created_at')->first();
        $fromDate = $lastLeave['start_date'];
        $toDate = $lastLeave['end_date'];
        if ($today < $fromDate && $today > $toDate) {
            $user = User::find($sale['id'])->update(['assign' => '0']);
        }
    }
}
