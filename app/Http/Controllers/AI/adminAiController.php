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

        return response()->json([
            'shipment' => $shipmentData,
            'ai_response' => $geminiService->analyzeShipment($shipment),
            'analyzed_at' => now()->toISOString(),
        ]);
    }
}