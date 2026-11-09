@extends('layouts.lms')

@section('lms-title', 'Forum Diskusi')

@php $activeMenu = 'forum'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <p class="lms-p">Berbagi pendapat dan belajar bersama teman.</p>
  </div>
  <button class="btn btn-krem" type="button" id="addDiskusiBtn">Buat Diskusi</button>
</div>

<form method="POST" action="{{ route('forum.buat') }}" class="lms-diskusi-form">
  @csrf
  <input type="text" name="judul" placeholder="Buat pertanyaan diskusi baru..." required maxlength="255">
  <button class="btn btn-coklat" type="submit">Kirim</button>
</form>

<div class="lms-panel">
  <span class="unsur-tag">Diskusi Terbaru</span>
  @forelse ($diskusi as $d)
    <div class="lms-diskusi">
      <div class="lms-diskusi-row">
        <div>
          <p class="lms-diskusi-unsur" style="text-align:left">{{ strtoupper($d->unsur?->nama ?? 'Umum') }}</p>
          <p class="lms-diskusi-judul">{{ $d->judul }}</p>
          <p class="lms-diskusi-meta">Diskusi oleh {{ $d->user?->name ?? 'Anonim' }} &middot; {{ $d->tanggapan->count() }} tanggapan</p>
        </div>
        @if ($d->user_id === auth()->id())
          <form method="POST" action="{{ route('forum.edit', $d) }}" class="lms-inline-edit">
            @csrf
            <input type="text" name="judul" value="{{ $d->judul }}" required maxlength="255">
            <button type="submit">Edit</button>
          </form>
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
@endsection
