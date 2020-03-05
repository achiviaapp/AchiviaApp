<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PushNotificationCustomNotificationEvent;

class CustomNotification extends Model
{
    protected $fillable = [
        'userIds', 'title','body',
    ];

    protected $table = 'custom_notifications';

    protected $dispatchesEvents = [
        'created' => PushNotificationCustomNotificationEvent::class,
    ];
}
