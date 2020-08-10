<?php

namespace App\Listeners;

use App\Events\StoreAlert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\AlertConfirmationEmail;

class SendAlertConfirmationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StoreAlert  $event
     * @return void
     */
    public function handle(StoreAlert $event)
    {
        \Mail::to($event->email)->send(
            new AlertConfirmationEmail($event->email, $event->proposals, $event->urls)
        );
    }
}
