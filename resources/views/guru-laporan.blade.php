@extends('layouts.lms')

@section('lms-title', 'Laporan Hasil Belajar')

@php $activeMenu = 'laporan'; @endphp

@section('lms-content')
<div class="dash-stats dash-stats-3">
  <div class="dash-stat"><b>{{ $rataNilai }}</b><span>Rata-Rata<br>Nilai</span></div>
  <div class="dash-stat"><b>{{ $progresRata }}%</b><span>Progres<br>Rata-Rata</span></div>
  <div class="dash-stat"><b>{{ $ketuntasan }}%</b><span>Ketuntasan<br>Tugas</span></div>
</div>

<h3 class="lms-h">Perbandingan Progres Antarkelas</h3>
<div class="lms-cards lms-cards-3">
  @forelse ($kelas as $k)
    <article class="lms-kelas-card">
      <span class="lms-kelas-badge">{{ strtoupper($k->tingkat . ' - ' . $k->nama) }}</span>
      <b>{{ $k->siswa_count }}</b>
      <p>Peserta Didik</p>
      <div class="bar"><i style="width:{{ min(100, $k->siswa_count * 2.5) }}%"></i></div>
      <p class="lms-kode">{{ min(100, (int) round($k->siswa_count * 2.5)) }}%</p>
    </article>
  @empty
    <p class="dash-empty">Belum ada kelas yang diampu.</p>
  @endforelse
</div>
@endsection
