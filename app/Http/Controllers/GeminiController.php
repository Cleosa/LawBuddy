<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    protected $apiKey;
    protected $endpoint;
    protected $lawyerPrompt;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent";
        $this->lawyerPrompt = "Anda adalah LawBuddy, seorang asisten hukum profesional dari Indonesia. Anda memiliki pengetahuan mendalam tentang hukum Indonesia dan bertugas untuk memberikan informasi hukum yang akurat dan mudah dipahami. Berikan saran dengan bahasa yang formal namun ramah. Selalu ingatkan bahwa ini adalah informasi umum dan untuk kasus spesifik sebaiknya berkonsultasi dengan pengacara. Berikut pertanyaan dari pengguna: ";
    }

    public function index()
    {
        return view('chatbot')->with([
            'welcomeMessage' => 'Selamat datang di LawBuddy. Saya adalah asisten hukum virtual Anda. Apa yang bisa saya bantu terkait masalah hukum Anda?'
        ]);
    }

    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            $fullPrompt = $this->lawyerPrompt . $userMessage;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->endpoint . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, tidak ada respons yang diterima.';

                return response()->json([
                    'success' => true,
                    'message' => $text
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $response->body()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
