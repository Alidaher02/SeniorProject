<?php

namespace App\Services;

use App\Models\Shipment;
use Gemini;

class GeminiService
{
    public function analyzeShipments()
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
                ->where('status', 'active')
                ->values();

            return [
                'shipment_id' => $shipment->id,

                'tracking_number' => $shipment->{'tracking-number'},

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

                'active_alerts' => $activeAlerts->map(function ($alert) {
                    return [
                        'type' => $alert->type,
                        'severity' => $alert->severity,
                        'message' => $alert->message,
                    ];
                })->values(),
            ];
        })->values();

        $prompt = <<<PROMPT
You are ShipTrack AI, a logistics monitoring system for administrators.

Analyze ALL provided in-transit shipments.

Use ONLY the provided shipment data.

Do not invent any information.

TEMPERATURE RULES:

temperature < minimum:
Temperature is below the allowed minimum.

temperature > maximum:
Temperature is above the allowed maximum.

minimum <= temperature <= maximum:
Temperature is NORMAL.

IMPORTANT:
If temperature equals the minimum, it is NORMAL.
If temperature equals the maximum, it is NORMAL.

HUMIDITY RULES:

humidity < minimum:
Humidity is below the allowed minimum.

humidity > maximum:
Humidity is above the allowed maximum.

minimum <= humidity <= maximum:
Humidity is NORMAL.

IMPORTANT:
If humidity equals the minimum, it is NORMAL.
If humidity equals the maximum, it is NORMAL.

TILT:

tilt = 0:
No tilt detected.

tilt = 1:
Tilt detected.

Only report tilt when tilt = 1.

ACTIVE ALERTS:

Only use alerts contained in active_alerts.

Never invent alerts.

RISK:

Calculate ONE overall risk percentage for EVERY shipment.

The risk represents the entire shipment, not an individual alert.

Consider:

- temperature
- humidity
- tilt
- light when relevant
- active alerts
- alert severity
- number of problems
- severity of problems
- missing important data

Risk levels:

0-24 = low
25-49 = medium
50-74 = high
75-100 = critical

Do not give every shipment the same percentage.

Do not automatically return 94%.

A shipment with normal readings and no problems should have LOW risk.

Multiple serious problems should result in a higher risk.

ISSUES:

Each different problem must be a separate object.

For example, if temperature is high AND humidity is high AND tilt is detected, create THREE separate issues.

Do not combine them into one issue.

SEVERITY:

Critical:
- serious sensor violations
- critical alerts
- multiple serious problems
- immediate attention required

Warning:
- less serious problems
- warning alerts
- tilt without other serious problems
- missing important monitoring data

Never classify a normal reading as critical or warning.

RECOMMENDATIONS:

Recommendations must directly relate to confirmed problems.

Temperature problem:
Recommend checking temperature conditions.

Humidity problem:
Recommend checking humidity conditions.

Tilt:
Recommend inspecting the shipment for handling problems.

Critical alert:
Recommend immediate investigation.

SUMMARY:

Create a short administrator-friendly summary.

Mention the most important confirmed problems and risks.

Never say a normal reading is abnormal.

RETURN ONLY VALID JSON.

Do not return Markdown.

Use exactly this structure:

{
    "summary": "Overall shipment situation.",

    "critical": [
        {
            "shipment_id": 8,
            "tracking_number": "SHIP-692573",
            "issue": "Temperature reached 23.00°C, exceeding the maximum allowed limit of 8.00°C.",
            "severity": "critical"
        }
    ],

    "warnings": [
        {
            "shipment_id": 8,
            "tracking_number": "SHIP-692573",
            "issue": "A tilt event has been detected.",
            "severity": "warning"
        }
    ],

    "shipment_risks": [
        {
            "shipment_id": 8,
            "tracking_number": "SHIP-692573",
            "risk_percentage": 72,
            "risk_level": "high"
        }
    ],

    "recommendations": [
        {
            "shipment_id": 8,
            "tracking_number": "SHIP-692573",
            "text": "Inspect the shipment for possible handling problems."
        }
    ]
}

IMPORTANT:

Every shipment must appear exactly once in shipment_risks.

The shipment_id and tracking_number MUST come from the provided data.

SHIPMENT DATA:

PROMPT;

        $prompt .= json_encode(
            $shipmentData,
            JSON_PRETTY_PRINT
        );

        try {

            $client = Gemini::client(
                env('GEMINI_API_KEY')
            );

            $response = $client
                ->generativeModel('gemini-3.6-flash')
                ->generateContent($prompt);

            $content = $response->text();

            $analysis = json_decode($content, true);

            if (!is_array($analysis)) {
                throw new \RuntimeException(
                    'Gemini returned invalid JSON.'
                );
            }

                return [
                    'summary' => $analysis['summary'] ?? 'No summary available.',

                    'active_shipments' => $shipments->count(),

                    'active_alerts' => $shipments
                        ->flatMap->alerts
                        ->where('status', 'active')
                        ->count(),

                    'critical' => $analysis['critical'] ?? [],

                    'critical_count' => count($analysis['critical'] ?? []),

                    'warnings' => $analysis['warnings'] ?? [],

                    'warning_count' => count($analysis['warnings'] ?? []),

                    'shipment_risks' => $analysis['shipment_risks'] ?? [],

                    'recommendations' => $analysis['recommendations'] ?? [],
                ];

        } catch (\Exception $e) {

            throw new \RuntimeException(
                'Gemini analysis failed: ' . $e->getMessage()
            );
        }
    }
}