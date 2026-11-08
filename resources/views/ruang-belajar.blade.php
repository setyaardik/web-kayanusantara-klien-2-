@extends('layouts.main')

@section('title', 'Ruang Belajar — Kaya Nusantara')

@section('content')
<section class="dashboard-section">
  <div class="container">
    <div class="ruang-hero reveal">
      <p class="dashboard-eyebrow">Ruang Belajar &bull; Murid</p>
      <h1>Halo, {{ auth()->user()->name }}</h1>
      <p class="dashboard-sub">Lanjutkan belajarmu tentang 7 unsur kebudayaan dan budaya Nusantara.</p>
    </div>

    <div class="dashboard-grid">
      <a class="dashboard-card" href="{{ route('selasar') }}#unsur">
        <h3>Pelajari 7 Unsur</h3>
        <p>Materi budaya: Bahasa, Kesenian, Mata Pencaharian, Organisasi Sosial, Peralatan Hidup, Sistem Pengetahuan, dan Sistem Religi.</p>
        <span>Buka materi &rarr;</span>
      </a>
      <a class="dashboard-card" href="{{ route('selasar') }}#kuis">
        <h3>Uji Pengetahuanmu</h3>
        <p>Kerjakan kuis interaktif 5 soal tentang 7 unsur kebudayaan dan lihat penjelasannya.</p>
        <span>Mulai kuis &rarr;</span>
      </a>
      <a class="dashboard-card" href="{{ route('jelajah360') }}">
        <h3>Jelajah Budaya 360&deg;</h3>
        <p>Tur virtual Museum Sonobudoyo dan destinasi budaya lain dari penjuru Nusantara.</p>
        <span>Mulai jelajah &rarr;</span>
      </a>
      <a class="dashboard-card" href="{{ route('selasar') }}#agenda">
        <h3>Agenda Budaya</h3>
        <p>Lihat kalender festival dan tradisi daerah bulan ini dan mendatang.</p>
        <span>Lihat agenda &rarr;</span>
      </a>
    </div>
  </div>
</section>
@endsection
