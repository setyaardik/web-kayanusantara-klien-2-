@extends('layouts.main')

@section('title', 'Ruang Belajar — Kaya Nusantara')

@section('content')
<section class="ruang-gate">
  <div class="ruang-gate-bg" aria-hidden="true">
    <div class="ruang-gate-slide" style="background-image:url('{{ asset('assets/img/hero-jelajah.webp') }}')"></div>
  </div>
  <div class="container">
    <div class="ruang-gate-card reveal">
      <img class="ruang-gate-logo" src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaya Nusantara">
      <p class="ruang-gate-eyebrow">Ruang Belajar</p>
      <h1>Di ruang ini, budaya jadi milikmu.</h1>
      <p class="ruang-gate-sub">Materi 7 unsur kebudayaan, kuis interaktif, dan tur virtual — semua terbuka untuk murid &amp; guru. Masuk dengan akunmu untuk melanjutkan.</p>
      <div class="ruang-gate-actions">
        <a class="btn btn-coklat ruang-gate-btn" href="{{ route('login') }}?redirect={{ urlencode(route('belajar')) }}">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6z"/></svg>
          Masuk untuk Lanjut
        </a>
        <a class="btn btn-cream ruang-gate-btn" href="{{ route('registrasi') }}">Daftar Akun Baru</a>
      </div>
      <div class="ruang-gate-meta">
        <span>7 Unsur Kebudayaan</span><i></i>
        <span>Kuis Interaktif</span><i></i>
        <span>Tur Virtual 360&deg;</span>
      </div>
    </div>
  </div>
</section>
@endsection
