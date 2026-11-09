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

<h3 class="lms-h">Daftar Aktivitas</h3>
<p class="lms-p">Pantau aktivitas dan selesaikan tantangan belajarmu.</p>

<div class="lms-list">
  @forelse ($tugas as $t)
    @php $sub = $t->submissions->first(); @endphp
    <div class="lms-list-row">
      <div>
        <b>{{ $t->judul }}</b><br>
        <small>Tugas &middot; {{ $sub ? 'Dikumpulkan ' . $sub->created_at->translatedFormat('j F Y') : ($t->deadline ? 'Tenggat ' . $t->deadline->translatedFormat('j F Y') : 'Tanpa tenggat') }}</small>
      </div>
      <span class="lms-badge {{ $sub ? 'ok' : 'no' }}">{{ $sub ? ($sub->nilai !== null ? 'Selesai' : 'Dikumpulkan') : 'Belum Dikumpulkan' }}</span>
      @if ($sub)
        <span class="lms-badge solid">Selesai</span>
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
