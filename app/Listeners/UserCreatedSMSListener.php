<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserCreatedEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SmsNotification;

class UserCreatedSMSListener
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
    public function handle(UserCreatedEvent $event)
    {
        $user = $event->user;
        Notification::send([$user], new SmsNotification());

    }
}
