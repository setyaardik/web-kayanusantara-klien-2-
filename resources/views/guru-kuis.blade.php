@extends('layouts.lms')

@section('lms-title', 'Kuis dan Asesmen')

@php
  $activeMenu = 'guru-kuis';
  $jenis = ['Pilihan Ganda', 'Esai Analitis', 'Studi Kasus', 'Proyek', 'Presentasi'];
@endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <h3 class="lms-h">Buat Kuis dan Asesmen</h3>
    <p class="lms-p">Buat evaluasi pemahaman dan kemampuan analisis siswa.</p>
  </div>
  <button class="btn btn-krem" type="button" id="addKuisBtn">Buat Kuis</button>
</div>

<div class="lms-list">
  @forelse ($kuis as $k)
    <div class="lms-list-row">
      <div><b>{{ $k->judul }}</b><br><small>{{ $k->jenis ?? 'Pilihan Ganda' }} &middot; {{ $k->soal->count() }} soal{{ $k->kelas ? ' &middot; ' . $k->kelas->tingkat . ' ' . $k->kelas->nama : '' }}</small></div>
      <span class="lms-badge {{ $k->aktif ? 'ok' : 'no' }}">{{ $k->aktif ? 'Aktif' : 'Draf' }}</span>
      <a class="dash-btn" href="{{ route('guru.kuis') }}">Kelola</a>
    </div>
  @empty
    <p class="dash-empty">Belum ada kuis.</p>
  @endforelse
</div>

<h3 class="lms-h">Jenis Asesmen yang Tersedia</h3>
<div class="lms-chips">
  @foreach ($jenis as $i => $j)
    <button class="lms-chip {{ $i === 0 ? 'is-active' : '' }}" type="button">{{ $j }}</button>
  @endforeach
</div>

<div class="unsur-modal" id="kuis-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title">Buat Kuis</h3>
    <form method="POST" action="{{ route('guru.kuis.store') }}">
      @csrf
      <label>Judul Tugas
        <input type="text" name="judul" placeholder="Tulis judul tugas" required>
      </label>
      <label>Deskripsi Tugas
        <input type="text" name="deskripsi" placeholder="Tulis deskripsi tugas untuk peserta didik">
      </label>
      <label>Pilih Jenis Asesmen yang Digunakan
        <select name="jenis" required>
          @foreach ($jenis as $j)
            <option value="{{ $j }}">{{ $j }}</option>
          @endforeach
        </select>
      </label>
      <label>Pilih Tanggal Tenggat Waktu
        <input type="datetime-local" name="tenggat">
      </label>
      <label>Pilih Kelas
        <select name="kelas_id">
          <option value="">Semua Kelas</option>
          @foreach ($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama }}</option>
          @endforeach
        </select>
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit">Upload</button>
    </form>
  </div>
</div>
@endsection
