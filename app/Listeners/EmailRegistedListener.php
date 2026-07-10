<?php

namespace App\Listeners;

use App\Events\EmailRegistedEvent;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailRegistedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailRegistedEvent $event): void
    {
       Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
    }
}
