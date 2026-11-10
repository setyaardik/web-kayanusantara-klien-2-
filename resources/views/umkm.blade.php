@extends('layouts.main')

@section('title', 'Mitra UMKM — Kaya Nusantara')

@section('content')
<section class="dashboard-section">
  <div class="container">
    <div class="ruang-hero">
      <p class="dashboard-eyebrow">Mitra UMKM</p>
      <h1>Halo, {{ auth()->user()->name }}</h1>
      <p class="dashboard-sub">Terima kasih sudah bergabung sebagai mitra Kaya Nusantara. Kabari kami lewat halaman Selasar Budaya bila ingin berkolaborasi lebih lanjut.</p>
    </div>
  </div>
</section>
@endsection
