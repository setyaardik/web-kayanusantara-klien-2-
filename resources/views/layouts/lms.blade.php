{{-- Layout Ruang Belajar (dashboard murid & guru) — sidebar kanan + search + notifikasi --}}
@extends('layouts.main')

@php
  $user = auth()->user();
  $agendaNotifikasi = \App\Models\Tugas::where('deadline', '>=', now())->orderBy('deadline')->take(2)->get();
  $tglIndo = function ($d) {
    return $d ? \Carbon\Carbon::parse($d)->translatedFormat('j F') : '';
  };
@endphp

@section('content')
<section class="lms-section">
  <div class="container lms-wrap">
    <div class="lms-main">
      <div class="lms-topbar">
        <div>
          <h1 class="lms-title">@yield('lms-title', 'Dashboard')</h1>
          <p class="lms-date">{{ now()->translatedFormat('l, j F Y') }}</p>
        </div>
        <div class="lms-tools">
          <form class="unsur-search lms-search" action="{{ route('kelas-saya') }}" method="GET">
            <input type="search" name="q" placeholder="Cari materi pembelajaran" aria-label="Cari materi pembelajaran" value="{{ request('q') }}">
            <button type="submit" class="unsur-search-btn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
              Cari
            </button>
          </form>
          <div class="lms-notif">
            <button type="button" class="lms-notif-btn" id="notifBtn" aria-label="Notifikasi" aria-expanded="false">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9c8144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c1.2 0 2.2-1 2.2-2.2H9.8c0 1.2 1 2.2 2.2 2.2z"/><path d="M18 9.5c0-3.6-2.3-6.2-6-6.5-3.7.3-6 2.9-6 6.5 0 5-2 6-2 6h16s-2-1-2-6z"/></svg>
              <span class="lms-notif-dot"></span>
            </button>
            <div class="lms-notif-pop" id="notifPop">
              <p class="lms-notif-title">Notifikasi</p>
              @if ($agendaNotifikasi->isNotEmpty())
                <p>Ada {{ $agendaNotifikasi->count() }} aktivitas yang perlu kamu perhatikan:<br>
                @foreach ($agendaNotifikasi as $t)
                  {{ $t->judul }} ({{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('j F') }})@if (!$loop->last), @endif
                @endforeach
                .</p>
              @else
                <p>Tidak ada aktivitas mendatang. Tetap semangat belajar ya!</p>
              @endif
              <button type="button" class="lms-notif-ok" id="notifOk">Mengerti</button>
            </div>
          </div>
        </div>
      </div>

      @if (session('ok'))
        <p class="lms-ok">{{ session('ok') }}</p>
      @endif

      @yield('lms-content')
    </div>

    <aside class="lms-side">
      <img class="lms-side-logo" src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaya Nusantara">
      <p class="lms-side-h">Menu Utama</p>
      <nav class="lms-menu">
        @if ($user->role === 'guru')
          @php
            $menuUtama = [
              ['Dashboard', route('belajar'), 'dashboard'],
              ['Kelas Saya', route('guru.kelas'), 'guru-kelas'],
              ['Materi Pembelajaran', route('guru.materi'), 'guru-materi'],
              ['Tugas dan Proyek', route('guru.tugas'), 'guru-tugas'],
              ['Kuis dan Asesmen', route('guru.kuis'), 'guru-kuis'],
              ['Penilaian Siswa', route('guru.penilaian'), 'guru-penilaian'],
            ];
          @endphp
        @else
          @php
            $menuUtama = [
              ['Dashboard', route('belajar'), 'dashboard'],
              ['Kelas Saya', route('kelas-saya'), 'kelas-saya'],
              ['Tugas & Kuis', route('tugas-kuis'), 'tugas-kuis'],
              ['Progres Belajar', route('progres'), 'progres'],
            ];
          @endphp
        @endif
        @foreach ($menuUtama as [$label, $href, $key])
          <a href="{{ $href }}" class="{{ $activeMenu === $key ? 'is-active' : '' }}">
            <img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> {{ $label }}
          </a>
        @endforeach
        <a href="{{ route('selasar') }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Selasar Budaya</a>
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Galeri Karya</a>
        <a href="{{ route('jelajah360') }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Jelajah Budaya 360&deg;</a>
        <a href="{{ route('belajar') }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Ruang Belajar</a>
      </nav>
      <p class="lms-side-h lms-side-h2">Lainnya</p>
      <nav class="lms-menu">
        <a href="{{ route('forum') }}" class="{{ ($activeMenu ?? '') === 'forum' ? 'is-active' : '' }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Forum Diskusi</a>
        @if ($user->role === 'guru')
          <a href="{{ route('guru.laporan') }}" class="{{ ($activeMenu ?? '') === 'laporan' ? 'is-active' : '' }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Laporan Hasil Belajar</a>
        @else
          <a href="{{ route('pencapaian') }}" class="{{ ($activeMenu ?? '') === 'pencapaian' ? 'is-active' : '' }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Pencapaian</a>
        @endif
        <a href="{{ route('profil') }}" class="{{ ($activeMenu ?? '') === 'profil' ? 'is-active' : '' }}"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Profil</a>
      </nav>
    </aside>
  </div>
</section>
@endsection
