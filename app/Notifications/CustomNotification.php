<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 2020-03-14
 * Time: 21:55
 */

namespace App\Notifications;

use App\Channels\PushNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Interfaces\PushNotificationInterface;
use App\User;

class CustomNotification extends Notification implements PushNotificationInterface
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via()
    {
        return [PushNotificationChannel::class];
    }

    /**
     * Get the sending representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toPushNotification($notifiable)
    {
        $custom = $notifiable->customNotification;
        $ids = $custom['userIds'];
        $ids = explode(',', $ids);
        $deviceIds = [];
        foreach ($ids as $id) {
            $deviceId = User::where('id', $id)->first()['deviceId'];
            $deviceIds[] = $deviceId;
        }

        if (!empty($deviceIds)) {
            return [
                'registration_ids' => $deviceIds,
                'notification' => [
                    'title' => $custom['title'],
                    'body' => 'You Have Notification: ' . $custom['body'],
                    'icon' => url('/images/favicon.png')
                ],
                'data' => []
            ];
        } else {
            return ['notification' => 'notSend'];
        }
    }
}