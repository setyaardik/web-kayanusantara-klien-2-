<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RuangBelajarController;
use App\Http\Controllers\SiswaController;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Faq;
use App\Models\LangkahDokumentasi;
use App\Models\LangkahGaleri;
use App\Models\LangkahPublikasi;
use App\Models\Mitra;
use App\Models\Testimoni;
use App\Models\TokoProduk;
use Illuminate\Support\Facades\Route;

$cariForum = function (\Illuminate\Http\Request $r) {
    return $r->user()->role === 'guru'
        ? app(GuruController::class)->forum($r)
        : app(SiswaController::class)->forum($r);
};

Route::get('/', function () {
    $langkahGaleri = LangkahGaleri::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();
    $langkahPublikasi = LangkahPublikasi::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();
    $langkahDokumentasi = LangkahDokumentasi::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();
    $faqs = Faq::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();
    $testimonis = Testimoni::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();
    $mitras = Mitra::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();

    return view('home', compact('langkahGaleri', 'langkahPublikasi', 'langkahDokumentasi', 'faqs', 'testimonis', 'mitras'));
})->name('home');
Route::get('/selasar-budaya', function () {
    $berita = Berita::where('aktif', true)->orderBy('urutan')->orderByDesc('id')->get();
    $produkToko = TokoProduk::where('aktif', true)->orderBy('urutan')->orderByDesc('id')->get();

    return view('selasar', compact('berita', 'produkToko'));
})->name('selasar');
Route::redirect('/galeri-karya', '/#galeri')->name('galeri');
Route::view('/tim-kaya-nusantara', 'tim')->name('tim');
Route::get('/jelajah-budaya-360', function () {
    $agendaPerBulan = Agenda::orderBy('bulan')->orderBy('urutan')->get()->groupBy('bulan');
    $destinasis = Destinasi::where('aktif', true)->orderBy('urutan')->orderBy('id')->get();

    return view('jelajah', compact('agendaPerBulan', 'destinasis'));
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
    Route::get('/ruang-belajar/kuis/{kuis}', [SiswaController::class, 'kuisAmbil'])->name('kuis.ambil');
    Route::post('/ruang-belajar/kuis/{kuis}/kirim', [SiswaController::class, 'kuisKirim'])->name('kuis.kirim');
    Route::get('/ruang-belajar/kuis/{kuis}/hasil', [SiswaController::class, 'kuisHasil'])->name('kuis.hasil');
    Route::get('/ruang-belajar/progres', [SiswaController::class, 'progres'])->name('progres');
    Route::get('/ruang-belajar/pencapaian', [SiswaController::class, 'pencapaian'])->name('pencapaian');
});

/* ---- Forum & profil bersama (murid & guru) ---- */
Route::middleware('auth')->group(function () use ($cariForum) {
    Route::get('/ruang-belajar/submissions/{submission}/unduh', [SiswaController::class, 'unduh'])->name('tugas.unduh');
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
    Route::put('/ruang-belajar/guru/materi/{materi}', [GuruController::class, 'updateMateri'])->name('guru.materi.update');
    Route::delete('/ruang-belajar/guru/materi/{materi}', [GuruController::class, 'hapusMateri'])->name('guru.materi.hapus');
    Route::get('/ruang-belajar/guru/tugas', [GuruController::class, 'tugas'])->name('guru.tugas');
    Route::post('/ruang-belajar/guru/tugas', [GuruController::class, 'buatTugas'])->name('guru.tugas.store');
    Route::put('/ruang-belajar/guru/tugas/{tugas}', [GuruController::class, 'updateTugas'])->name('guru.tugas.update');
    Route::get('/ruang-belajar/guru/kuis', [GuruController::class, 'kuis'])->name('guru.kuis');
    Route::post('/ruang-belajar/guru/kuis', [GuruController::class, 'buatKuis'])->name('guru.kuis.store');
    Route::get('/ruang-belajar/guru/kuis/{kuis}/kelola', [GuruController::class, 'kelolaKuis'])->name('guru.kuis.kelola');
    Route::post('/ruang-belajar/guru/kuis/{kuis}/soal', [GuruController::class, 'simpanSoal'])->name('guru.kuis.soal.store');
    Route::delete('/ruang-belajar/guru/kuis/{kuis}', [GuruController::class, 'hapusKuis'])->name('guru.kuis.hapus');
    Route::delete('/ruang-belajar/guru/soal/{soal}', [GuruController::class, 'hapusSoal'])->name('guru.soal.hapus');
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

/* ---- Admin Dashboard ---- */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    });

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/faq', [AdminController::class, 'faqIndex'])->name('faq.index');
    Route::get('/faq/create', [AdminController::class, 'faqCreate'])->name('faq.create');
    Route::post('/faq', [AdminController::class, 'faqStore'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [AdminController::class, 'faqEdit'])->name('faq.edit');
    Route::put('/faq/{faq}', [AdminController::class, 'faqUpdate'])->name('faq.update');
    Route::delete('/faq/{faq}', [AdminController::class, 'faqDestroy'])->name('faq.destroy');

    Route::get('/testimoni', [AdminController::class, 'testimoniIndex'])->name('testimoni.index');
    Route::get('/testimoni/create', [AdminController::class, 'testimoniCreate'])->name('testimoni.create');
    Route::post('/testimoni', [AdminController::class, 'testimoniStore'])->name('testimoni.store');
    Route::get('/testimoni/{testimoni}/edit', [AdminController::class, 'testimoniEdit'])->name('testimoni.edit');
    Route::put('/testimoni/{testimoni}', [AdminController::class, 'testimoniUpdate'])->name('testimoni.update');
    Route::delete('/testimoni/{testimoni}', [AdminController::class, 'testimoniDestroy'])->name('testimoni.destroy');

    Route::get('/mitra', [AdminController::class, 'mitraIndex'])->name('mitra.index');
    Route::get('/mitra/create', [AdminController::class, 'mitraCreate'])->name('mitra.create');
    Route::post('/mitra', [AdminController::class, 'mitraStore'])->name('mitra.store');
    Route::get('/mitra/{mitra}/edit', [AdminController::class, 'mitraEdit'])->name('mitra.edit');
    Route::put('/mitra/{mitra}', [AdminController::class, 'mitraUpdate'])->name('mitra.update');
    Route::delete('/mitra/{mitra}', [AdminController::class, 'mitraDestroy'])->name('mitra.destroy');

    Route::get('/langkah-galeri', [AdminController::class, 'langkahGaleriIndex'])->name('langkah-galeri.index');
    Route::get('/langkah-galeri/create', [AdminController::class, 'langkahGaleriCreate'])->name('langkah-galeri.create');
    Route::post('/langkah-galeri', [AdminController::class, 'langkahGaleriStore'])->name('langkah-galeri.store');
    Route::get('/langkah-galeri/{langkahGaleri}/edit', [AdminController::class, 'langkahGaleriEdit'])->name('langkah-galeri.edit');
    Route::put('/langkah-galeri/{langkahGaleri}', [AdminController::class, 'langkahGaleriUpdate'])->name('langkah-galeri.update');
    Route::delete('/langkah-galeri/{langkahGaleri}', [AdminController::class, 'langkahGaleriDestroy'])->name('langkah-galeri.destroy');

    Route::get('/langkah-publikasi', [AdminController::class, 'langkahPublikasiIndex'])->name('langkah-publikasi.index');
    Route::get('/langkah-publikasi/create', [AdminController::class, 'langkahPublikasiCreate'])->name('langkah-publikasi.create');
    Route::post('/langkah-publikasi', [AdminController::class, 'langkahPublikasiStore'])->name('langkah-publikasi.store');
    Route::get('/langkah-publikasi/{langkahPublikasi}/edit', [AdminController::class, 'langkahPublikasiEdit'])->name('langkah-publikasi.edit');
    Route::put('/langkah-publikasi/{langkahPublikasi}', [AdminController::class, 'langkahPublikasiUpdate'])->name('langkah-publikasi.update');
    Route::delete('/langkah-publikasi/{langkahPublikasi}', [AdminController::class, 'langkahPublikasiDestroy'])->name('langkah-publikasi.destroy');

    Route::get('/langkah-dokumentasi', [AdminController::class, 'langkahDokumentasiIndex'])->name('langkah-dokumentasi.index');
    Route::get('/langkah-dokumentasi/create', [AdminController::class, 'langkahDokumentasiCreate'])->name('langkah-dokumentasi.create');
    Route::post('/langkah-dokumentasi', [AdminController::class, 'langkahDokumentasiStore'])->name('langkah-dokumentasi.store');
    Route::get('/langkah-dokumentasi/{langkahDokumentasi}/edit', [AdminController::class, 'langkahDokumentasiEdit'])->name('langkah-dokumentasi.edit');
    Route::put('/langkah-dokumentasi/{langkahDokumentasi}', [AdminController::class, 'langkahDokumentasiUpdate'])->name('langkah-dokumentasi.update');
    Route::delete('/langkah-dokumentasi/{langkahDokumentasi}', [AdminController::class, 'langkahDokumentasiDestroy'])->name('langkah-dokumentasi.destroy');

    Route::get('/berita', [AdminController::class, 'beritaIndex'])->name('berita.index');
    Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'beritaStore'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [AdminController::class, 'beritaEdit'])->name('berita.edit');
    Route::put('/berita/{berita}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
    Route::delete('/berita/{berita}', [AdminController::class, 'beritaDestroy'])->name('berita.destroy');

    Route::get('/toko-produk', [AdminController::class, 'tokoIndex'])->name('toko.index');
    Route::get('/toko-produk/create', [AdminController::class, 'tokoCreate'])->name('toko.create');
    Route::post('/toko-produk', [AdminController::class, 'tokoStore'])->name('toko.store');
    Route::get('/toko-produk/{tokoProduk}/edit', [AdminController::class, 'tokoEdit'])->name('toko.edit');
    Route::put('/toko-produk/{tokoProduk}', [AdminController::class, 'tokoUpdate'])->name('toko.update');
    Route::delete('/toko-produk/{tokoProduk}', [AdminController::class, 'tokoDestroy'])->name('toko.destroy');

    Route::get('/agenda', [AdminController::class, 'agendaIndex'])->name('agenda.index');
    Route::get('/agenda/create', [AdminController::class, 'agendaCreate'])->name('agenda.create');
    Route::post('/agenda', [AdminController::class, 'agendaStore'])->name('agenda.store');
    Route::get('/agenda/{agenda}/edit', [AdminController::class, 'agendaEdit'])->name('agenda.edit');
    Route::put('/agenda/{agenda}', [AdminController::class, 'agendaUpdate'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AdminController::class, 'agendaDestroy'])->name('agenda.destroy');

    Route::get('/destinasi', [AdminController::class, 'destinasiIndex'])->name('destinasi.index');
    Route::get('/destinasi/create', [AdminController::class, 'destinasiCreate'])->name('destinasi.create');
    Route::post('/destinasi', [AdminController::class, 'destinasiStore'])->name('destinasi.store');
    Route::get('/destinasi/{destinasi}/edit', [AdminController::class, 'destinasiEdit'])->name('destinasi.edit');
    Route::put('/destinasi/{destinasi}', [AdminController::class, 'destinasiUpdate'])->name('destinasi.update');
    Route::delete('/destinasi/{destinasi}', [AdminController::class, 'destinasiDestroy'])->name('destinasi.destroy');

    Route::get('/users', [AdminController::class, 'userIndex'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'userCreate'])->name('users.create');
    Route::post('/users', [AdminController::class, 'userStore'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'userEdit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'userUpdate'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'userDestroy'])->name('users.destroy');
});
});
