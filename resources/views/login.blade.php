@extends('layouts.auth')

@section('title', 'Masuk — Kaya Nusantara')

@section('content')
<section class="auth-hero">
  <div class="hero-bg" aria-hidden="true">
    <div class="hero-slide is-on" style="background-image:url('{{ asset('assets/img/hero/hero-wayang.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-tarikecak.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-pacujalur.webp') }}')"></div>
  </div>

  <div class="auth-card auth-card-center">
    <a class="auth-back" href="{{ route('home') }}">&larr; Kembali</a>
    <img class="auth-logo" src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaya Nusantara">
    <h1>Masuk</h1>
    <p class="auth-sub">Masuk untuk mulai belajar dan mengikuti kuis budaya.</p>

    @if ($errors->any())
      <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      @if (request('redirect'))
        <input type="hidden" name="redirect" value="{{ request('redirect') }}">
      @endif

      <div class="auth-role-picker">
        <span class="auth-role-label">Masuk sebagai</span>
        <div class="auth-role-options">
          <label class="auth-role-option">
            <input type="radio" name="login_as" value="siswa" {{ old('login_as', 'siswa') === 'siswa' ? 'checked' : '' }} required>
            <span>Murid</span>
          </label>
          <label class="auth-role-option">
            <input type="radio" name="login_as" value="guru" {{ old('login_as') === 'guru' ? 'checked' : '' }} required>
            <span>Guru</span>
          </label>
        </div>
      </div>

      <label>
        Email
        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
      </label>
      <label>
        Kata Sandi
        <div class="pass-wrap">
          <input type="password" name="password" required placeholder="••••••••">
          <button type="button" class="pass-eye" aria-label="Lihat kata sandi">
            <svg class="eye-on" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <svg class="eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
          </button>
        </div>
      </label>
      <label class="auth-check">
        <input type="checkbox" name="remember" value="1"> Ingat saya
      </label>
      <button class="btn btn-coklat auth-btn" type="submit">Masuk</button>
    </form>

    <p class="auth-switch">Belum punya akun? <a href="{{ route('registrasi') }}">Registrasi</a></p>
  </div>
</section>
@endsection
