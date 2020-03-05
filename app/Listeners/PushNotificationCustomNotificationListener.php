<?php

namespace App\Listeners;

use App\Events\PushNotificationCustomNotificationEvent;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;

class PushNotificationCustomNotificationListener
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
    public function handle(PushNotificationCustomNotificationEvent $event)
    {
        Notification::send([$event], new PushNotification());
    }
}
