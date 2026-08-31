<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class adminAiController extends Controller
{
    public function index()
    {
        $shipments = Shipment::where('status' , 'in_transit')->get();
        return view('admin.ai-assistant' , [
            'shipments' => $shipments
        ]);
    }

    public function analyze(GeminiService  $geminiService , Shipment $shipment)
    {
        $shipmentData = $geminiService->getShipmentMonitoringData($shipment);

        $ai_response = $geminiService->analyzeShipment($shipment);

        $shipmentAnalysis = $shipment->analysis()->updateOrCreate(
            [],
            [
                'summary' => $ai_response['summary'],
                'risk_percentage' => $ai_response['shipment_risk']['risk_percentage'],
                'risk_level' => $ai_response['shipment_risk']['risk_level'],
                'critical_count' => $ai_response['critical_count'],
                'warning_count' => $ai_response['warning_count'],
                'critical' => $ai_response['critical'],
                'warnings' => $ai_response['warnings'],
                'recommendations' => $ai_response['recommendations'],
                'analyzed_at' => now(),

            ]
        );

        return response()->json([
            'shipment' => $shipmentData,
            'ai_response' => $ai_response,
            'analyzed_at' => now()->toISOString(),
        ]);
    }
}