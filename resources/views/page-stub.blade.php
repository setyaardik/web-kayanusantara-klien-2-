@extends('layouts.main')

@section('title', $judul . ' — Kaya Nusantara')

@section('content')
{{-- Banner judul halaman --}}
<section class="page-hero">
  <div class="container">
    <span class="hero-badge">Belajar Budaya, Mengenal Identitas, Melestarikan Warisan Bangsa</span>
    <h1>{{ $judul }}</h1>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head center">
      <span class="eyebrow">Segera Hadir</span>
      <h2>Konten Menyusul</h2>
      <p>Halaman ini sedang dalam pengembangan. Nantikan pembaruan berikutnya.</p>
    </div>
  </div>
</section>
@endsection
