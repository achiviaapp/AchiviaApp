<?php

namespace App\Events;

use App\Models\CustomNotification;
use App\Models\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushNotificationCustomNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customNotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CustomNotification $customNotification)
    {
        $this->customNotification = $customNotification;
    }

}
