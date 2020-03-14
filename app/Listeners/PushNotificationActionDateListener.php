<?php

namespace App\Listeners;

use App\Events\PushNotificationActionDateEvent;
use App\Notifications\ActionNotification;
use App\Notifications\NewAssignNotification;
use Illuminate\Support\Facades\Notification;

class PushNotificationActionDateListener
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
    public function handle(PushNotificationActionDateEvent $event)
    {
        Notification::send([$event], new ActionNotification());
    }
}
