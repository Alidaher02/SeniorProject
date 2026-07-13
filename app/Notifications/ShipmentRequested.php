<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ShipmentRequested extends Notification
{
    use Queueable;

    public function __construct(
        public $shipment
    ) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Shipment Request Received 🚚')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your shipment request has been successfully submitted.')
            ->line('')
            ->line('📦 Product: ' . $this->shipment->product_name)
            ->line('📍 From: ' . $this->shipment->origin)
            ->line('🎯 To: ' . $this->shipment->destination)
            ->line('🔎 Tracking Number: ' . $this->shipment->{'tracking-number'})
            ->line('')
            ->line('Status: Pending Approval ⏳')
            ->line('We will notify you once your shipment is approved.')
            ->salutation('Thanks,  
Your Logistics Team');
    }
}