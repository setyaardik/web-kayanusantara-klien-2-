@extends('layouts.main')

@section('title', 'Dashboard Guru — Kaya Nusantara')

@section('content')
<section class="dashboard-section">
  <div class="container">
    <p class="dashboard-eyebrow">Ruang Belajar &bull; Guru</p>
    <h1>Halo, Bu/Pak {{ auth()->user()->name }}</h1>
    <p class="dashboard-sub">Kelola pembelajaran budaya untuk murid-muridmu.</p>

    <div class="dashboard-grid">
      <div class="dashboard-card dashboard-card-off">
        <h3>Kelas</h3>
        <p>Buat kelas dan undang murid dengan kode kelas. (Segera hadir)</p>
        <span>Dalam pengembangan</span>
      </div>
      <div class="dashboard-card dashboard-card-off">
        <h3>Tugas</h3>
        <p>Berikan tugas dan telaah karya yang dikumpulkan murid. (Segera hadir)</p>
        <span>Dalam pengembangan</span>
      </div>
      <div class="dashboard-card dashboard-card-off">
        <h3>Penilaian</h3>
        <p>Lihat hasil kuis dan perkembangan pemahaman budaya murid. (Segera hadir)</p>
        <span>Dalam pengembangan</span>
      </div>
      <div class="dashboard-card dashboard-card-off">
        <h3>Materi</h3>
        <p>Susun materi tambahan dari 7 unsur kebudayaan. (Segera hadir)</p>
        <span>Dalam pengembangan</span>
      </div>
    </div>
  </div>
</section>
@endsection
