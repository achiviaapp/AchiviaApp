<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 2020-03-14
 * Time: 21:51
 */

namespace App\Notifications;

use App\Channels\PushNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Interfaces\PushNotificationInterface;
use App\User;

class ActionNotification extends Notification implements PushNotificationInterface
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
        $sale = $notifiable->user;
        $client = $notifiable->client;
        $nextAction = Carbon::parse($client['notificationDate'] . $client['notificationTime'])->format('Y-m-d H:i:s');

        $deviceId = $sale['device_id'] ?? '';
        if ($deviceId != '') {
            return [
                'registration_ids' => [$deviceId],
                'notification' => [
                    'title' => 'Action Notification',
                    'body' => 'You Have Action: ' . $client['actionId'] . 'At ' . $nextAction . 'With' . $client['name'],
                    'icon' => url('/images/favicon.png')
                ],
                'data' => ['url' => url('/client-profile/' . $client['id'])]
            ];
        } else {
            return ['notification' => 'notSend'];
        }
    }
}

