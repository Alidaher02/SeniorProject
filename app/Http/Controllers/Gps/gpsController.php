<?php

namespace App\Http\Controllers\Gps;

use App\Http\Controllers\Controller;
use App\Models\GpsReading;
use App\Models\Shipment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class gpsController extends Controller
{
    public function store(Request $request)
    {
        $shipment = Shipment::find($request->shipment_id);

        if(! $shipment)
        {
        return response()->json([
            'message' => 'Shipment not found!'
        ], 404);
        }

        $gpsReading = $shipment->gpsReadings()->latest()->first();

        if($gpsReading)
        {
        $gpsReading->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
        ]);
        }
        else
        {
        $gpsReading = $shipment->gpsReadings()->create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
        ]);
        }

        return response()->json([
            'message' => 'GPS Readings Recieved!',
            'gpsReadings' => $gpsReading

        ]);


        
    }

    public function latest(Shipment $shipment)
    {
        $reading = $shipment->gpsReadings()->latest()->first();

        if(! $reading)
        {
            return response()->json([
                'message' => 'No readings found!'
            ] , 404);
        }

        return response()->json([
            'reading' => $reading
        ]);
    }

    public function address(Shipment $shipment)
    {
        $reading = $shipment->gpsReadings()
        ->latest()
        ->first();

    if (!$reading) {
        return response()->json([
            'message' => 'No GPS reading found!'
        ], 404);
    }

    $response = Http::withHeaders([
        'User-Agent' => 'ShipTrack/1.0'
    ])->get('https://nominatim.openstreetmap.org/reverse', [
        'lat' => $reading->latitude,
        'lon' => $reading->longitude,
        'format' => 'json',
        'accept-language' => 'en',
    ]);

    $address = $response->json('address');

        $location =
            $address['city']
            ?? $address['town']
            ?? $address['village']
            ?? $address['municipality']
            ?? $address['suburb']
            ?? $address['neighbourhood']
            ?? $address['hamlet']
            ?? $address['district']
            ?? 'Unknown location';

    return response()->json([
        'location' => $location,
    ]);
    }
    
    }
