<?php

namespace App\Services;

use App\Models\Shipment;
use Illuminate\Support\Facades\Http;


class AdminAIService
{
    /**
     * Create a new class instance.
     */
    public function 
    
    analayzeShipments()
    {
         $shipments = Shipment::with([
                'sensorReadings',
                'gpsReadings',
                'alerts'
            ])
            ->where('status', 'in_transit')
            ->get();

        $shipmentData = $shipments->map(function ($shipment) {

            $reading = $shipment->sensorReadings
                                ->sortByDesc('created_at')
                                ->first();
            
            $gps = $shipment->gpsReadings
                            ->sortByDesc('created_at')
                            ->first();
            $activeAlerts = $shipment->alerts
                                    ->where('status' , 'active')
                                    ->values();
            return [
                'id' => $shipment->id,
                'tracking' => $shipment->{'tracking-number'},
                'product' => $shipment->product_name,
                'status' => $shipment->status,

                'origin' => $shipment->origin,
                'destination' => $shipment->destination,

                'temperature_limits' => [
                    'min' => $shipment->min_temperature,
                    'max' => $shipment->max_temperature,
                ],

                'humidity_limits' => [
                    'min' => $shipment->min_humidity,
                    'max' => $shipment->max_humidity,
                ],

                'latest_reading' => [
                    'temperature' => $reading?->temperature,
                    'humidity' => $reading?->humidity,
                    'tilt' => $reading?->tilt,
                    'light' => $reading?->light,
                ],

                'gps' => [
                    'latitude' => $gps?->latitude,
                    'longitude' => $gps?->longitude,
                ],

                'active_alerts' => $activeAlerts->map(fn ($alert) => [
                    'type' => $alert->type ?? null,
                    'severity' => $alert->severity ?? null,
                    'message' => $alert->message ?? null,
                ])->values(),
            ];
        });

            $prompt = <<<PROMPT
            You are ShipTrack AI, a logistics assistant writing an administrator-facing summary.
            
            All issues, severities, and risk scores below have ALREADY been calculated by the system.
            Do NOT recalculate, second-guess, or change any severity, risk_percentage, or risk_level.
            Do NOT invent new issues that are not listed below.
            
            Your ONLY job:
            1. Write a concise "summary" (2-4 sentences) describing the overall shipment situation,
            mentioning the most important confirmed problems and any critical risks.
            2. Write a short "recommendations" array — one entry per shipment_id that has at least
            one issue — with practical next-step text tied directly to that shipment's listed issues.
            
            Rules:
            - Use only the shipment_id, tracking_number, issue, and risk data provided below.
            - Never mention a shipment that has no issues in the summary.
            - Never claim a normal reading is abnormal.
            - Return ONLY valid JSON, no Markdown, no text outside the JSON.
            
            Required JSON format:
            {
                "summary": "string",
                "recommendations": [
                    {
                        "shipment_id": 8,
                        "tracking_number": "SHIP-692573",
                        "text": "string"
                    }
                ]
            }
            
            PRE-COMPUTED SHIPMENT ANALYSIS:

            PROMPT . json_encode($shipmentData, JSON_PRETTY_PRINT);


            $response = Http::withToken(env('GROQ_API_KEY'))
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',

                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $prompt,
                    ],
                ],

                'temperature' => 0.2,

                'response_format' => [
                    'type' => 'json_object',
                ],
            ]);

        if ($response->failed()) {
            throw new \RuntimeException(
                'Groq AI analysis failed: ' . $response->body()
            );
        }

        $content = $response->json(
            'choices.0.message.content'
        );

        $analysis = json_decode($content, true);

        if (!is_array($analysis)) {
            throw new \RuntimeException(
                'Groq returned invalid AI analysis.'
            );
        }

        return [
            'summary' => $analysis['summary'] ?? 'No summary available.',

            'active_shipments' => $shipments
                ->whereIn('status', ['approved', 'in_transit'])
                ->count(),

            'active_alerts' => $shipments
                ->flatMap->alerts
                ->where('status', 'active')
                ->count(),

            'critical' => $analysis['critical'] ?? [],

            'warnings' => $analysis['warnings'] ?? [],

            'shipment_risks' => $analysis['shipment_risks'] ?? [],

            'recommendations' => $analysis['recommendations'] ?? [],
        ];
    }

}
