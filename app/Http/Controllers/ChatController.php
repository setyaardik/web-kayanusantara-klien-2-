<?php

namespace App\Http\Controllers;

use App\Models\ChatLog;
use App\Services\GeminiChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function kirim(Request $request, GeminiChatService $gemini)
    {
        $request->validate([
            'pesan' => ['required', 'string', 'max:1000'],
        ]);

        $hasil = $gemini->jawab($request->pesan);

        try {
            ChatLog::create([
                'user_id' => $request->user()?->id,
                'pertanyaan' => $request->pesan,
                'jawaban' => $hasil['ok'] ? $hasil['pesan'] : null,
            ]);
        } catch (\Throwable $e) {
            // log bersifat opsional
        }

        return response()->json($hasil);
    }
}
