<?php

namespace App\Listeners\Backend\Auth;

use App\Events\Backend\Auth\UserLoggedOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoggedOutListener
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
     * @param  UserLoggedOut  $event
     * @return void
     */
    public function handle(UserLoggedOut $event)
    {
        //
    }
}
