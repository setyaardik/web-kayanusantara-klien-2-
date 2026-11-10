@extends('layouts.lms')

@section('lms-title', 'Materi Pembelajaran')

@php $activeMenu = 'guru-materi'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <h3 class="lms-h">Materi Pembelajaran</h3>
    <p class="lms-p">Susun materi berdasarkan tujuh unsur kebudayaan.</p>
  </div>
  <button class="btn btn-krem" type="button" id="addMateriBtn">Buat Materi</button>
</div>

<form method="GET" action="{{ route('guru.materi') }}" class="lms-filters">
  <select class="lms-filter" name="kelas_id" aria-label="Semua Kelas" onchange="this.form.submit()">
    <option value="">Semua Kelas</option>
    @foreach ($kelas as $k)
      <option value="{{ $k->id }}" {{ (string)($kelasId ?? '') === (string)$k->id ? 'selected' : '' }}>{{ $k->tingkat }} - {{ $k->nama }}</option>
    @endforeach
  </select>
  <select class="lms-filter" name="unsur_id" aria-label="Semua Unsur Budaya" onchange="this.form.submit()">
    <option value="">Semua Unsur Budaya</option>
    @foreach ($unsur as $u)
      <option value="{{ $u->id }}" {{ (string)($unsurId ?? '') === (string)$u->id ? 'selected' : '' }}>{{ $u->nama }}</option>
    @endforeach
  </select>
</form>

<div class="lms-list">
  @forelse ($materi as $m)
    <div class="lms-list-row">
      <div>
        <b>{{ $m->judul }}</b><br>
        <small>{{ $m->unsur?->nama ?? '-' }}{{ $m->kelas ? ' &middot; ' . $m->kelas->tingkat . ' ' . $m->kelas->nama : '' }} &middot; {{ (int)($m->submateri_count ?? 0) }} submateri</small>
      </div>
      <span class="lms-badge {{ $m->status === 'publikasi' ? 'ok' : 'no' }}">{{ $m->status === 'publikasi' ? 'Terbit' : 'Draf' }}</span>
      <button class="dash-btn" type="button"
        data-edit-materi="{{ $m->id }}"
        data-judul="{{ e($m->judul) }}"
        data-unsur="{{ $m->unsur_id }}"
        data-kelas="{{ $m->kelas_id ?? '' }}"
        data-rangkuman="{{ e($m->rangkuman ?? $m->isi ?? '') }}"
        data-submateri="{{ (int)($m->submateri_count ?? 0) }}"
        data-status="{{ $m->status }}">{{ $m->status === 'publikasi' ? 'Edit' : 'Lihat' }}</button>
      <form method="POST" action="{{ route('guru.materi.hapus', $m) }}" onsubmit="return confirm('Hapus materi ini?')">
        @csrf
        @method('DELETE')
        <button class="dash-btn" type="submit">Hapus</button>
      </form>
    </div>
  @empty
    <p class="dash-empty">Belum ada materi.</p>
  @endforelse
</div>

<div class="unsur-modal" id="materi-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title" id="materi-modal-title">Buat Materi</h3>
    <form method="POST" action="{{ route('guru.materi.store') }}" id="materi-form" data-store="{{ route('guru.materi.store') }}">
      @csrf
      <input type="hidden" name="_method" id="materi-method" value="POST" disabled>
      <label>Judul Materi
        <input type="text" name="judul" id="materi-judul" placeholder="Tulis judul materi pembelajaran" required>
      </label>
      <label>Unsur Budaya
        <select name="unsur_id" id="materi-unsur" required>
          @foreach ($unsur as $u)
            <option value="{{ $u->id }}">{{ $u->nama }}</option>
          @endforeach
        </select>
      </label>
      <label>Kelas
        <select name="kelas_id" id="materi-kelas">
          <option value="">Semua Kelas</option>
          @foreach ($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama }}</option>
          @endforeach
        </select>
      </label>
      <label>Rangkuman materi
        <textarea name="rangkuman" id="materi-rangkuman" rows="4" placeholder="Tulis rangkuman materi pembelajaran"></textarea>
      </label>
      <label>Jumlah Submateri
        <input type="number" name="submateri_count" id="materi-submateri" min="0" value="0">
      </label>
      <label>Status
        <select name="status" id="materi-status" required>
          <option value="draft">Draf</option>
          <option value="publikasi">Terbit</option>
        </select>
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit" id="materi-submit">Upload</button>
    </form>
  </div>
</div>
@endsection
