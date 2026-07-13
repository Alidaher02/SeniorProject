<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipment;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Enums\ShipmentStatus;


class AdminController extends Controller
{
   public function index(){

    Gate::authorize('admin.admin');


    return view('admin.admin');
   }

   public function shipmentsView(){

        return view('admin.adminShipments' , [
            'shipments' => Shipment::all()
        ]);
   }

   public function customersView(){

        return view('admin.customers' , [
            'customers' => Auth::user()->where('role' , 'customer')->get()
        ]);
   }

   public function alertsView(){

        return view('admin.alerts');
   }

   public function stats(){
    return response()->json([
     'total' => Shipment::count(),
     'pending' => Shipment::where('status' , 'pending')->count(),
     'approved' => Shipment::where('status' , 'approved')->count(),
     'delivered' => Shipment::where('status' , 'delivered')->count(),
     'in_transit' => Shipment::where('status' , 'in_transit')->count(),
     'rejected' => Shipment::where('status' , 'rejected')->count(),
     'totalCustomers' => User::where('role' , 'customer')->count(),
    ]);
   }
    public function updatePending(Request $request, Shipment $shipment)
    {   
        $shipment->update([
            'status' => ShipmentStatus::APPROVED
        ]);

            return back()->with('success', 'Shipment approved!');

    }


    public function updateApproved(Request $request, Shipment $shipment)
    {  
        $shipment->update([
            'status' => ShipmentStatus::IN_TRANSIT
        ]);

            return back()->with('success', 'Shipment Being Delivered!');

    }


   
}
