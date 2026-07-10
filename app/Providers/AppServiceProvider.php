<?php

namespace App\Providers;

use App\Events\EmailRegistedEvent;
use App\Listeners\EmailRegistedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            [
                EmailRegistedEvent::class => EmailRegistedListener::class,
            ]
        );
    }
}
