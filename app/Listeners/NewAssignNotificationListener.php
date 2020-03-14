<?php

namespace App\Listeners;

use App\Events\NewAssignNotificationEvent;
use App\Notifications\NewAssignNotification;
use Illuminate\Support\Facades\Notification;

class NewAssignNotificationListener
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
    public function handle(NewAssignNotificationEvent $event)
    {
        Notification::send([$event], new NewAssignNotification());
    }
}
