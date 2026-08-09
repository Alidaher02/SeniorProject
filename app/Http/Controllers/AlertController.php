<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Shipment;

class AlertController extends Controller
{


        public function alerts(Request $request)
        {
            $status = $request->status;

            $alerts = Alert::with(['shipment.sensorReadings'])
                ->when($status, function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->latest()
                ->get();

            return response()->json([
                'alerts' => $alerts
            ]);
        }

public function alertCounts()
{
    $countActive = Alert::where('status' , 'active')->count();
    $countResolved = Alert::where('status' , 'resolved')->count();
    $totalCount = Alert::count();

    return response()->json([
        'countActive' => $countActive,
        'countResolved' => $countResolved,
        'totalCount' => $totalCount

    ]);
}


}