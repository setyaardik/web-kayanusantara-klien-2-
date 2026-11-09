<?php

namespace App\Services;

use App\Models\UnsurBudaya;
use Illuminate\Support\Facades\Http;

class GeminiChatService
{
    public function jawab(string $pesan): array
    {
        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-flash-latest');

        if (! $apiKey) {
            return ['ok' => false, 'pesan' => 'AI belum dikonfigurasi. Administrator perlu mengisi kunci API di .env (GEMINI_API_KEY).'];
        }

        $konteks = UnsurBudaya::orderBy('urutan')
            ->get(['nama', 'ringkasan', 'deskripsi'])
            ->map(fn ($u) => "- {$u->nama}: {$u->ringkasan} " . ($u->deskripsi ?? ''))
            ->implode("\n");

        $system = "Kamu adalah asisten belajar Kaya Nusantara, platform edukasi budaya Indonesia. "
            . "Jawab pertanyaan murid tentang budaya Indonesia dalam Bahasa Indonesia yang ramah, ringkas, dan jelas. "
            . "Prioritaskan materi berikut sebagai referensi utama:\n{$konteks}\n"
            . "Jika pertanyaan di luar materi web ini, jawablah dari pengetahuan umum tentang budaya Indonesia dan tandai bahwa itu bukan materi resmi (cek ke guru/website). "
            . "Jangan menjawab soal kuis/tugas secara langsung; bantu jelaskan konsepnya. "
            . "Jangan lebih dari 5 kalimat per jawaban.";

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . urlencode($apiKey);

        try {
            $cacert = storage_path('certs/cacert.pem');
            $res = Http::withOptions(['verify' => is_file($cacert) ? $cacert : true])
                ->timeout(45)->post($url, [
                'systemInstruction' => ['parts' => [['text' => $system]]],
                'contents' => [['role' => 'user', 'parts' => [['text' => $pesan]]]],
                'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 600],
            ]);

            if ($res->status() === 429) {
                return ['ok' => false, 'pesan' => 'AI sedang sibuk (kuota harian habis) — coba lagi sebentar lagi ya.'];
            }

            if (! $res->successful()) {
                return ['ok' => false, 'pesan' => 'AI sedang tidak dapat dijangkau. Coba lagi nanti ya.'];
            }

            $teks = $res->json('candidates.0.content.parts.0.text');
            if (! $teks) {
                return ['ok' => false, 'pesan' => 'Maaf, aku belum bisa menjawab itu. Coba tanya dengan kata lain ya.'];
            }

            return ['ok' => true, 'pesan' => trim($teks)];
        } catch (\Throwable $e) {
            return ['ok' => false, 'pesan' => 'Koneksi ke AI terputus. Coba lagi nanti ya.'];
        }
    }
}
