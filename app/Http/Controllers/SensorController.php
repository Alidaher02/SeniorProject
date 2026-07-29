<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\Notifications\ShipmentRequested;
use Illuminate\Support\Str;


class SensorController extends Controller
{
        public function sensorReading(Shipment $shipment){

    $reading = $shipment->sensorReadings()->latest()->first();

    return response()->json([
        'temperature' => $reading?->temperature,
        'humidity' => $reading?->humidity,
        'created_at' => $reading?->created_at
    ]);

    }

public function storeReadings(Request $request)
{
    $shipment = Shipment::find($request->shipment_id);


    if(!$shipment)
    {
        return response()->json([
            'message' => 'Shipment not found'
        ], 404);
    }


    // Save sensor reading first

    $reading = $shipment->sensorReadings()->create([
        'temperature' => $request->temperature,
        'humidity' => $request->humidity,
    ]);



    // Check temperature limit

    if($reading->temperature > $shipment->max_temperature)
    {
        $shipment->alerts()->delete();
        
        $shipment->alerts()->create([

            'type' => 'Temperature High',

            'message' =>
            "Temperature reached {$reading->temperature}°C. Maximum allowed is {$shipment->max_temperature}°C."

        ]);
    }


    // Check low temperature

    if($reading->temperature < $shipment->min_temperature)
    {
        $shipment->alerts()->delete();

        $shipment->alerts()->create([

            'type' => 'Temperature Low',

            'message' =>
            "Temperature reached {$reading->temperature}°C. Minimum allowed is {$shipment->min_temperature}°C."

        ]);
    }



    return response()->json([
        'message' => 'Sensor Data Received!',
        'reading' => $reading
    ]);
}
}
