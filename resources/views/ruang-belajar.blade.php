@extends('layouts.lms')

@section('lms-title', 'Dashboard')

@php $activeMenu = 'dashboard'; @endphp

@section('lms-content')
<div class="dash-hero">
  <img class="dash-hero-img" src="{{ asset('assets/img/hero/hero-wayang.webp') }}" alt="Wayang">
  <div class="dash-hero-txt">
    <span class="dash-hero-chip">RUANG BELAJAR KAYA NUSANTARA</span>
    <h2>Halo, {{ auth()->user()->name }}!<br>Mari jelajahi kekayaan budaya Indonesia</h2>
    <a class="btn btn-coklat" href="{{ route('kelas-saya') }}">Lanjutkan Belajar</a>
  </div>
</div>

<div class="dash-stats">
  <div class="dash-stat"><b>{{ $st['materiTersedia'] }}</b><span>Materi<br>Tersedia</span></div>
  <div class="dash-stat"><b>{{ $st['materiSelesai'] }}</b><span>Materi<br>Selesai</span></div>
  <div class="dash-stat"><b>{{ $st['progres'] }}%</b><span>Progres<br>Belajar</span></div>
  <div class="dash-stat"><b>{{ $st['poin'] }}</b><span>Poin<br>Terkumpul</span></div>
</div>

<div class="dash-cols">
  <div class="dash-lanjut">
    <div class="dash-sec-head">
      <div>
        <h3>Lanjutkan Pembelajaran</h3>
        <p>Teruskan materi yang terakhir kamu pelajari. <a href="{{ route('kelas-saya') }}">Lihat semua &gt;</a></p>
      </div>
    </div>
    @if ($lanjut)
    <article class="dash-lanjut-card">
      <img src="{{ asset('assets/img/materi/'.$lanjut->slug.'.webp') }}" alt="{{ $lanjut->nama }}">
      <span class="unsur-tag">{{ strtoupper($lanjut->nama) }}</span>
      <p>{{ $lanjut->ringkasan }}</p>
      <div class="bar"><i style="width:{{ $lanjut->persen }}%"></i></div>
      <div class="dash-row"><a href="{{ route('kelas-saya') }}">Buka &gt;</a><b>{{ $lanjut->persen }}%</b></div>
    </article>
    @endif
    <div class="dash-mini-grid">
      <div class="dash-box">
        <h4>Aktivitas Mendatang</h4>
        @forelse ($tugasAktif as $t)
          <div class="dash-aktivitas">
            <span class="dash-tgl"><b>{{ \Carbon\Carbon::parse($t->deadline)->format('d') }}</b>{{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('M') }}</span>
            <div><b>{{ $t->judul }}</b><br><small>{{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('l, H.i') }} WIB</small></div>
          </div>
        @empty
          <p class="dash-empty">Tidak ada aktivitas mendatang.</p>
        @endforelse
        <a class="dash-btn" href="{{ route('tugas-kuis') }}">Lihat semua aktivitas</a>
      </div>
      <div class="dash-box">
        <h4>Target Mingguan</h4>
        <p>Selesaikan 5 materi minggu ini.</p>
        <p class="dash-target">{{ $targetSelesai }} dari 5 Materi Selesai</p>
        <div class="bar"><i style="width:{{ $targetSelesai / 5 * 100 }}%"></i></div>
        <p class="dash-motif">{{ $targetSelesai >= 5 ? 'Target tercapai. Luar biasa!' : 'Sedikit lagi. Semangat belajar!' }}</p>
        <h4 class="dash-ach-title">Pencapaian Penjelajah Budaya</h4>
        <p>Kamu sudah mendapatkan {{ $st['materiSelesai'] }} lencana pembelajaran.</p>
        <a class="dash-btn" href="{{ route('pencapaian') }}">Lihat pencapaian</a>
      </div>
    </div>
  </div>
</div>
@endsection
