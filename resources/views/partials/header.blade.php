{{-- Header bersama — Ref 1 (senandungasa) + Ref 2 (ikn, search kanan) --}}
@php $current = request()->route()->getName(); @endphp
<header class="site-header" id="siteHeader">
  <div class="container header-inner">
    <a class="brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaya Nusantara">
    </a>

    <nav class="main-nav" id="mainNav" aria-label="Navigasi utama">
      <ul>
        <li class="has-drop {{ $current === 'home' ? 'current' : '' }}" id="homeDrop">
          <button class="drop-toggle {{ $current === 'home' ? 'active' : '' }}" id="dropToggle"
                  aria-expanded="false" aria-haspopup="true">
            Home <span class="caret">&#9662;</span>
          </button>
          {{-- Fitur Home bisa diklik (brief) --}}
          <ul class="dropdown">
            <li><a href="{{ route('home') }}#beranda">Beranda</a></li>
            <li><a href="{{ route('home') }}#jelajah">Jelajah Nusantara</a></li>
            <li><a href="{{ route('home') }}#peta">Peta</a></li>
            <li><a href="{{ route('home') }}#faq">FAQ</a></li>
            <li><a href="{{ route('home') }}#testimoni">Testimoni</a></li>
            <li><a href="{{ route('home') }}#mitra">Mitra</a></li>
          </ul>
        </li>
        <li><a class="{{ $current === 'selasar' ? 'active' : '' }}" href="{{ route('selasar') }}">Selasar Budaya</a></li>
        <li><a class="{{ $current === 'galeri' ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri Karya</a></li>
        <li><a class="{{ $current === 'jelajah360' ? 'active' : '' }}" href="{{ route('jelajah360') }}">Jelajah Budaya 360&deg;</a></li>
        <li><a class="{{ $current === 'belajar' ? 'active' : '' }}" href="{{ route('belajar') }}">Ruang Belajar</a></li>
      </ul>
    </nav>

    {{-- Search + akun paling kanan --}}
    <div class="header-actions">
      <button class="search-btn" id="searchToggle" aria-label="Buka pencarian" aria-expanded="false">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
          <circle cx="11" cy="11" r="7"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>

      @auth
        <div class="user-menu">
          <button class="head-btn" id="userToggle" aria-label="Menu akun" aria-expanded="false" aria-haspopup="true">
            <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6z"/></svg>
          </button>
          <div class="user-drop" id="userDrop">
            <div class="user-drop-head">
              <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
              <div>
                <p class="user-drop-name">{{ auth()->user()->name }}</p>
                <p class="user-drop-email">{{ auth()->user()->email }}</p>
              </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="user-logout" type="submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Logout
              </button>
            </form>
          </div>
        </div>
      @else
        <a class="head-btn" href="{{ route('login') }}" aria-label="Masuk / Registrasi" title="Masuk / Registrasi">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6z"/></svg>
        </a>
      @endauth
    </div>

    <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">&#9776;</button>
  </div>

  <div class="search-panel" id="searchPanel">
    <form class="container" id="headerSearch" role="search">
      <input type="search" id="headerSearchInput" placeholder="Cari Budaya Indonesia..." aria-label="Cari budaya">
      <button class="btn emas" type="submit">Cari</button>
    </form>
  </div>
</header>
