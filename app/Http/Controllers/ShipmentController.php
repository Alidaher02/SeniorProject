<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ShipmentRequested;
use Illuminate\Support\Str;


class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shipment $shipment , Request $request)
    {
        $shipments = Auth::user()
        ->shipments()
        ->when($request->status, function ($query , $status){
              $query->where('status' , $status);
        })
        ->latest()
        ->get();

        return view('shipments.shipments' , [
          'shipments' => $shipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipments.requestShipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
    'product_name' => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string', 'max:1000'],
    'origin' => ['required', 'string', 'max:255'],
    'destination' => ['required', 'string', 'max:255', 'different:origin'],
    'min_temperature' => ['required', 'numeric', 'between:-100,100'],
    'max_temperature' => ['required', 'numeric', 'between:-100,100', 'gte:min_temperature'],
    'departure_date' => ['required', 'date', 'after_or_equal:today'],
    'expected_arrival' => ['required', 'date', 'after:departure_date'],
    ]);

       $shipment = Auth::user()->shipments()->create([
            
        'product_name' => request('product_name'),
        'description' => request('description'),
        'origin' => request('origin'),
        'destination' => request('destination'),
        'min_temperature' => request('min_temperature'),
        'max_temperature' => request('max_temperature'),
        'departure_date' => request('departure_date'),
        'expected_arrival' => request('expected_arrival'),
        'tracking-number' => 'SHIP-' . rand(100000, 999999),
        

       ]);

       Auth::user()->notify(new ShipmentRequested($shipment));

       return redirect('/shipments')->with('success' , 'Shipment is Created');



    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.show', [
            'shipment' => $shipment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect('/');
    }
}
