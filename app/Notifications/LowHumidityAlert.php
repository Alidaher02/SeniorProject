<?php

namespace App\Notifications;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowHumidityAlert extends Notification
{
    use Queueable;

    public function __construct(
        public Shipment $shipment,
        public float $humidity,
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

            'title' => 'Low Humidity Alert',

            'type' => 'low_humidity',

            'tracking_number' => $this->shipment->{'tracking-number'},

            'value' => $this->humidity,

            'message' =>
                "Shipment {$this->shipment->{'tracking-number'}} has dropped below its minimum humidity limit.",
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}