<?php

namespace App\Jobs;

use App\Mail\ShipmentAnlysisMail;
use App\Models\Shipment;
use App\Services\GeminiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class AnalyzeShipment implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Shipment $shipment
    ) {}

    public function handle(GeminiService $geminiService): void
    {
        $aiResponse = $geminiService->analyzeShipment($this->shipment);

        $this->shipment->analysis()->updateOrCreate(
            [],
            [
                'summary' => $aiResponse['summary'],
                'risk_percentage' => $aiResponse['shipment_risk']['risk_percentage'],
                'risk_level' => $aiResponse['shipment_risk']['risk_level'],
                'critical_count' => $aiResponse['critical_count'],
                'warning_count' => $aiResponse['warning_count'],
                'critical' => $aiResponse['critical'],
                'warnings' => $aiResponse['warnings'],
                'recommendations' => $aiResponse['recommendations'],
                'analyzed_at' => now(),
            ]
        );

        Mail::to($this->shipment->customer->email)->send(new ShipmentAnlysisMail($this->shipment));
    }
}