@extends('layouts.lms')

@section('lms-title', 'Dashboard')

@php $activeMenu = 'dashboard'; @endphp

@section('lms-content')
<div class="dash-hero">
  <img class="dash-hero-img" src="{{ asset('assets/img/hero-jelajah.webp') }}" alt="Ruang Guru">
  <div class="dash-hero-txt">
    <span class="dash-hero-chip">PUSAT PENGELOLAAN PEMBELAJARAN</span>
    <h2>Halo, {{ auth()->user()->name }}!<br>Kelola kelas, kembangkan materi, dan dampingi siswa SMA dalam memahami keberagaman budaya Indonesia.</h2>
    <a class="btn btn-coklat" href="{{ route('guru.tugas') }}">Buat Tugas Baru</a>
  </div>
</div>

<div class="dash-stats">
  <div class="dash-stat"><b>{{ $stats['peserta'] }}</b><span>Total<br>Peserta Didik</span></div>
  <div class="dash-stat"><b>{{ $stats['materi'] }}</b><span>Materi<br>Diterbitkan</span></div>
  <div class="dash-stat"><b>{{ $stats['tugasAktif'] }}</b><span>Tugas<br>Aktif</span></div>
  <div class="dash-stat"><b>{{ $stats['perluDiperiksa'] }}</b><span>Perlu<br>Diperiksa</span></div>
</div>

<h3 class="lms-h">Kelas yang Diampu</h3>
<p class="lms-p">Kelola aktivitas pembelajaran setiap kelas. <a href="{{ route('guru.kelas') }}">Lihat semua &gt;</a></p>
<div class="lms-cards lms-cards-3">
  @forelse ($kelas as $k)
    <article class="lms-kelas-card">
      <span class="lms-kelas-badge">{{ strtoupper($k->tingkat . ' - ' . $k->nama) }}</span>
      <b>{{ $k->siswa->count() }}</b>
      <p>Peserta Didik</p>
      <div class="bar"><i style="width:{{ $k->siswa->count() > 0 ? min(100, $k->siswa->count() * 2.5) : 0 }}%"></i></div>
      <a class="dash-btn" href="{{ route('guru.kelas') }}">Kelola Kelas</a>
    </article>
  @empty
    <p class="dash-empty">Belum ada kelas. Tambah kelas pertama lewat menu Kelas Saya.</p>
  @endforelse
</div>

<h3 class="lms-h">Pengumpulan Tugas Terbaru</h3>
<p class="lms-p">Periksa semua tugas. <a href="{{ route('guru.penilaian') }}">Periksa semua &gt;</a></p>
<div class="lms-list">
  @forelse ($pengumpulan as $p)
    <div class="lms-list-row">
      <div><b>{{ $p->tugas?->judul ?? '-' }}</b><br><small>{{ $p->user?->name ?? '-' }} &middot; {{ $p->created_at->translatedFormat('j F Y') }}</small></div>
      <span class="lms-badge {{ $p->nilai === null ? 'no' : 'ok' }}">{{ $p->nilai === null ? 'Belum Dinilai' : 'Selesai' }}</span>
      <a class="dash-btn" href="{{ route('guru.penilaian') }}">{{ $p->nilai === null ? 'Nilai' : 'Lihat' }}</a>
    </div>
  @empty
    <p class="dash-empty">Belum ada pengumpulan tugas.</p>
  @endforelse
</div>

<div class="dash-mini-grid dash-mini-grid-3">
  <div class="dash-box">
    <h4>Aktivitas Mendatang</h4>
    @forelse ($mendatang as $t)
      <div class="dash-aktivitas">
        <span class="dash-tgl"><b>{{ $t->deadline?->format('d') }}</b>{{ $t->deadline?->translatedFormat('M') }}</span>
        <div><b>{{ $t->judul }}</b><br><small>{{ $t->deadline?->translatedFormat('l, H.i') }} WIB</small></div>
      </div>
    @empty
      <p class="dash-empty">Tidak ada aktivitas mendatang.</p>
    @endforelse
  </div>
  <div class="dash-box">
    <h4>Aktivitas Siswa</h4>
    <p>Rata-rata penyelesaian pembelajaran</p>
    <h2 class="dash-big">{{ $aktivitasSiswa }}%</h2>
    <div class="bar"><i style="width:{{ $aktivitasSiswa }}%"></i></div>
    <p class="dash-motif">Berdasarkan seluruh kelas yang diampu.</p>
  </div>
  <div class="dash-box">
    <h4><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Inspirasi Mengajar</h4>
    <p>Ajak siswa membandingkan nilai budaya dua daerah melalui proyek penelitian sederhana.</p>
  </div>
</div>
@endsection
