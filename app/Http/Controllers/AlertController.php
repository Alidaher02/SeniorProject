<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Shipment;

class AlertController extends Controller
{


  public function loadAlerts()
{
    $alerts = Alert::with([
        'shipment',
        'shipment.sensorReadings'
    ])
    ->where('status' , 'active')
    ->latest()
    ->get();

    return response()->json($alerts->map(function ($alert) {
        return [
            'message' => $alert->message,
            'type' => $alert->type,
            'severity' => $alert->severity,
            'created_at' => $alert->created_at->diffForHumans(),
            'shipment' => $alert->shipment,
        ];
    }));
}

public function alertCounts()
{
    $count = Alert::where('status' , 'active')->count();

    return response()->json([
        'count' => $count
    ]);
}


}