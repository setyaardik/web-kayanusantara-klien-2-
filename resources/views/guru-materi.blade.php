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

<div class="lms-list">
  @forelse ($materi as $m)
    <div class="lms-list-row">
      <div>
        <b>{{ $m->judul }}</b><br>
        <small>{{ $m->unsur?->nama ?? '-' }} &middot; {{ $m->submateri ?? '2 submateri' }}</small>
      </div>
      <span class="lms-badge {{ $m->status === 'publikasi' ? 'ok' : 'no' }}">{{ $m->status === 'publikasi' ? 'Terbit' : 'Draf' }}</span>
      <a class="dash-btn" href="{{ route('guru.materi') }}">{{ $m->status === 'publikasi' ? 'Edit' : 'Lihat' }}</a>
    </div>
  @empty
    <p class="dash-empty">Belum ada materi.</p>
  @endforelse
</div>

<div class="unsur-modal" id="materi-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title">Buat Materi</h3>
    <form method="POST" action="{{ route('guru.materi.store') }}">
      @csrf
      <label>Judul Materi
        <input type="text" name="judul" placeholder="Contoh : Filosofi Rumah Adat Nusantara" required>
      </label>
      <label>Unsur Budaya
        <select name="unsur_id" required>
          @foreach ($unsur as $u)
            <option value="{{ $u->id }}">{{ $u->nama }}</option>
          @endforeach
        </select>
      </label>
      <label>Status
        <select name="status" required>
          <option value="draft">Draf</option>
          <option value="publikasi">Terbit</option>
        </select>
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit">Simpan Materi</button>
    </form>
  </div>
</div>
@endsection
