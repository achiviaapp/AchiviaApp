<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewAssignNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user, $client;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $client)
    {
        $this->user = $user;
        $this->client = $client;
    }

}
