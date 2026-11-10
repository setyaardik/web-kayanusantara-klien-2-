@extends('layouts.lms')

@section('lms-title', 'Kerjakan Kuis')

@php $activeMenu = 'tugas-kuis'; @endphp

@section('lms-content')
<div class="lms-panel lms-kuis-panel">
  <h3>{{ $kuis->judul }}</h3>
  <p class="lms-p">{{ $kuis->deskripsi ?? 'Pilihan ganda' }} &middot; {{ $kuis->soal->count() }} soal</p>

  <form method="POST" action="{{ route('kuis.kirim', $kuis) }}">
    @csrf
    @foreach ($kuis->soal as $s)
      @php $pilihan = json_decode($s->pilihan ?: '[]'); @endphp
      <fieldset class="lms-soal">
        <legend><b>{{ $s->urutan }}. {{ $s->pertanyaan }}</b></legend>
        @foreach ($pilihan as $i => $p)
          <label class="lms-pilihan">
            <input type="radio" name="soal_{{ $s->id }}" value="{{ $i }}" required>
            {{ $p }}
          </label>
        @endforeach
      </fieldset>
    @endforeach
    <button class="btn btn-coklat lms-edit-btn" type="submit">Kirim Jawaban</button>
  </form>
</div>
@endsection
