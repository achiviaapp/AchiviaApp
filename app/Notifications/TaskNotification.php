<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 2020-03-14
 * Time: 21:53
 */


namespace App\Notifications;

use App\Channels\PushNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Interfaces\PushNotificationInterface;
use App\User;

class TaskNotification extends Notification implements PushNotificationInterface
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
}