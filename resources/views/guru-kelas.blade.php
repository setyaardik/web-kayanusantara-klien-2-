@extends('layouts.lms')

@section('lms-title', 'Kelas Saya')

@php $activeMenu = 'guru-kelas'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <h3 class="lms-h">Kelas yang Diampu</h3>
    <p class="lms-p">Kelola aktivitas pembelajaran setiap kelas. <a href="#">Lihat semua &gt;</a></p>
  </div>
  <button class="btn btn-krem" type="button" id="addKelasBtn">Tambah Kelas</button>
</div>

<div class="lms-cards lms-cards-3">
  @forelse ($kelas as $k)
    <article class="lms-kelas-card">
      <span class="lms-kelas-badge">{{ strtoupper($k->tingkat . ' - ' . $k->nama) }}</span>
      <b>{{ $k->siswa_count }}</b>
      <p>Peserta Didik</p>
      <div class="bar"><i style="width:{{ min(100, $k->siswa_count * 2.5) }}%"></i></div>
      <p class="lms-kode">Kode kelas: <b>{{ $k->kode }}</b></p>
      <a class="btn btn-coklat lms-kelola-btn" href="{{ route('guru.kelas') }}">Kelola Kelas</a>
    </article>
  @empty
    <p class="dash-empty">Belum ada kelas yang diampu.</p>
  @endforelse
</div>

<div class="lms-panel">
  <h3>Pengaturan Kelas</h3>
  <p>Pengelolaan daftar siswa, kode kelas, materi, tugas, kuis, dan laporan perkembangan.</p>
</div>

{{-- Pop-up tambah kelas --}}
<div class="unsur-modal" id="kelas-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title">Tambah Kelas</h3>
    <form method="POST" action="{{ route('guru.kelas.store') }}">
      @csrf
      <label>Nama Kelas
        <input type="text" name="nama" placeholder="Contoh : X - B" required>
      </label>
      <label>Tingkat
        <select name="tingkat" required>
          @foreach (['X', 'XI', 'XII'] as $t)
            <option value="{{ $t }}">{{ $t }}</option>
          @endforeach
        </select>
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit">Tambah Kelas</button>
    </form>
  </div>
</div>
@endsection
