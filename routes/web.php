<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RuangBelajarController;
use App\Http\Controllers\SiswaController;
use App\Models\Agenda;
use Illuminate\Support\Facades\Route;

$cariForum = function (\Illuminate\Http\Request $r) {
    return $r->user()->role === 'guru'
        ? app(GuruController::class)->forum($r)
        : app(SiswaController::class)->forum($r);
};

Route::view('/', 'home')->name('home');
Route::view('/selasar-budaya', 'selasar')->name('selasar');
Route::redirect('/galeri-karya', '/#galeri')->name('galeri');
Route::get('/jelajah-budaya-360', function () {
    $agendaPerBulan = Agenda::orderBy('bulan')->orderBy('urutan')->get()->groupBy('bulan');

    return view('jelajah', compact('agendaPerBulan'));
})->name('jelajah360');

Route::get('/ruang-belajar', [RuangBelajarController::class, 'index'])->name('belajar');

Route::post('/chat', [ChatController::class, 'kirim'])->middleware('auth')->name('chat.kirim');

/* ---- Ruangan murid (role siswa) ---- */
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/ruang-belajar/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/ruang-belajar/kelas-saya', [SiswaController::class, 'kelasSaya'])->name('kelas-saya');
    Route::post('/ruang-belajar/materi/{slug}/selesai', [SiswaController::class, 'selesaikanMateri'])->name('materi.selesai');
    Route::get('/ruang-belajar/tugas-kuis', [SiswaController::class, 'tugasKuis'])->name('tugas-kuis');
    Route::post('/ruang-belajar/tugas/{tugas}/upload', [SiswaController::class, 'uploadSubmission'])->name('tugas.upload');
    Route::get('/ruang-belajar/progres', [SiswaController::class, 'progres'])->name('progres');
    Route::get('/ruang-belajar/pencapaian', [SiswaController::class, 'pencapaian'])->name('pencapaian');
});

/* ---- Forum & profil bersama (murid & guru) ---- */
Route::middleware('auth')->group(function () use ($cariForum) {
    Route::get('/ruang-belajar/forum', $cariForum)->name('forum');
    Route::post('/ruang-belajar/forum', [SiswaController::class, 'buatDiskusi'])->name('forum.buat');
    Route::post('/ruang-belajar/forum/{diskusi}/tanggapan', [SiswaController::class, 'tanggapi'])->name('forum.tanggap');
    Route::post('/ruang-belajar/forum/{diskusi}/edit', [GuruController::class, 'editDiskusi'])->name('forum.edit');
    Route::get('/ruang-belajar/profil', [SiswaController::class, 'profil'])->name('profil');
    Route::post('/ruang-belajar/profil', [SiswaController::class, 'updateProfil'])->name('profil.update');
});

/* ---- Ruangan guru (role guru) ---- */
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/ruang-belajar/guru', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/ruang-belajar/guru/kelas-saya', [GuruController::class, 'kelasSaya'])->name('guru.kelas');
    Route::post('/ruang-belajar/guru/kelas-saya', [GuruController::class, 'tambahKelas'])->name('guru.kelas.store');
    Route::get('/ruang-belajar/guru/materi', [GuruController::class, 'materi'])->name('guru.materi');
    Route::post('/ruang-belajar/guru/materi', [GuruController::class, 'buatMateri'])->name('guru.materi.store');
    Route::get('/ruang-belajar/guru/tugas', [GuruController::class, 'tugas'])->name('guru.tugas');
    Route::post('/ruang-belajar/guru/tugas', [GuruController::class, 'buatTugas'])->name('guru.tugas.store');
    Route::get('/ruang-belajar/guru/kuis', [GuruController::class, 'kuis'])->name('guru.kuis');
    Route::post('/ruang-belajar/guru/kuis', [GuruController::class, 'buatKuis'])->name('guru.kuis.store');
    Route::get('/ruang-belajar/guru/penilaian', [GuruController::class, 'penilaian'])->name('guru.penilaian');
    Route::post('/ruang-belajar/guru/penilaian/{submission}', [GuruController::class, 'nilai'])->name('guru.penilaian.nilai');
    Route::get('/ruang-belajar/guru/forum', [GuruController::class, 'forum'])->name('guru.forum');
    Route::get('/ruang-belajar/guru/laporan', [GuruController::class, 'laporan'])->name('guru.laporan');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
