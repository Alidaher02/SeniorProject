<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShipmentReportMail;

class ShipmentReportController extends Controller
{
    public function generatePDF(Shipment $shipment)
    {
        $shipment->load([
            'customer',
            'driver',
            'sensorReadings',
            'alerts',
            'gpsReadings'
        ]);

        $pdf = Pdf::loadView('pdf.shipments' , [
            'shipment' => $shipment
        ]);

        $fileName = 'shipment-'.$shipment->id.'.pdf';

        return $pdf->download($fileName) ;
    }

    
}
