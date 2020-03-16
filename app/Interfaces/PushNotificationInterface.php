<?php
/**
 * Created by PhpStorm.
 * User: hadeer
 * Date: 2020-03-14
 * Time: 21:40
 */

namespace App\Interfaces;


Interface PushNotificationInterface
{
    public function toPushNotification($notifiable);

}