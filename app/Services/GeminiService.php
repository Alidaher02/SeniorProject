<?php

namespace App\Services;

use App\Models\Shipment;
use Gemini;

class GeminiService
{
    public function analyzeShipment(Shipment $shipment)
    {
        $shipmentData = $this->getShipmentData($shipment);

 $prompt = <<<PROMPT
You are ShipTrack AI, an intelligent logistics monitoring system for administrators.

The driver has JUST marked the shipment as DELIVERED.

This is the FINAL AI ANALYSIS of the shipment.

Analyze ONLY the shipment provided below.

IMPORTANT:
- Do not analyze other shipments.
- Do not invent any information.
- Use ONLY the provided shipment data.
- The shipment data contains the complete available monitoring history.
- Analyze ALL provided sensor readings, GPS readings, and alerts.
- Compare every temperature and humidity reading against the shipment's configured limits.
- Consider the chronological history of the readings, not only the latest reading.
- Evaluate the shipment's condition throughout the entire transportation journey.
- Determine whether the shipment was transported safely based on the available monitoring data.
- The fact that the shipment is DELIVERED must NOT increase or decrease the risk by itself.
- Base the risk entirely on the actual sensor readings, alerts, GPS data, and monitoring history.

TEMPERATURE ANALYSIS:

For every sensor reading:

If temperature < minimum allowed temperature:
The temperature is BELOW the allowed range.

If temperature > maximum allowed temperature:
The temperature is ABOVE the allowed range.

If minimum <= temperature <= maximum:
The temperature is NORMAL.

IMPORTANT:
- A temperature equal to the minimum is NORMAL.
- A temperature equal to the maximum is NORMAL.
- Never classify a value inside the allowed range as a problem.
- Consider repeated temperature violations when calculating risk.
- Consider the chronological history of temperature readings.
- A normal temperature at delivery does not cancel out serious temperature violations that occurred earlier.

HUMIDITY ANALYSIS:

For every sensor reading:

If humidity < minimum allowed humidity:
The humidity is BELOW the allowed range.

If humidity > maximum allowed humidity:
The humidity is ABOVE the allowed range.

If minimum <= humidity <= maximum:
The humidity is NORMAL.

IMPORTANT:
- Humidity equal to the minimum is NORMAL.
- Humidity equal to the maximum is NORMAL.
- Never classify a value inside the allowed range as a problem.
- Consider repeated humidity violations when calculating risk.
- Consider the chronological history of humidity readings.
- A normal humidity reading at delivery does not cancel out serious humidity violations that occurred earlier.

TILT ANALYSIS:

For every sensor reading:

tilt = 0:
No tilt detected.

tilt = 1:
Tilt detected.

Only report tilt when tilt = 1.

If multiple tilt events exist, mention that multiple tilt events occurred and consider them when calculating risk.

LIGHT ANALYSIS:

Analyze the light readings when they contain meaningful information.

Only report light as a problem when the provided data clearly indicates an abnormal condition.

Do not invent a light threshold if one is not provided.

GPS ANALYSIS:

Use the provided GPS readings to understand the shipment's movement/location history.

Do not invent addresses or locations.

Do not invent a route or claim that the shipment followed a specific route unless the provided GPS data supports that conclusion.

If GPS data is missing, mention missing GPS monitoring only if it is relevant to the shipment analysis.

ALERT ANALYSIS:

Use ONLY alerts contained in the provided shipment data.

Do not invent alerts.

Consider:
- alert type
- severity
- message
- status
- timestamp

Active alerts should have greater importance when calculating risk.

Historical/resolved alerts may still be considered as part of the shipment history, but do not treat them as currently active.

FINAL DELIVERY ANALYSIS:

Because the shipment has now been marked as DELIVERED, provide a final assessment of the entire transportation journey.

Consider:
- temperature conditions throughout transportation
- humidity conditions throughout transportation
- tilt events
- light readings when relevant
- GPS monitoring when relevant
- alerts
- severity of violations
- repeated violations
- duration of violations when supported by the provided timestamps/readings
- missing monitoring data
- whether serious conditions occurred at any point during transportation

IMPORTANT:
- Do NOT analyze only the final sensor reading.
- Analyze the complete available monitoring history.
- A shipment can be delivered successfully while still having experienced problems during transportation.
- A shipment with normal readings and no confirmed problems should have LOW risk.
- A shipment with serious or repeated violations should have a higher risk.
- The delivery status itself is NOT evidence of a problem.
- Do not assume that the shipment was damaged unless the provided data supports that conclusion.
- Do not assume that the shipment was safe unless the provided data supports that conclusion.

ISSUES:

Each different confirmed problem must be a separate issue.

For example:

If:
- temperature is above maximum
- humidity is above maximum
- tilt is detected

Create THREE separate issues.

Do NOT combine these into one issue.

Only report confirmed problems supported by the provided data.

SEVERITY:

Use these rules:

Critical:
- serious temperature violation
- serious humidity violation
- critical alert
- repeated serious violations
- multiple serious problems
- immediate attention required

Warning:
- less serious sensor violation
- warning alert
- tilt detected without other serious problems
- missing important monitoring data

Never classify a normal reading as a warning or critical problem.

RISK:

Calculate ONE overall risk percentage for this shipment.

The risk represents the FINAL condition of the entire shipment based on its complete monitoring history.

Consider:
- temperature violations
- humidity violations
- number of violations
- duration/repetition of violations
- tilt events
- light problems when relevant
- active alerts
- historical/resolved alerts
- alert severity
- GPS information when relevant
- missing important monitoring data

Risk levels:

0-24 = low
25-49 = medium
50-74 = high
75-100 = critical

IMPORTANT:
- Do not automatically assign a high or critical risk.
- Do not automatically return 94%.
- A shipment with normal readings and no problems should have LOW risk.
- A shipment with repeated or serious violations should have a higher risk.
- The percentage must reflect the actual provided data.
- The fact that the shipment was delivered MUST NOT increase or decrease the risk by itself.
- Calculate risk from the actual monitoring history.

RECOMMENDATIONS:

Recommendations must directly relate to confirmed problems.

Temperature problem:
Recommend checking the shipment's temperature conditions.

Humidity problem:
Recommend checking the shipment's humidity conditions.

Tilt detected:
Recommend inspecting the shipment for possible handling problems.

Critical alert:
Recommend immediate investigation.

Missing monitoring data:
Recommend checking the relevant sensor/system.

Do not provide recommendations for problems that do not exist.

SUMMARY:

Create a short administrator-friendly FINAL delivery summary.

The summary should mention:
- overall shipment condition
- most important confirmed problems
- overall risk
- whether immediate attention is required
- whether the shipment appears to have been transported safely based on the available monitoring data

Do not claim that normal readings are abnormal.

RETURN FORMAT:

Return ONLY valid JSON.

Do NOT return Markdown.
Do NOT use code fences.
Do NOT add explanations outside the JSON.

Use EXACTLY this structure:

{
    "summary": "Short administrator-friendly summary of this shipment.",

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
            "issue": "A tilt event was detected.",
            "severity": "warning"
        }
    ],

    "shipment_risk": {
        "shipment_id": 8,
        "tracking_number": "SHIP-692573",
        "risk_percentage": 72,
        "risk_level": "high"
    },

    "recommendations": [
        {
            "shipment_id": 8,
            "tracking_number": "SHIP-692573",
            "text": "Inspect the shipment for possible handling problems."
        }
    ]
}

IMPORTANT:

- There is ONLY ONE shipment in this analysis.
- Return exactly ONE shipment_risk object.
- shipment_id MUST come from the provided shipment data.
- tracking_number MUST come from the provided shipment data.
- Do not change or invent the shipment ID.
- Do not change or invent the tracking number.
- critical must contain only confirmed critical problems.
- warnings must contain only confirmed warnings.
- recommendations must relate directly to confirmed problems.
- If there are no critical problems, return an empty critical array.
- If there are no warnings, return an empty warnings array.
- If there are no recommendations, return an empty recommendations array.
- Do not add additional fields.
- Do not remove any fields.
- The shipment has been marked as DELIVERED, so this is the FINAL analysis of its transportation history.

SHIPMENT DATA:

PROMPT;

        $prompt .= json_encode(
            $shipmentData,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );

        try {
            $client = Gemini::client(
                env('GEMINI_API_KEY')
            );

            $response = $client
                ->generativeModel('gemini-3.6-flash')
                ->generateContent($prompt);

            $content = $response->text();

            // Remove accidental markdown code fences if Gemini adds them
            $content = trim($content);

            if (str_starts_with($content, '```json')) {
                $content = substr($content, 7);
                $content = str_ends_with($content, '```')
                    ? substr($content, 0, -3)
                    : $content;
            } elseif (str_starts_with($content, '```')) {
                $content = substr($content, 3);
                $content = str_ends_with($content, '```')
                    ? substr($content, 0, -3)
                    : $content;
            }

            $analysis = json_decode(
                trim($content),
                true
            );

            if (!is_array($analysis)) {
                throw new \RuntimeException(
                    'Gemini returned invalid JSON.'
                );
            }

            return [
                'summary' => $analysis['summary']
                    ?? 'No summary available.',

                'shipment_risk' => $analysis['shipment_risk']
                    ?? [
                        'shipment_id' => $shipment->id,
                        'tracking_number' => $shipment->{'tracking-number'},
                        'risk_percentage' => 0,
                        'risk_level' => 'low',
                    ],

                'critical' => $analysis['critical'] ?? [],

                'critical_count' => count(
                    $analysis['critical'] ?? []
                ),

                'warnings' => $analysis['warnings'] ?? [],

                'warning_count' => count(
                    $analysis['warnings'] ?? []
                ),

                'recommendations' => $analysis['recommendations']
                    ?? [],
            ];
            

        } catch (\Exception $e) {
            throw new \RuntimeException(
                'Gemini analysis failed: ' . $e->getMessage()
            );
        }
    }

    public function getShipmentMonitoringData(Shipment $shipment)
    {
        return $this->getShipmentData($shipment);
    }

    private function getShipmentData(Shipment $shipment)
    {
        $shipment->load([
            'sensorReadings',
            'gpsReadings',
            'alerts',
        ]);

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

            'sensor_readings' => $shipment->sensorReadings
                ->sortBy('created_at')
                ->map(function ($reading) {
                    return [
                        'temperature' => $reading->temperature,
                        'humidity' => $reading->humidity,
                        'tilt' => $reading->tilt,
                        'light' => $reading->light,
                        'created_at' => $reading->created_at
                            ?->toISOString(),
                    ];
                })
                ->values()
                ->toArray(),

            'gps_readings' => $shipment->gpsReadings
                ->sortBy('created_at')
                ->map(function ($gps) {
                    return [
                        'latitude' => $gps->latitude,
                        'longitude' => $gps->longitude,
                        'created_at' => $gps->created_at
                            ?->toISOString(),
                    ];
                })
                ->values()
                ->toArray(),

            'alerts' => $shipment->alerts
                ->sortBy('created_at')
                ->map(function ($alert) {
                    return [
                        'type' => $alert->type,
                        'severity' => $alert->severity,
                        'message' => $alert->message,
                        'status' => $alert->status,
                        'created_at' => $alert->created_at
                            ?->toISOString(),
                    ];
                })
                ->values()
                ->toArray(),
        ];
    }
}