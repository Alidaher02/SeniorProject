<?php

namespace App\Services;

use Gemini;
use Gemini\Client;

class GeminiService
{
    public function ask($message)
    {
        try {

            $client = Gemini::client(env('GEMINI_API_KEY'));

            $response = $client
                ->generativeModel('gemini-2.0-flash')
                ->generateContent($message);

            return $response->text();

        } catch (\Exception $e) {

            return "Error: " . $e->getMessage();

        }
    }
}