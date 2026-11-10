@extends('layouts.lms')

@section('lms-title', 'Forum Diskusi')

@php $activeMenu = 'forum'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <p class="lms-p">Fasilitasi diskusi kritis tentang fenomena budaya.</p>
  </div>
  <button class="btn btn-krem" type="button" id="addDiskusiBtn">Buat Diskusi</button>
</div>

<div class="lms-panel">
  <span class="unsur-tag">Diskusi Terbaru</span>
  @forelse ($diskusi as $d)
    <div class="lms-diskusi">
      <div class="lms-diskusi-row">
        <div>
          <p class="lms-diskusi-unsur" style="text-align:left">{{ strtoupper($d->unsur?->nama ?? 'Umum') }}</p>
          <p class="lms-diskusi-judul">{{ $d->judul }}</p>
          @if($d->pertanyaan_pematik)
            <p class="lms-diskusi-meta">{{ $d->pertanyaan_pematik }}</p>
          @endif
          <p class="lms-diskusi-meta">Diskusi oleh {{ $d->user?->name ?? 'Anonim' }} &middot; {{ $d->tanggapan->count() }} tanggapan</p>
        </div>
        @if ($d->user_id === auth()->id())
          <button class="dash-btn" type="button"
            data-edit-diskusi="{{ $d->id }}"
            data-judul="{{ e($d->judul) }}"
            data-pematik="{{ e($d->pertanyaan_pematik ?? '') }}">Edit</button>
        @endif
      </div>
      @if ($d->tanggapan->isNotEmpty())
        <ul class="lms-tanggapan">
          @foreach ($d->tanggapan as $t)
            <li><b>{{ $t->user?->name ?? 'Anonim' }}</b>: {{ $t->isi }}</li>
          @endforeach
        </ul>
      @endif
      <form method="POST" action="{{ route('forum.tanggap', $d) }}" class="lms-tanggap-form">
        @csrf
        <input type="text" name="isi" placeholder="Berikan tanggapan ..." required maxlength="1000">
        <button type="submit">Kirim</button>
      </form>
    </div>
  @empty
    <p class="dash-empty">Belum ada diskusi. Jadilah yang pertama!</p>
  @endforelse
</div>

<div class="unsur-modal" id="diskusi-modal" hidden>
  <div class="lms-dialog">
    <button class="lms-dialog-close" type="button" data-close aria-label="Tutup">&times;</button>
    <h3 class="lms-modal-title" id="diskusi-modal-title">Buat Diskusi</h3>
    <form method="POST" action="{{ route('forum.buat') }}" id="diskusi-form" data-store="{{ route('forum.buat') }}">
      @csrf
      <label>Judul Diskusi
        <input type="text" name="judul" id="diskusi-judul" placeholder="Tulis judul diskusi" required maxlength="255">
      </label>
      <label>Pertanyaan Pematik
        <input type="text" name="pertanyaan_pematik" id="diskusi-pematik" placeholder="Tulis pertanyaan pematik" maxlength="1000">
      </label>
      <button class="btn btn-coklat lms-edit-btn" type="submit" id="diskusi-submit">Upload</button>
    </form>
  </div>
</div>
@endsection
