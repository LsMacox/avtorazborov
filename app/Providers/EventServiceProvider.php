<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

// Events
use Illuminate\Auth\Events\Registered;
use App\Events\StoreAlert;

// Listeners
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendAlertConfirmationEmail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StoreAlert::class => [
          SendAlertConfirmationEmail::class,
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
