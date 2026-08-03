<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Shipment;

class ShipmentApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public Shipment $shipment;

    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

            public function toMail(object $notifiable): MailMessage
            {
                return (new MailMessage)
                    ->subject('Shipment Approved Successfully')
                    ->view('emails.shipment_Approved', [
                        'shipment' => $this->shipment,
                        'user' => $notifiable
                    ]);
            }
    public function toArray(object $notifiable): array
    {
        return [];
    }
}

