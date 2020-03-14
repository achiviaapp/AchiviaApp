<?php

namespace App\Notifications;

use App\Channels\PushNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Interfaces\PushNotificationInterface;

class NewAssignNotification extends Notification implements PushNotificationInterface
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
        $deviceId = $sale['device_id'] ?? '';
        if ($deviceId != '') {
            return [
                'registration_ids' => [$deviceId],
                'notification' => [
                    'title' => 'Assign Client',
                    'body' => 'You Have New Client: ' . $client['name'],
                    'icon' => url('/images/favicon.png')
                ],
                'data' => ['url' => url('/client-profile/' . $client['id'])]
            ];
        } else {
            return ['notification' => 'notSend'];
        }
    }

}
