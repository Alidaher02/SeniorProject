<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ChatController extends Controller
{
  

public function chat(Request $request)
{
    $message = strtoupper($request->input('message', ''));


    // Check if user entered tracking number
    if (str_starts_with($message, 'SHIP-')) {

        $shipment = Shipment::where('tracking-number', $message)->first();

        if ($shipment) {

            $reply = "
            Shipment Found:<br>
            Product: {$shipment->product_name}<br>
            From: {$shipment->origin}<br>
            To: {$shipment->destination}<br>
            Status: {$shipment->status->value}<br>
            Expected Arrival: {$shipment->expected_arrival}
            ";

        } else {

            $reply = "Sorry, I couldn't find a shipment with this tracking number.";

        }


    } elseif (str_contains(strtolower($message), 'track') || str_contains(strtolower($message), 'my')) {

        $reply = "Please enter your tracking number.";

    } elseif (str_contains(strtolower($message), 'temperature') || str_contains(strtolower($message), 'temp')) {

        $reply = "You can check the shipment temperature from the In Transit page.";

    }  elseif (str_contains(strtolower($message), 'gps') || str_contains(strtolower($message), 'location')) {

        $reply = "You can check the shipment live location from the In Transit page.";

    } 
    elseif (str_contains(strtolower($message), 'humidity')) {

        $reply = "You can check humidity readings from the sensor monitoring section.";

    } elseif (str_contains(strtolower($message), 'shipment') || str_contains(strtolower($message), 'request') || str_contains(strtolower($message), 'create')) {

        $reply = "You can create and manage shipments from the Request Shipments page.";

    } elseif (str_contains(strtolower($message), 'hello') || str_contains(strtolower($message), 'hi')) {

        $reply = "Hello! How can I help you with ShipTrack?";

    } 
    else {

        $reply = "I can help you with shipments, tracking, temperature, and humidity.";

    }


    return response()->json([
        'reply' => $reply
    ]);
}
}