<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 12/20/19
 * Time: 11:46 AM
 */

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\Sending;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via()
    {

        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');

//        $url = url('/invoice/'.$this->invoice->id);
//
//        return (new MailMessage)
//            ->greeting('Hello!')
//            ->line('One of your invoices has been paid!')
//            ->action('View Invoice', $url)
//            ->line('Thank you for using our application!');
    }

    /**
     * Get the sending representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        $date = date("Y-m-d H:i:s");
        $delayUntil = date("Y-m-d H:i:s", strtotime($date) +(60*2));

        $sending = Sending::where('sendingTypeId', 3)->first();
        if ($sending && $sending['active'] == 1) {
            $phone = $notifiable['countryCode'] . ltrim($notifiable['phone'], '0');
            $myBody = [
                'username' => env('SMS_USERNAME'),
                'password' => env('SMS_PASSWORD'),
                'sender' => $sending['senderId'],
                'language' => 2,
                'mobile' => $phone,
                'message' => $sending['body'],
//                'delayUntil' => $delayUntil,
            ];
            return $myBody;
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


}


