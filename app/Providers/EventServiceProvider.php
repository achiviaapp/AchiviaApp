<?php

namespace App\Providers;

use App\Events\ClientDetailCreatedEvent;
use App\Events\UserCreatedEvent;
use App\Events\UserSalesUpdatedEvent;
use App\Listeners\AssignSaleManToClientAutoListener;
use App\Listeners\UserCreatedSMSListener;
use App\Listeners\UserSalesUpdatedSMSListener;
use App\Listeners\NewAssignNotificationListener;
use App\Events\CkeckAbssentSaleEvent;
use App\Listeners\CkeckAbssentSaleListener;
use App\Events\NewAssignNotificationEvent;
use Illuminate\Auth\Events\Registered;
use App\Events\PushNotificationActionDateEvent;
use App\Events\PushNotificationAssignTaskEvent;
use App\Listeners\PushNotificationActionDateListener;
use App\Listeners\PushNotificationAssignTaskListener;
use App\Listeners\PushNotificationCustomNotificationListener;
use App\Events\PushNotificationCustomNotificationEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
        ],

        'Illuminate\Auth\Events\Attempting' => [
            'App\Listeners\LogAuthenticationAttempt',
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        UserCreatedEvent::class => [
            UserCreatedSMSListener::class,
        ],

        ClientDetailCreatedEvent::class => [
            AssignSaleManToClientAutoListener::class,

        ],

        UserSalesUpdatedEvent::class => [
            UserSalesUpdatedSMSListener::class,
        ],

        NewAssignNotificationEvent::class => [
            NewAssignNotificationListener::class,
        ],

        CkeckAbssentSaleEvent::class => [
            CkeckAbssentSaleListener::class,
        ],

        PushNotificationActionDateEvent::class => [
            PushNotificationActionDateListener::class,
        ],
        PushNotificationAssignTaskEvent::class => [
            PushNotificationAssignTaskListener::class,
        ],
        PushNotificationCustomNotificationEvent::class => [
            PushNotificationCustomNotificationListener::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
