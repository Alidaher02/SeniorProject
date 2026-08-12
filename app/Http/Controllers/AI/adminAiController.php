<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class adminAiController extends Controller
{
    public function index()
    {
        return view('admin.ai-assistant');
    }

    public function analayze(GeminiService  $geminiService)
    {
        return response()->json([

            'ai_response' => $geminiService->analyzeShipments(),
            'analyzed_at' => now()->toISOString(),
        ]);
    }
}