<?php

namespace App\Listeners;

use App\Events\EndpointWentDown;
use App\Notifications\EndpointDownNotification;
use Illuminate\Support\Facades\Notification;


class SendDownEmailNotifications
{
    public function __construct()
    {
    }

    public function handle(EndpointWentDown $event): void
    {
        collect($event->check->endpoint->site->notification_emails)->each(function ($email) use ($event) {
            Notification::route('mail', $email)
                        ->notify(new EndpointDownNotification($event->check->endpoint));
        });
    }
}
