<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Events\OutOfStockEvent;
use App\Listeners\SendAdminMailListener;
use App\Listeners\SendEmailToAdminListener;
use App\Listeners\SendEmailToUserListener;
use App\Listeners\SendPushNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        OutOfStockEvent::class => [
            SendAdminMailListener::class,
        ],
        OrderPlaced::class => [
            SendEmailToUserListener::class,
            SendEmailToAdminListener::class,
            SendPushNotificationListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {}
}
