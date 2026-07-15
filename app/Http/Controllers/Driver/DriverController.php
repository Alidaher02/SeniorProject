<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\ShipmentStatus;

class DriverController extends Controller
{
    public function index(Shipment $shipment){

    Gate::authorize('driver.driverDashboard');

    $assignedShipments = Auth::user()->assignedShipments()
    ->whereIn('status' , ['in_transit' , 'delivered'])
    ->get();

    $in_transitCount = Auth::user()->assignedShipments()->where('status' , 'in_transit')->get();
    $deliveredCount = Auth::user()->assignedShipments()->where('status' , 'delivered')->get();

       return view('driver.driverDashboard' , [
        'assignedShipments' => $assignedShipments,
        'in_transitCount' => $in_transitCount,
        'deliveredCount' => $deliveredCount,
        
               ]);
    }


    public function updateToDelivered(Shipment $shipment){

      $shipment->update([
        'status' =>  ShipmentStatus::DELIVERED
      ]);

      return redirect('driver');
    }
}
