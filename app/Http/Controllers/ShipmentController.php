<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\Notifications\ShipmentRequested;
use Illuminate\Support\Str;


class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Shipment $shipment , Request $request)
    {



        return view('shipments.shipments');
    }

    public function load()
    {
        $shipments = Auth::user()->shipments()->latest()->get();
        
        return response()->json([
            'shipments' => $shipments
        ]);
    }

    public function filterStatus(Request $request)
    {

        $shipments = Auth::user()->shipments()
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->get();


        return response()->json($shipments);


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
    'min_humidity' => ['required', 'numeric', 'between:-100,100'],
    'max_humidity' => ['required', 'numeric', 'between:-100,100'],
    'departure_date' => ['required', 'date', 'after_or_equal:today'],
    'expected_arrival' => ['required', 'date', 'after:departure_date'],
    ]);

    if (Auth::user()->shipments()->where('status', 'pending')->exists()) {
    return back()->with('error', 'You already have a pending shipment request.');
       }

       $shipment = Auth::user()->shipments()->create([
        'customer_id' => Auth::id(),
        'product_name' => request('product_name'),
        'description' => request('description'),
        'origin' => request('origin'),
        'destination' => request('destination'),
        'min_temperature' => request('min_temperature'),
        'max_temperature' => request('max_temperature'),
        'min_humidity' => request('min_humidity'),
        'max_humidity' => request('max_humidity'),
        'departure_date' => request('departure_date'),
        'expected_arrival' => request('expected_arrival'),
        'tracking-number' => 'SHIP-' . rand(100000, 999999),
        

       ]);
        return redirect('/shipments')->with('success' , 'Shipment is Created');

       Auth::user()->notify(new ShipmentRequested($shipment));




    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //Authorize
        Gate::authorize('show' , $shipment);
        
        $sensorReading = $shipment->sensorReadings()->latest()->first();
        return view('shipments.show', [
            'shipment' => $shipment,
            'sensorReading' => $sensorReading
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

            //Authorize
        Gate::authorize('updateOrDelete' , $shipment);


     $request->validate([
            
    'product_name' => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string', 'max:1000'],
    'origin' => ['required', 'string', 'max:255'],
    'destination' => ['required', 'string', 'max:255', 'different:origin'],
    'min_temperature' => ['required', 'numeric', 'between:-100,100'],
    'max_temperature' => ['required', 'numeric', 'between:-100,100', 'gte:min_temperature'],
    'min_humidity' => ['required', 'numeric', 'between:-100,100'],
    'max_humidity' => ['required', 'numeric', 'between:-100,100'],
    'departure_date' => ['required', 'date', 'after_or_equal:today'],
    'expected_arrival' => ['required', 'date', 'after:departure_date'],
    ]);

       $shipment->update([

       'product_name' => request('product_name'),
        'description' => request('description'),
        'origin' => request('origin'),
        'destination' => request('destination'),
        'min_temperature' => request('min_temperature'),
        'max_temperature' => request('max_temperature'),
        'min_humidity' => request('min_humidity'),
        'max_humidity' => request('max_humidity'),
        'departure_date' => request('departure_date'),
        'expected_arrival' => request('expected_arrival'),
        'status' => 'pending',        

       ]);



       return redirect('/shipments')->with('success' , 'Shipment is Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //Authorize
        Gate::authorize('updateOrDelete' , $shipment);

        $shipment->delete();

        return redirect('/');
    }


}
