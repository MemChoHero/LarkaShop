<?php

namespace App\Listeners;

use App\Notifications\PasswordResetNotification;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetListener
{
    public function handle(PasswordReset $event): void
    {
        $event->user->notify(new PasswordResetNotification($event->user->name));
    }
}
