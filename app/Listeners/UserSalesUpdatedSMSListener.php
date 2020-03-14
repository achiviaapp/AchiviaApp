<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSalesUpdatedEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SmsUpdateNotification;

class UserSalesUpdatedSMSListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserSalesUpdatedEvent $event)
    {
        $user = $event->user;
        Notification::send([$user], new SmsUpdateNotification());

    }
}
