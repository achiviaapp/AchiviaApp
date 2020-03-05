<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PushNotificationAssignTaskEvent;

class Task extends Model
{
    protected $fillable = [
        'userId', 'body','complete',
    ];

    protected $table = 'tasks';

    protected $dispatchesEvents = [
        'created' => PushNotificationAssignTaskEvent::class,
    ];
}
