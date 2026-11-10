@extends('layouts.lms')

@section('lms-title', 'Hasil Kuis')

@php $activeMenu = 'tugas-kuis'; @endphp

@section('lms-content')
<div class="lms-poin">
  <div>
    <h2>Skor {{ $hasil->skor }}</h2>
    <p>Benar {{ $hasil->benar }} dari {{ $hasil->total }} soal &middot; {{ $kuis->judul }}</p>
  </div>
  <a class="btn btn-krem lms-poin-badge" href="{{ route('tugas-kuis') }}">Kembali ke Tugas &amp; Kuis</a>
</div>

<div class="lms-list">
  @foreach ($kuis->soal as $s)
    @php $pilihan = json_decode($s->pilihan ?: '[]'); @endphp
    <div class="lms-list-row" style="align-items:flex-start">
      <div>
        <b>{{ $s->urutan }}. {{ $s->pertanyaan }}</b><br>
        <small>Jawaban benar: <b>{{ $pilihan[$s->jawaban] ?? '-' }}</b></small>
        @if ($s->penjelasan)
          <p class="dash-motif">{{ $s->penjelasan }}</p>
        @endif
      </div>
    </div>
  @endforeach
</div>
@endsection
