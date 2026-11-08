<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuangBelajarController;
use App\Models\Agenda;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/selasar-budaya', 'selasar')->name('selasar');
Route::view('/galeri-karya', 'page-stub', ['judul' => 'Galeri Karya'])->name('galeri');
Route::get('/jelajah-budaya-360', function () {
    $agendaPerBulan = Agenda::orderBy('bulan')->orderBy('urutan')->get()->groupBy('bulan');

    return view('jelajah', compact('agendaPerBulan'));
})->name('jelajah360');

Route::get('/ruang-belajar', [RuangBelajarController::class, 'index'])->name('belajar');
Route::get('/ruang-belajar/guru', fn () => view('guru'))
    ->middleware(['auth', 'role:guru'])
    ->name('belajar.guru');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
