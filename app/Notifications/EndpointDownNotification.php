<?php

namespace App\Notifications;

use App\Models\Endpoint;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EndpointDownNotification extends Notification
{
    public function __construct(public Endpoint $endpoint)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->endpoint->location . ' went down')
            ->markdown('email.email_endpoint', [
                'endpoint' => $this->endpoint
            ]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
