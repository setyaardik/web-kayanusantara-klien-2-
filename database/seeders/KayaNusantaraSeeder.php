<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class KayaNusantaraSeeder extends Seeder
{
    public function run(): void
    {
        $unsur = [
            ['slug' => 'bahasa', 'nama' => 'Bahasa', 'ringkasan' => 'Alat komunikasi, identitas, dan pewarisan pengetahuan.', 'deskripsi' => 'Mengenal bahasa daerah dan keragaman komunikasi masyarakat. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 1],
            ['slug' => 'sistem-pengetahuan', 'nama' => 'Sistem Pengetahuan', 'ringkasan' => 'Pengetahuan masyarakat tentang alam dan kehidupan.', 'deskripsi' => 'Memahami rumah adat, pengetahuan lokal, dan kearifan masyarakat. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 2],
            ['slug' => 'organisasi-sosial', 'nama' => 'Organisasi Sosial', 'ringkasan' => 'Hubungan kekerabatan dan tata kehidupan masyarakat.', 'deskripsi' => 'Mempelajari hubungan sosial, keluarga, dan kehidupan bermasyarakat. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 3],
            ['slug' => 'peralatan-hidup-dan-teknologi', 'nama' => 'Peralatan Hidup dan Teknologi', 'ringkasan' => 'Alat, rumah, pakaian, dan teknologi tradisional.', 'deskripsi' => 'Mengenal alat tradisional dan perkembangan teknologi lokal. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 4],
            ['slug' => 'mata-pencaharian', 'nama' => 'Mata Pencaharian', 'ringkasan' => 'Cara masyarakat memenuhi kebutuhan hidup.', 'deskripsi' => 'Memahami kegiatan ekonomi dan cara masyarakat memenuhi kebutuhan. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 5],
            ['slug' => 'sistem-religi', 'nama' => 'Sistem Religi', 'ringkasan' => 'Kepercayaan, nilai spiritual, dan tradisi masyarakat.', 'deskripsi' => 'Mengenal kepercayaan, upacara, dan tradisi spiritual masyarakat. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 6],
            ['slug' => 'kesenian', 'nama' => 'Kesenian', 'ringkasan' => 'Ekspresi keindahan melalui seni dan pertunjukan.', 'deskripsi' => 'Menjelajahi tari, musik, rupa, sastra, dan ekspresi budaya. Materi ini memuat pengantar, contoh budaya dari berbagai daerah, aktivitas refleksi, dan evaluasi pemahaman.', 'urutan' => 7],
        ];

        foreach ($unsur as $u) {
            DB::table('unsur_budaya')->updateOrInsert(['slug' => $u['slug']], $u + ['created_at' => now(), 'updated_at' => now()]);
            $unsurId = DB::table('unsur_budaya')->where('slug', $u['slug'])->value('id');
            DB::table('materi')->updateOrInsert(
                ['slug' => 'materi-' . $u['slug']],
                ['unsur_id' => $unsurId, 'judul' => 'Materi ' . $u['nama'], 'ringkasan' => $u['ringkasan'], 'isi' => $u['deskripsi'], 'status' => 'publikasi', 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // contoh tugas dari slide
        $guru = User::firstOrCreate(['email' => 'guru@kaya.test'], ['name' => 'Pak Handika', 'password' => Hash::make('password123'), 'role' => 'guru', 'sekolah' => 'SMA Karangturi']);
        $kelas = DB::table('kelas')->where('kode', 'XIA1')->value('id');
        if (! $kelas) {
            $kelas = DB::table('kelas')->insertGetId(['guru_id' => $guru->id, 'nama' => 'X - A', 'tingkat' => 'X', 'kode' => 'XIA1', 'created_at' => now(), 'updated_at' => now()]);
        }

        $tugasList = [
            ['judul' => 'Analisis Filosofi Rumah Adat', 'deskripsi' => 'Analisis filosofi bentuk dan makna rumah adat di daerahmu.', 'deadline' => now()->addDays(4)],
            ['judul' => 'Video Dokumentasi Tradisi Lokal', 'deskripsi' => 'Buat video dokumentasi tradisi di lingkunganmu.', 'deadline' => now()->addDays(11)],
            ['judul' => 'Refleksi Kesenian Daerah', 'deskripsi' => 'Tuliskan refleksi tentang kesenian daerah favoritmu.', 'deadline' => now()->subDays(5)],
        ];
        foreach ($tugasList as $t) {
            DB::table('tugas')->updateOrInsert(['judul' => $t['judul']], $t + ['kelas_id' => $kelas, 'created_at' => now(), 'updated_at' => now()]);
        }

        // contoh diskusi dari slide
        $mhs = User::firstOrCreate(['email' => 'felice@kaya.test'], ['name' => 'Felice Gracia', 'password' => Hash::make('password123'), 'role' => 'siswa', 'sekolah' => 'SMA Karangturi', 'kelas' => 'X - A']);
        $diskusi = [
            ['judul' => 'Apa filosofi bentuk atap Rumah Gadang?', 'slug' => 'sistem-pengetahuan', 'user' => $mhs->id],
            ['judul' => 'Bagaimana cara generasi muda melestarikan tari tradisional?', 'slug' => 'kesenian', 'user' => $mhs->id],
            ['judul' => 'Mengapa bahasa daerah perlu dilestarikan?', 'slug' => 'bahasa', 'user' => $mhs->id],
        ];
        foreach ($diskusi as $d) {
            $unsurId = DB::table('unsur_budaya')->where('slug', $d['slug'])->value('id');
            if (! DB::table('diskusi')->where('judul', $d['judul'])->exists()) {
                DB::table('diskusi')->insert(['user_id' => $d['user'], 'unsur_id' => $unsurId, 'judul' => $d['judul'], 'created_at' => now(), 'updated_at' => now()]);
            }
        }

        // kuis contoh (soal sama seperti Uji Pengetahuanmu di Selasar Budaya)
        $kuisId = DB::table('kuis')->where('judul', 'Kuis Tujuh Unsur Kebudayaan')->value('id');
        if (! $kuisId) {
            $kuisId = DB::table('kuis')->insertGetId([
                'judul' => 'Kuis Tujuh Unsur Kebudayaan',
                'deskripsi' => 'Pilihan ganda',
                'jenis' => 'Pilihan Ganda',
                'aktif' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
            $soal = [
                ['Apa fungsi utama bahasa dalam kehidupan masyarakat?', ['Sebagai alat komunikasi dan pewaris pengetahuan', 'Hanya sebagai hiburan', 'Sebagai alat pertanian', 'Sebagai bangunan tradisional'], 0, 'Bahasa memungkinkan manusia berkomunikasi, menyampaikan gagasan, dan mewariskan pengetahuan serta nilai budaya.'],
                ['Gotong royong termasuk contoh unsur kebudayaan apa?', ['Kesenian', 'Organisasi sosial', 'Sistem religi', 'Peralatan hidup'], 1, 'Gotong royong merupakan bentuk kerja sama dan hubungan sosial dalam kehidupan masyarakat.'],
                ['Rumah adat dan perahu tradisional termasuk unsur...', ['Bahasa', 'Sistem pengetahuan', 'Peralatan hidup dan teknologi', 'Sistem religi'], 2, 'Rumah dan perahu merupakan hasil ciptaan manusia untuk memenuhi kebutuhan hidup.'],
                ['Pengetahuan mengenai musim tanam termasuk...', ['Sistem pengetahuan', 'Organisasi sosial', 'Kesenian', 'Bahasa'], 0, 'Pengetahuan tentang musim tanam merupakan pengetahuan lokal dalam memahami alam dan lingkungan.'],
                ['Tari tradisional, wayang, dan musik daerah termasuk unsur...', ['Mata pencaharian', 'Sistem religi', 'Organisasi sosial', 'Kesenian'], 3, 'Tari, wayang, dan musik merupakan bentuk ekspresi seni masyarakat.'],
            ];
            foreach ($soal as $i => [$q, $pilihan, $jawaban, $penjelasan]) {
                DB::table('kuis_soal')->insert([
                    'kuis_id' => $kuisId, 'pertanyaan' => $q, 'pilihan' => json_encode($pilihan),
                    'jawaban' => $jawaban, 'penjelasan' => $penjelasan, 'urutan' => $i + 1,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }
}
