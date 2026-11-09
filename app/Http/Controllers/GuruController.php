<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\UnsurBudaya;
use App\Models\ProgresMateri;
use App\Models\User;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function dashboard(Request $request)
    {
        $gid = $request->user()->id;
        $kelas = Kelas::where('guru_id', $gid)->with(['siswa' => fn ($q) => $q->where('role', 'siswa'), 'tugas'])->get();
        $stats = [
            'peserta' => User::where('role', 'siswa')->count(),
            'materi' => Materi::where('status', 'publikasi')->count(),
            'tugasAktif' => Tugas::where('deadline', '>=', now())->count(),
            'perluDiperiksa' => Submission::whereNull('nilai')->count(),
        ];
        $pengumpulan = Submission::with(['tugas', 'user'])->latest()->take(10)->get();
        $mendatang = Tugas::where('deadline', '>=', now())->orderBy('deadline')->take(2)->get();
        $aktivitasSiswa = (int) round(ProgresMateri::avg('persen') ?? 0);

        return view('guru', compact('kelas', 'stats', 'pengumpulan', 'mendatang', 'aktivitasSiswa'));
    }

    public function kelasSaya(Request $request)
    {
        $kelas = Kelas::where('guru_id', $request->user()->id)->withCount('siswa')->get();

        return view('guru-kelas', ['kelas' => $kelas]);
    }

    public function tambahKelas(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:10'],
            'tingkat' => ['required', 'in:X,XI,XII'],
        ]);

        do {
            $kode = strtoupper(Str::random(6));
        } while (Kelas::where('kode', $kode)->exists());

        Kelas::create([
            'guru_id' => $request->user()->id,
            'nama' => $validated['nama'],
            'tingkat' => $validated['tingkat'],
            'kode' => $kode,
        ]);

        return back()->with('ok', 'Kelas dibuat. Kode kelas: ' . $kode);
    }

    public function materi()
    {
        $materi = Materi::with('unsur')->latest()->get();
        $unsur = UnsurBudaya::orderBy('urutan')->get();

        return view('guru-materi', ['materi' => $materi, 'unsur' => $unsur]);
    }

    public function buatMateri(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'unsur_id' => ['required', 'exists:unsur_budaya,id'],
            'status' => ['required', 'in:draft,publikasi'],
        ]);

        Materi::create([
            'judul' => $validated['judul'],
            'slug' => 'materi-' . Str::slug($validated['judul']),
            'unsur_id' => $validated['unsur_id'],
            'isi' => '-',
            'status' => $validated['status'],
        ]);

        return back()->with('ok', 'Materi dibuat.');
    }

    public function tugas()
    {
        $tugas = Tugas::with('kelas')->latest()->get();
        $kelas = Kelas::where('guru_id', auth()->id())->get();

        return view('guru-tugas', ['tugas' => $tugas, 'kelas' => $kelas]);
    }

    public function buatTugas(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'deadline' => ['nullable', 'date'],
        ]);

        Tugas::create([
            'judul' => $validated['judul'],
            'kelas_id' => $validated['kelas_id'],
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return back()->with('ok', 'Tugas dibuat.');
    }

    public function kuis()
    {
        $kuis = Kuis::with('kelas')->latest()->get();
        $kelas = Kelas::where('guru_id', auth()->id())->get();

        return view('guru-kuis', ['kuis' => $kuis, 'kelas' => $kelas]);
    }

    public function buatKuis(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'jenis' => ['required', 'in:Pilihan Ganda,Esai Analitis,Studi Kasus,Proyek,Presentasi'],
            'tenggat' => ['nullable', 'date'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
        ]);

        Kuis::create($validated + ['aktif' => 1]);

        return back()->with('ok', 'Kuis dibuat.');
    }

    public function penilaian()
    {
        $pengumpulan = Submission::with(['tugas', 'user'])->latest()->get();
        $kelasList = Kelas::all();
        $unsurList = UnsurBudaya::orderBy('urutan')->get();

        return view('guru-penilaian', ['pengumpulan' => $pengumpulan, 'kelasList' => $kelasList, 'unsurList' => $unsurList]);
    }

    public function forum()
    {
        $diskusi = \App\Models\Diskusi::with(['user', 'unsur', 'tanggapan.user'])->latest()->get();

        return view('forum', ['diskusi' => $diskusi]);
    }

    public function buatDiskusi(Request $request)
    {
        $request->validate(['judul' => ['required', 'string', 'max:255']]);
        \App\Models\Diskusi::create(['judul' => $request->judul, 'user_id' => $request->user()->id]);

        return back()->with('ok', 'Diskusi dibuat.');
    }

    public function editDiskusi(Request $request, \App\Models\Diskusi $diskusi)
    {
        abort_unless($diskusi->user_id === $request->user()->id, 403);
        $request->validate(['judul' => ['required', 'string', 'max:255']]);
        $diskusi->update(['judul' => $request->judul]);

        return back()->with('ok', 'Diskusi diperbarui.');
    }

    public function laporan()
    {
        $gid = auth()->id();
        $kelas = Kelas::where('guru_id', $gid)->withCount('siswa')->get();
        $rataNilai = round(\App\Models\Submission::whereNotNull('nilai')->avg('nilai') ?? 0);
        $progresRata = (int) round(\App\Models\ProgresMateri::avg('persen') ?? 0);
        $totalTugas = \App\Models\Tugas::count();
        $selesaiTugas = \App\Models\Submission::count();
        $ketuntasan = $totalTugas > 0 ? (int) round(min(100, $selesaiTugas / $totalTugas * 100)) : 0;

        return view('guru-laporan', compact('kelas', 'rataNilai', 'progresRata', 'ketuntasan'));
    }

    public function nilai(Submission $submission)
    {
        $request = request();
        $request->validate(['nilai' => ['required', 'integer', 'min:0', 'max:100']]);
        $submission->update(['nilai' => $request->nilai, 'dinilai_pada' => now()]);

        return back()->with('ok', 'Nilai tersimpan.');
    }
}
