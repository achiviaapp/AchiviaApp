<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 12/20/19
 * Time: 9:55 PM
 */

namespace App\Channels;

use App\Notifications\SmsNotification;
use GuzzleHttp;

class AssignSmsChannel
{
    private $apiRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiRequest = new GuzzleHttp\Client();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \App\Notifications\SmsNotification $notification
     * @return void
     */
    public function send($notifiable, SmsNotification  $notification): void
    {
        $message = $notification->toSms($notifiable);
        if ($message != null) {
           $this->apiRequest->post(env('SMS_ENDPOINT'), ['query' => $message]);
        }
    }
}