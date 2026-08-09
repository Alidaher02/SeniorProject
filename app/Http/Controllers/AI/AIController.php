<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\GroqService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShipmentReportMail;

class AIController extends Controller
{
    public function index()
    {
        return view('shipments.ai-assistant');
    }

    public function chat(Request $request, GroqService $groq)
    {
        $message = $request->message;
        $aiResponse = $groq->ask($message);

        $chatHistory = Auth::user()->messages()->create([
            'message' => $message,
            'ai_response' => $aiResponse,
        ]);


        return response()->json([
            'aiResponse' => $aiResponse
        ]); 
    }

    public function history()
    {
        
        return response()->json([
            'chat' => Auth::user()
                        ->messages()
                        ->latest()
                        ->take(10)
                        ->get()
                        ->reverse()
                        ->values()

            
        ]);
    }
}
