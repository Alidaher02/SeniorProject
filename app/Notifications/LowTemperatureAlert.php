<?php

namespace App\Notifications;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowTemperatureAlert extends Notification
{
    use Queueable;

    public function __construct(
        public Shipment $shipment,
        public float $temperature,
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'shipment_id' => $this->shipment->id,

            'title' => 'Low Temperature Alert',

            'type' => 'low_temperature',

            'tracking_number' => $this->shipment->{'tracking-number'},

            'value' => $this->temperature,

            'message' =>
                "Shipment {$this->shipment->{'tracking-number'}} has dropped below its minimum temperature limit.",
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}