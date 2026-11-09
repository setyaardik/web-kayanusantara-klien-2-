@extends('layouts.lms')

@section('lms-title', 'Progres Belajar')

@php $activeMenu = 'progres'; @endphp

@section('lms-content')
<div class="dash-stats dash-stats-3">
  <div class="dash-stat"><b>{{ $st['progres'] }}%</b><span>Total<br>Progres</span></div>
  <div class="dash-stat"><b>{{ $st['materiSelesai'] }}/{{ $st['materiTersedia'] }}</b><span>Materi<br>Selesai</span></div>
  <div class="dash-stat"><b>{{ $rataNilai }}</b><span>Rata-Rata<br>Nilai</span></div>
</div>

<p class="lms-p">Lihat perkembangan dan pencapaian pembelajaranmu.</p>

<div class="lms-bars">
  @foreach ($st['list'] as $u)
    <div class="lms-bar-row">
      <b><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> {{ $u->nama }}</b>
      <div class="bar"><i style="width:{{ $u->persen }}%"></i></div>
      <span>{{ $u->persen }}%</span>
    </div>
  @endforeach
</div>
@endsection
