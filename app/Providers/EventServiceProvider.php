<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        /**
         * Authentication Events
         */
        \App\Events\Backend\Auth\UserLoggedIn::class => [
            \App\Listeners\Backend\Auth\UserLoggedInListener::class,
        ],
        \App\Events\Backend\Auth\UserLoggedOut::class => [
            \App\Listeners\Backend\Auth\UserLoggedOutListener::class,
        ],
        \App\Events\Backend\Auth\UserRegistered::class => [
            \App\Listeners\Backend\Auth\UserRegisteredListener::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
