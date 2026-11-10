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
use App\Models\KuisSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function dashboard(Request $request)
    {
        $gid = $request->user()->id;
        $kelas = Kelas::where('guru_id', $gid)->with(['siswa' => fn ($q) => $q->where('role', 'siswa'), 'tugas'])->get();
        $kelasIds = $kelas->pluck('id');

        $stats = [
            'peserta' => User::where('role', 'siswa')->whereIn('kelas', $kelas->pluck('nama'))->count(),
            'materi' => Materi::where('status', 'publikasi')->count(),
            'tugasAktif' => Tugas::whereIn('kelas_id', $kelasIds)->where('deadline', '>=', now())->count(),
            'perluDiperiksa' => Submission::whereNull('nilai')->whereHas('tugas.kelas', fn ($q) => $q->where('guru_id', $gid))->count(),
        ];
        $pengumpulan = Submission::with(['tugas', 'user'])
            ->whereHas('tugas.kelas', fn ($q) => $q->where('guru_id', $gid))
            ->latest()->take(10)->get();
        $mendatang = Tugas::with('kelas')->whereIn('kelas_id', $kelasIds)->where('deadline', '>=', now())->orderBy('deadline')->take(2)->get();
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

        Kelas::create([
            'guru_id' => $request->user()->id,
            'nama' => $validated['nama'],
            'tingkat' => $validated['tingkat'],
        ]);

        return back()->with('ok', 'Kelas berhasil dibuat.');
    }
    public function materi(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $unsurId = $request->query('unsur_id');
        $q = Materi::with(['unsur','kelas'])->latest();
        if ($kelasId) $q->where('kelas_id', $kelasId);
        if ($unsurId) $q->where('unsur_id', $unsurId);
        $materi = $q->get();
        $unsur = UnsurBudaya::orderBy('urutan')->get();
        $kelas = Kelas::where('guru_id', $request->user()->id)->orderBy('tingkat')->orderBy('nama')->get();

        return view('guru-materi', compact('materi', 'unsur', 'kelas', 'kelasId', 'unsurId'));
    }

    public function buatMateri(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'unsur_id' => ['required', 'exists:unsur_budaya,id'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
            'rangkuman' => ['nullable', 'string'],
            'submateri_count' => ['nullable', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'in:draft,publikasi'],
        ]);

        Materi::create([
            'judul' => $validated['judul'],
            'slug' => 'materi-' . Str::slug($validated['judul']) . '-' . Str::random(4),
            'unsur_id' => $validated['unsur_id'],
            'kelas_id' => $validated['kelas_id'] ?? null,
            'rangkuman' => $validated['rangkuman'] ?? null,
            'submateri_count' => $validated['submateri_count'] ?? 0,
            'isi' => $validated['rangkuman'] ?? '-',
            'status' => $validated['status'],
        ]);

        return back()->with('ok', 'Materi dibuat.');
    }

    public function updateMateri(Request $request, Materi $materi)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'unsur_id' => ['required', 'exists:unsur_budaya,id'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
            'rangkuman' => ['nullable', 'string'],
            'submateri_count' => ['nullable', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'in:draft,publikasi'],
        ]);

        $materi->update([
            'judul' => $validated['judul'],
            'unsur_id' => $validated['unsur_id'],
            'kelas_id' => $validated['kelas_id'] ?? null,
            'rangkuman' => $validated['rangkuman'] ?? null,
            'submateri_count' => $validated['submateri_count'] ?? 0,
            'isi' => $validated['rangkuman'] ?? $materi->isi,
            'status' => $validated['status'],
        ]);

        return back()->with('ok', 'Materi diperbarui.');
    }

    public function hapusMateri(Materi $materi)
    {
        $materi->delete();

        return back()->with('ok', 'Materi dihapus.');
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
            'deskripsi' => ['nullable', 'string'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'deadline' => ['nullable', 'date'],
        ]);

        Tugas::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'kelas_id' => $validated['kelas_id'],
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return back()->with('ok', 'Tugas dibuat.');
    }

    public function updateTugas(Request $request, Tugas $tugas)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'deadline' => ['nullable', 'date'],
        ]);

        $tugas->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'kelas_id' => $validated['kelas_id'],
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return back()->with('ok', 'Tugas diperbarui.');
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

    public function kelolaKuis(Kuis $kuis)
    {
        $kuis->load(['soal' => fn ($q) => $q->orderBy('urutan')]);

        return view('guru-kuis-kelola', ['kuis' => $kuis]);
    }

    public function simpanSoal(Request $request, Kuis $kuis)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'pilihan' => ['required', 'array', 'size:4'],
            'pilihan.*' => ['required', 'string'],
            'jawaban' => ['required', 'integer', 'between:0,3'],
            'penjelasan' => ['nullable', 'string'],
        ]);

        $kuis->soal()->create([
            'pertanyaan' => $request->pertanyaan,
            'pilihan' => json_encode($request->pilihan),
            'jawaban' => $request->jawaban,
            'penjelasan' => $request->penjelasan,
            'urutan' => $kuis->soal()->max('urutan') + 1,
        ]);

        return back()->with('ok', 'Soal ditambahkan.');
    }

    public function hapusKuis(Kuis $kuis)
    {
        $kuis->delete();

        return redirect()->route('guru.kuis')->with('ok', 'Kuis dihapus.');
    }

    public function hapusSoal(KuisSoal $soal)
    {
        $soal->delete();

        return back()->with('ok', 'Soal dihapus.');
    }

    public function penilaian()
    {
        $gid = auth()->id();
        $pengumpulan = Submission::with(['tugas', 'user'])
            ->whereHas('tugas.kelas', fn ($q) => $q->where('guru_id', $gid))
            ->latest()->get();
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
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'pertanyaan_pematik' => ['nullable', 'string', 'max:1000'],
        ]);
        \App\Models\Diskusi::create([
            'judul' => $validated['judul'],
            'pertanyaan_pematik' => $validated['pertanyaan_pematik'] ?? null,
            'user_id' => $request->user()->id,
        ]);

        return back()->with('ok', 'Diskusi dibuat.');
    }

    public function editDiskusi(Request $request, \App\Models\Diskusi $diskusi)
    {
        abort_unless($diskusi->user_id === $request->user()->id, 403);
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'pertanyaan_pematik' => ['nullable', 'string', 'max:1000'],
        ]);
        $diskusi->update([
            'judul' => $validated['judul'],
            'pertanyaan_pematik' => $validated['pertanyaan_pematik'] ?? null,
        ]);

        return back()->with('ok', 'Diskusi diperbarui.');
    }

    public function laporan()
    {
        $gid = auth()->id();
        $kelas = Kelas::where('guru_id', $gid)->withCount('siswa')->get();
        $kelasIdSiswa = \App\Models\User::where('role', 'siswa')->whereIn(
            'kelas',
            $kelas->pluck('nama')->all()
        )->get();
        $rataNilai = round(\App\Models\Submission::whereNotNull('nilai')->avg('nilai') ?? 0);
        $progresRata = (int) round(\App\Models\ProgresMateri::avg('persen') ?? 0);
        $totalTugas = \App\Models\Tugas::count();
        $selesaiTugas = \App\Models\Submission::count();
        $ketuntasan = $totalTugas > 0 ? (int) round(min(100, $selesaiTugas / $totalTugas * 100)) : 0;

        return view('guru-laporan', compact('kelas', 'kelasIdSiswa', 'rataNilai', 'progresRata', 'ketuntasan'));
    }

    public function nilai(Request $request, Submission $submission)
    {
        $tugas = $submission->tugas;
        abort_unless($tugas && $tugas->kelas && $tugas->kelas->guru_id === $request->user()->id, 403);

        $request->validate([
            'nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'feedback' => ['nullable', 'string', 'max:500'],
        ]);
        $submission->update(['nilai' => $request->nilai, 'feedback_guru' => $request->feedback, 'dinilai_pada' => now()]);

        return back()->with('ok', 'Nilai & umpan balik tersimpan.');
    }
}
