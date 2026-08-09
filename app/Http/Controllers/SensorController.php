<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\Notifications\ShipmentRequested;
use App\Models\Alert;
use Illuminate\Support\Str;


class SensorController extends Controller
{
        public function sensorReading(Shipment $shipment){

    $reading = $shipment->sensorReadings()->latest()->first();

    return response()->json([
        'temperature' => $reading?->temperature,
        'humidity' => $reading?->humidity,
        'tilt' => $reading?->tilt,
        'light' => $reading?->light,
        'created_at' => $reading?->created_at
    ]);

    }

public function storeReadings(Request $request)
{
    $shipment = Shipment::find($request->shipment_id);

    if(! $shipment)
    {
        return response()->json([
            'message' => 'Shipment not found!'
        ], 404);
    }

    $reading = $shipment->sensorReadings()->latest()->first();

    if($reading)
    {
        $reading->update([
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'tilt' => $request->tilt,
            'light' => $request->light
        ]);
    }
    else
    {
        $reading = $shipment->sensorReadings()->create([
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'tilt' => $request->tilt,
            'light' => $request->light
        ]);
    }

    app(\App\Services\ShipmentMonitoringService::class)
    ->analyze($reading);


        return response()->json([
        'message' => 'Sensor Data Received!',
        'reading' => $reading
    ]); 
}
}
