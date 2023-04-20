<?php

namespace App\Listeners;

use App\Events\EndpointRecovered;
use App\Notifications\EndpointDownNotification;
use App\Notifications\EndpointRecoveredNotification;
use Illuminate\Support\Facades\Notification;

class SendRecoveredNotifications
{
    public function __construct()
    {
    }

    public function handle(EndpointRecovered $event): void
    {
        collect($event->check->endpoint->site->notification_emails)->each(function ($email) use ($event) {
            Notification::route('mail', $email)
                        ->notify(new EndpointRecoveredNotification($event->check->endpoint));
        });
    }
}
