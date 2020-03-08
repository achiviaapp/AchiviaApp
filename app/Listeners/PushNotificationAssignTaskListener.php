<?php

namespace App\Listeners;

use App\Events\PushNotificationAssignTaskEvent;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;

class PushNotificationAssignTaskListener
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
    public function handle(PushNotificationAssignTaskEvent $event)
    {
        Notification::send([$event], new PushNotification());
    }
}
