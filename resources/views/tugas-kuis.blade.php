@extends('layouts.lms')

@section('lms-title', 'Tugas & Kuis')

@php
  $activeMenu = 'tugas-kuis';
  $aktif = $tugas->filter(fn ($t) => ! $t->deadline || $t->deadline >= now())->count();
  $selesai = $tugas->filter(fn ($t) => $t->submissions->isNotEmpty())->count();
  $kuisTersedia = \App\Models\Tugas::count() > 0 ? 1 : 0;
@endphp

@section('lms-content')
<div class="dash-stats dash-stats-3">
  <div class="dash-stat"><b>{{ $aktif }}</b><span>Tugas<br>Aktif</span></div>
  <div class="dash-stat"><b>{{ $kuisTersedia }}</b><span>Kuis<br>Tersedia</span></div>
  <div class="dash-stat"><b>{{ $selesai }}</b><span>Selesai</span></div>
</div>

<h3 class="lms-h">Kuis Tersedia</h3>
<p class="lms-p">Kerjakan kuis untuk menguji pemahamanmu tentang 7 unsur kebudayaan.</p>
<div class="lms-list">
  @forelse ($kuis as $k)
    <div class="lms-list-row">
      <div><b>{{ $k->judul }}</b><br><small>{{ $k->jenis ?? 'Pilihan Ganda' }} &middot; {{ $k->soal_count }} soal</small></div>
      @if (isset($hasil[$k->id]))
        <span class="lms-badge ok">Nilai {{ $hasil[$k->id]->skor }}</span>
        <a class="dash-btn" href="{{ route('kuis.hasil', $k->id) }}">Lihat Hasil</a>
      @else
        <a class="dash-btn" href="{{ route('kuis.ambil', $k) }}">Kerjakan</a>
      @endif
    </div>
  @empty
    <p class="dash-empty">Belum ada kuis aktif.</p>
  @endforelse
</div>

<h3 class="lms-h">Daftar Aktivitas</h3>
<p class="lms-p">Pantau aktivitas dan selesaikan tantangan belajarmu.</p>

<div class="lms-list">
  @forelse ($tugas as $t)
    @php $sub = $t->submissions->first(); @endphp
    <div class="lms-list-row">
      <div>
        <b>{{ $t->judul }}</b><br>
        <small>Tugas &middot; {{ $sub ? 'Dikumpulkan ' . $sub->created_at->translatedFormat('j F Y') : ($t->deadline ? 'Tenggat ' . $t->deadline->translatedFormat('j F Y') : 'Tanpa tenggat') }}</small>
        @if ($sub && $sub->nilai !== null)
          <br><small><b>Nilai: {{ $sub->nilai }}</b>@if($sub->feedback_guru) — Umpan balik: {{ $sub->feedback_guru }}@endif</small>
        @elseif ($sub)
          <br><small>Menunggu penilaian guru.</small>
        @endif
      </div>
      <span class="lms-badge {{ $sub ? ($sub->nilai !== null ? 'ok' : 'solid') : 'no' }}">{{ $sub ? ($sub->nilai !== null ? 'Nilai ' . $sub->nilai : 'Dikumpulkan') : 'Belum Dikumpulkan' }}</span>
      @if ($sub)
        <a class="dash-btn" href="{{ route('tugas.unduh', $sub) }}">Unduh</a>
      @else
        <form method="POST" action="{{ route('tugas.upload', $t) }}" enctype="multipart/form-data" class="lms-upload">
          @csrf
          <label class="dash-btn lms-file-label">
            Upload
            <input type="file" name="file" accept=".doc,.docx,.pdf" required hidden>
          </label>
        </form>
      @endif
    </div>
  @empty
    <p class="dash-empty">Belum ada tugas untuk hari ini.</p>
  @endforelse
</div>
@endsection
