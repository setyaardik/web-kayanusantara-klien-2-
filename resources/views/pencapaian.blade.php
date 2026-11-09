@extends('layouts.lms')

@section('lms-title', 'Pencapaian')

@php $activeMenu = 'pencapaian'; @endphp

@section('lms-content')
<p class="lms-p">Berbagi pendapat dan belajar bersama teman.</p>

<div class="lms-poin">
  <img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="">
  <div>
    <h2>{{ $st['poin'] }} poin</h2>
    <p>Total poin pembelajaran</p>
  </div>
  <span class="lms-poin-badge">Penjelajah Budaya Tingkat {{ $tingkat + 1 }}</span>
</div>

<div class="lms-badges">
  @foreach ($lencana as $l)
    <article class="lms-badge-card {{ $l['ok'] ? 'ok' : '' }}">
      <img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="">
      <div>
        <h4>{{ $l['nama'] }}</h4>
        <p>{{ $l['syarat'] }}</p>
        <span class="lms-badge-mini {{ $l['ok'] ? 'ok' : 'no' }}">{{ $l['ok'] ? 'Diperoleh' : 'Belum Diperoleh' }}</span>
      </div>
    </article>
  @endforeach
</div>
@endsection
