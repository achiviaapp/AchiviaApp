<?php

namespace App\Providers;

use App\Events\ClientDetailCreatedEvent;
use App\Events\UserCreatedEvent;
use App\Events\UserSalesUpdatedEvent;
use App\Listeners\AssignSaleManToClientAutoListener;
use App\Listeners\UserCreatedSMSListener;
use App\Listeners\UserSalesUpdatedSMSListener;
use App\Listeners\PushNotificationListener;
use App\Events\CkeckAbssentSaleEvent;
use App\Listeners\CkeckAbssentSaleListener;
use App\Events\PushNotificationEvent;
use Illuminate\Auth\Events\Registered;
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

        PushNotificationEvent::class => [
            PushNotificationListener::class,
        ],

        CkeckAbssentSaleEvent::class => [
            CkeckAbssentSaleListener::class,
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
