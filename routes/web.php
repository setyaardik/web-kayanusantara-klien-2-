<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/selasar-budaya', 'selasar')->name('selasar');
Route::view('/galeri-karya', 'page-stub', ['judul' => 'Galeri Karya'])->name('galeri');
Route::view('/jelajah-budaya-360', 'page-stub', ['judul' => 'Jelajah Budaya 360°'])->name('jelajah360');
Route::view('/ruang-belajar', 'page-stub', ['judul' => 'Ruang Belajar'])->name('belajar');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
