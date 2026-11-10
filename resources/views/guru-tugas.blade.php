@extends('layouts.lms')

@section('lms-title', 'Tugas dan Proyek')

@php $activeMenu = 'guru-tugas'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <h3 class="lms-h">Tugas dan Proyek</h3>
    <p class="lms-p">Rancang aktivitas belajar berbasis eksplorasi budaya.</p>
  </div>
  <button class="btn btn-krem" type="button" id="addTugasBtn">Buat Tugas</button>
</div>

<div class="dash-stats dash-stats-3">
  <div class="dash-stat"><b>{{ $tugas->where('deadline', '>=', now())->count() }}</b><span>Tugas<br>Aktif</span></div>
  <div class="dash-stat"><b>{{ \App\Models\Submission::whereNull('nilai')->count() }}</b><span>Menunggu<br>Penilaian</span></div>
  <div class="dash-stat"><b>{{ $tugas->isNotEmpty() ? round(\App\Models\Submission::count() / max(1, $tugas->count()) * 100) : 0 }}%</b><span>Rata-Rata<br>Pengumpulan</span></div>
</div>

<h3 class="lms-h">Daftar Aktivitas</h3>
<p class="lms-p">Pantau aktivitas dan selesaikan tantangan belajarmu.</p>
<div class="lms-list">
  @forelse ($tugas as $t)
    <div class="lms-list-row">
      <div>
        <b>{{ $t->judul }}</b><br>
        <small>Tugas &middot; {{ $t->deadline ? 'Tenggat ' . $t->deadline->translatedFormat('j F Y') : 'Tanpa tenggat' }}{{ $t->kelas ? ' &middot; ' . $t->kelas->tingkat . ' - ' . $t->kelas->nama : '' }}</small>
      </div>
      <span class="lms-badge {{ $t->deadline && $t->deadline < now() ? 'ok' : 'no' }}">{{ $t->deadline && $t->deadline < now() ? 'Selesai' : 'Sedang Berlangsung' }}</span>
      <button class="dash-btn" type="button"
        data-edit-tugas="{{ $t->id }}"
        data-judul="{{ e($t->judul) }}"
        data-deskripsi="{{ e($t->deskripsi ?? '') }}"
        data-kelas="{{ $t->kelas_id }}"
        data-deadline="{{ $t->deadline ? $t->deadline->format('Y-m-d\TH:i') : '' }}">Edit</button>
    </div>
  @empty
    <p class="dash-empty">Belum ada tugas.</p>
  @endforelse
</div>

<div class="unsur-modal" id="tugas-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title" id="tugas-modal-title">Buat Tugas</h3>
    <form method="POST" action="{{ route('guru.tugas.store') }}" id="tugas-form" data-store="{{ route('guru.tugas.store') }}">
      @csrf
      <input type="hidden" name="_method" id="tugas-method" value="POST" disabled>
      <label>Judul Tugas
        <input type="text" name="judul" id="tugas-judul" placeholder="Tulis judul tugas" required>
      </label>
      <label>Deskripsi Tugas
        <input type="text" name="deskripsi" id="tugas-deskripsi" placeholder="Tulis deskripsi tugas untuk peserta didik">
      </label>
      <label>Kelas
        <select name="kelas_id" id="tugas-kelas" required>
          @foreach ($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama }}</option>
          @endforeach
        </select>
      </label>
      <label>Pilih Tanggal Tenggat Waktu Pengumpulan
        <input type="datetime-local" name="deadline" id="tugas-deadline">
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit" id="tugas-submit">Upload</button>
    </form>
  </div>
</div>
@endsection
