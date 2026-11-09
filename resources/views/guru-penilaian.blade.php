@extends('layouts.lms')

@section('lms-title', 'Penilaian Siswa')

@php $activeMenu = 'guru-penilaian'; @endphp

@section('lms-content')
<p class="lms-p">Penilaian Tugas dan Kuis — Periksa tugas, berikan skor, dan tulis umpan balik.</p>

<div class="lms-filters">
  <select class="lms-filter" id="filterKelas" aria-label="Semua Kelas">
    <option value="">Semua Kelas</option>
    @foreach ($kelasList as $k)
      <option value="{{ $k->tingkat }} - {{ $k->nama }}">{{ $k->tingkat }} - {{ $k->nama }}</option>
    @endforeach
  </select>
  <select class="lms-filter" id="filterUnsur" aria-label="Semua Unsur Budaya">
    <option value="">Semua Unsur Budaya</option>
    @foreach ($unsurList as $u)
      <option value="{{ $u->nama }}">{{ $u->nama }}</option>
    @endforeach
  </select>
</div>

<div class="lms-list">
  @forelse ($pengumpulan as $p)
    <div class="lms-list-row" data-kelas="{{ $p->tugas->kelas?->tingkat ?? '' }} - {{ $p->tugas->kelas?->nama ?? '' }}" data-unsur="{{ $p->tugas->unsur ?? '' }}">
      <div>
        <b>{{ $p->user?->name ?? '-' }}</b><br>
        <small>{{ $p->tugas->kelas?->tingkat ?? '' }} {{ $p->tugas->kelas?->nama ?? '' }} &middot; {{ $p->tugas?->judul ?? '-' }}</small>
        @if ($p->file_path)
          <br><a href="{{ Storage::disk('public')->url($p->file_path) }}" target="_blank" rel="noopener">Lihat berkas &rarr;</a>
        @endif
      </div>
      <span class="lms-badge {{ $p->nilai === null ? 'no' : 'ok' }}">{{ $p->nilai === null ? 'Belum dinilai' : 'Nilai ' . $p->nilai }}</span>
      <button type="button" class="dash-btn" data-nilai="{{ $p->id }}" data-nama="{{ $p->user?->name ?? '-' }}">{{ $p->nilai === null ? 'Beri Nilai' : 'Lihat Nilai' }}</button>
    </div>
  @empty
    <p class="dash-empty">Belum ada pengumpulan tugas.</p>
  @endforelse
</div>

<div class="lms-panel">
  <h3>Rubrik Penilaian Proyek</h3>
  <div class="lms-rubrik">
    <p>Ketepatan informasi budaya 30%</p>
    <p>Kreativitas penyajian 20%</p>
    <p>Kedalaman analisis 30%</p>
    <p>Referensi dan sumber 20%</p>
  </div>
</div>

{{-- Pop-up beri nilai --}}
<div class="unsur-modal" id="nilai-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title">Penilaian : <span id="nilai-nama"></span></h3>
    <form method="POST" action="" id="nilai-form">
      @csrf
      <label>Nilai (0-100)
        <input type="number" name="nilai" min="0" max="100" placeholder="Contoh : 90" required>
      </label>
      <label>Beri umpan balik
        <input type="text" name="feedback" placeholder="Tulis umpan balik" maxlength="255">
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit">Upload</button>
    </form>
  </div>
</div>
@endsection
