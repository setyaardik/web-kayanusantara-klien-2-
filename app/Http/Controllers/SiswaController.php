<?php

namespace App\Http\Controllers;

use App\Models\UnsurBudaya;
use App\Models\ProgresMateri;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\Diskusi;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    private array $bulanNama = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];

    private function unsurDenganProgres(Request $request)
    {
        $progres = ProgresMateri::where('user_id', $request->user()->id)->pluck('persen', 'unsur_id');

        return UnsurBudaya::orderBy('urutan')->get()->map(function ($u) use ($progres) {
            $u->persen = (int) ($progres[$u->id] ?? 0);
            $u->status = $u->persen >= 100 ? 'selesai' : ($u->persen > 0 ? 'sedang' : 'belum');

            return $u;
        });
    }

    private function statistik(Request $request)
    {
        $list = $this->unsurDenganProgres($request);
        $selesai = $list->where('persen', 100)->count();
        $totalPersen = $list->sum('persen');

        return [
            'list' => $list,
            'materiTersedia' => $list->count(),
            'materiSelesai' => $selesai,
            'progres' => (int) round($totalPersen / max(1, $list->count())),
            'poin' => (int) $totalPersen,
        ];
    }

    public function dashboard(Request $request)
    {
        $st = $this->statistik($request);
        $lanjut = $st['list']->first(fn ($u) => $u->persen > 0 && $u->persen < 100) ?? $st['list']->first();
        $tugasAktif = Tugas::where('deadline', '>=', now())->orderBy('deadline')->limit(2)->get();
        $target = $st['list']->take(5);
        $targetSelesai = $target->where('persen', 100)->count();

        return view('ruang-belajar', compact('st', 'lanjut', 'tugasAktif', 'targetSelesai'))
            ->with('tanpaSidebar', false);
    }

    public function kelasSaya(Request $request)
    {
        $st = $this->statistik($request);
        $q = mb_strtolower(trim((string) $request->query('q', '')));
        $list = $st['list']->filter(fn ($u) => $q === '' || str_contains(mb_strtolower($u->nama), $q));

        $user = $request->user();
        $kelasMurid = \App\Models\Kelas::where('nama', $user->kelas)->first();
        $materi = \App\Models\Materi::with(['unsur','kelas'])
            ->where('status', 'publikasi')
            ->where(function ($qr) use ($kelasMurid) {
                $qr->whereNull('kelas_id');
                if ($kelasMurid) $qr->orWhere('kelas_id', $kelasMurid->id);
            })
            ->latest()->get()->groupBy('unsur_id');

        return view('kelas-saya', ['list' => $list, 'q' => $q, 'materi' => $materi])->with('tanpaSidebar', false);
    }

    public function selesaikanMateri(Request $request, $slug)
    {
        $unsur = UnsurBudaya::where('slug', $slug)->firstOrFail();
        ProgresMateri::updateOrCreate(
            ['user_id' => $request->user()->id, 'unsur_id' => $unsur->id],
            ['persen' => 100, 'selesai_pada' => now()]
        );

        return redirect()->route('kelas-saya')->with('ok', 'Materi "' . $unsur->nama . '" selesai dipelajari.');
    }

    public function tugasKuis(Request $request)
    {
        $tugas = Tugas::with(['submissions' => fn ($q) => $q->where('user_id', $request->user()->id)])
            ->orderBy('deadline')
            ->get();
        $kuis = \App\Models\Kuis::where('aktif', 1)->withCount('soal')->latest()->get();
        $hasil = \App\Models\KuisHasil::where('user_id', $request->user()->id)->latest()->get()->keyBy('kuis_id');

        return view('tugas-kuis', ['tugas' => $tugas, 'kuis' => $kuis, 'hasil' => $hasil])->with('tanpaSidebar', false);
    }

    public function kuisAmbil(Request $request, \App\Models\Kuis $kuis)
    {
        $kuis->load(['soal' => fn ($q) => $q->orderBy('urutan')]);

        return view('kuis-ambil', ['kuis' => $kuis])->with('tanpaSidebar', false);
    }

    public function kuisKirim(Request $request, \App\Models\Kuis $kuis)
    {
        $kuis->load(['soal' => fn ($q) => $q->orderBy('urutan')]);
        $benar = 0;
        foreach ($kuis->soal as $soal) {
            $jawab = (int) $request->input('soal_' . $soal->id, -1);
            if ($jawab === (int) $soal->jawaban) $benar++;
        }
        $total = max(1, $kuis->soal->count());
        $skor = (int) round($benar / $total * 100);

        \App\Models\KuisHasil::updateOrCreate(
            ['user_id' => $request->user()->id, 'kuis_id' => $kuis->id],
            ['benar' => $benar, 'total' => $total, 'skor' => $skor]
        );

        return redirect()->route('kuis.hasil', $kuis->id)->with('ok', 'Kuis selesai. Skor: ' . $skor);
    }

    public function kuisHasil(Request $request, \App\Models\Kuis $kuis)
    {
        $kuis->load(['soal' => fn ($q) => $q->orderBy('urutan')]);
        $hasil = \App\Models\KuisHasil::where('user_id', $request->user()->id)->where('kuis_id', $kuis->id)->firstOrFail();

        return view('kuis-hasil', ['kuis' => $kuis, 'hasil' => $hasil])->with('tanpaSidebar', false);
    }

    public function unduh(Request $request, Submission $submission)
    {
        $tugas = $submission->tugas;
        $pemilik = $submission->user_id === $request->user()->id;
        $guru = $tugas && $tugas->kelas && $tugas->kelas->guru_id === $request->user()->id;
        abort_unless($pemilik || $guru, 403);
        abort_unless($submission->file_path && \Illuminate\Support\Facades\Storage::disk('local')->exists($submission->file_path), 404);

        return \Illuminate\Support\Facades\Storage::disk('local')->download(
            $submission->file_path,
            'tugas-' . ($tugas?->judul ?? 'submission')
        );
    }

    public function uploadSubmission(Request $request, Tugas $tugas)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:doc,docx,pdf', 'max:10240'],
        ]);

        $path = $request->file('file')->store('submissions', 'local');
        $sub = Submission::where('tugas_id', $tugas->id)->where('user_id', $request->user()->id)->first();
        if ($sub) {
            Storage::disk('local')->delete($sub->file_path);
            $sub->update(['file_path' => $path, 'dinilai_pada' => null, 'nilai' => null]);
        } else {
            Submission::create(['tugas_id' => $tugas->id, 'user_id' => $request->user()->id, 'file_path' => $path]);
        }

        return back()->with('ok', 'Tugas terkumpul. Menunggu penilaian guru.');
    }

    public function progres(Request $request)
    {
        $st = $this->statistik($request);
        $rataNilai = round(
            Submission::where('user_id', $request->user()->id)->whereNotNull('nilai')->avg('nilai') ?? 0
        );

        return view('progres', ['st' => $st, 'rataNilai' => $rataNilai])->with('tanpaSidebar', false);
    }

    public function forum(Request $request)
    {
        $diskusi = Diskusi::with(['user', 'unsur', 'tanggapan.user'])->latest()->get();

        return view('forum', ['diskusi' => $diskusi])->with('tanpaSidebar', false);
    }

    public function buatDiskusi(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'pertanyaan_pematik' => ['nullable', 'string', 'max:1000'],
        ]);
        Diskusi::create([
            'judul' => $validated['judul'],
            'pertanyaan_pematik' => $validated['pertanyaan_pematik'] ?? null,
            'user_id' => $request->user()->id,
        ]);

        return back()->with('ok', 'Diskusi dibuat.');
    }

    public function tanggapi(Request $request, Diskusi $diskusi)
    {
        $request->validate(['isi' => ['required', 'string', 'max:1000']]);
        Tanggapan::create(['diskusi_id' => $diskusi->id, 'user_id' => $request->user()->id, 'isi' => $request->isi]);

        return back()->with('ok', 'Tanggapan terkirim.');
    }

    public function pencapaian(Request $request)
    {
        $st = $this->statistik($request);
        $rataNilai = Submission::where('user_id', $request->user()->id)->whereNotNull('nilai')->avg('nilai') ?? 0;
        $kesenianSelesai = (bool) $st['list']->firstWhere('slug', 'kesenian')?->persen === 100;
        $tugasSelesai = Submission::where('user_id', $request->user()->id)->exists();
        $lencana = [
            ['nama' => 'Pembaca Tekun', 'syarat' => 'Menyelesaikan 3 materi', 'ok' => $st['materiSelesai'] >= 3],
            ['nama' => 'Penjelajah Budaya', 'syarat' => 'Menjelajah 5 daerah', 'ok' => $st['materiSelesai'] >= 1],
            ['nama' => 'Nilai Gemilang', 'syarat' => 'Nilai kuis di atas 90', 'ok' => $rataNilai > 90],
            ['nama' => 'Apresiatior Seni', 'syarat' => 'Menyelesaikan materi seni', 'ok' => $kesenianSelesai],
            ['nama' => 'Pelestari Budaya', 'syarat' => 'Menyelesaikan proyek', 'ok' => $tugasSelesai],
            ['nama' => 'Cendekiawan Muda', 'syarat' => 'Selesai semua materi', 'ok' => $st['materiSelesai'] >= 7],
        ];
        $tingkat = $st['materiSelesai'] >= 5 ? 2 : ($st['materiSelesai'] >= 1 ? 1 : 0);

        return view('pencapaian', ['st' => $st, 'lencana' => $lencana, 'tingkat' => $tingkat])->with('tanpaSidebar', false);
    }

    public function profil(Request $request)
    {
        return view('profil')->with('tanpaSidebar', false);
    }

    public function updateProfil(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sekolah' => ['required', 'in:SMA Karangturi'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'kelas' => ['required', 'exists:kelas,nama'],
        ]);
        $user->update($request->only('name', 'sekolah', 'email', 'kelas'));

        return back()->with('ok', 'Profil diperbarui.');
    }
}
