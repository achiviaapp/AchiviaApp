<?php

namespace App\Channels;

use App\Notifications\SmsUpdateNotification;
use GuzzleHttp;

class SmsChannel
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
     * @param  \App\Notifications\SmsUpdateNotification $notification
     * @return void
     */
    public function send($notifiable, SmsUpdateNotification  $notification): void
    {
        $message = $notification->toSms($notifiable);
        if ($message != null) {
            $this->apiRequest->post(env('SMS_ENDPOINT'), ['query' => $message]);
        }
    }
}