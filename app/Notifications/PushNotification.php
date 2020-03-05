<?php

namespace App\Notifications;

use App\Channels\PushNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\User;

class PushNotification extends Notification
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

    /**
     * Get the sending representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toPushNotificationActionDate($notifiable)
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

    /**
     * Get the sending representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toPushNotificationTask($notifiable)
    {
        $task = $notifiable->task;
        $user = User::where('id', $task['userId'])->first();
        $deviceId = $user['device_id'] ?? '';
        if ($deviceId != '') {
            return [
                'registration_ids' => [$deviceId],
                'notification' => [
                    'title' => 'Task Notification',
                    'body' => 'You Have New Task: ' . $task['body'] . 'At ' . $task['taskDate'],
                    'icon' => url('/images/favicon.png')
                ],
                'data' => ['url' => url('/user-tasks/' . $user['id'])]
            ];
        } else {
            return ['notification' => 'notSend'];
        }
    }

    /**
     * Get the sending representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toPushNotificationCustom($notifiable)
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
