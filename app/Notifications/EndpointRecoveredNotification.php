<?php

namespace App\Notifications;

use App\Models\Endpoint;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EndpointRecoveredNotification extends Notification
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
            ->subject($this->endpoint->location . ' recovered')
            ->markdown('email.email_endpoint_recovered', [
                'endpoint' => $this->endpoint
            ]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
