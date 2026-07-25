<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
  public function loadAlerts()
{
    $alerts = Alert::with([
        'shipment',
        'shipment.sensorReadings'
    ])
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

}