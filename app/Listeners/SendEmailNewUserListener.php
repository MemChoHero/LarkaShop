<?php

namespace App\Listeners;

use App\Notifications\NewUserNotification;
use Illuminate\Auth\Events\Registered;


class SendEmailNewUserListener
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $event->user->notify(new NewUserNotification());
    }
}
