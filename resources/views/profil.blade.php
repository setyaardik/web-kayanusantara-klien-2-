@extends('layouts.lms')

@section('lms-title', 'Profil')

@php $activeMenu = 'profil'; $user = auth()->user(); $daftarKelas = \App\Models\Kelas::orderBy('tingkat')->orderBy('nama')->get(); @endphp

@section('lms-content')
<p class="lms-p">Informasi akun dan aktivitas pembelajaran.</p>

<div class="lms-profil-head">
  <span class="lms-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
  <div>
    <h3>{{ $user->name }}</h3>
    <p>{{ $user->role === 'guru' ? 'Guru' : 'Peserta Didik' }}@if($user->kelas) &middot; Kelas {{ $user->kelas }}@endif</p>
    <p>{{ $user->sekolah ?? 'SMA Karangturi' }}</p>
  </div>
</div>

<div class="lms-panel">
  <h3>Informasi Akun</h3>
  <form method="POST" action="{{ route('profil.update') }}">
    @csrf
    <div class="lms-info-grid">
      <label>Nama Lengkap
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
      </label>
      <label>Status
        <input type="text" value="{{ $user->role === 'guru' ? 'Guru' : 'Peserta Didik' }}" disabled>
      </label>
      <label>Sekolah
        <select name="sekolah" required>
          <option value="SMA Karangturi" {{ old('sekolah', $user->sekolah) === 'SMA Karangturi' ? 'selected' : '' }}>SMA Karangturi</option>
        </select>
      </label>
      <label>Kelas
        <select name="kelas" required>
          @foreach ($daftarKelas as $k)
            <option value="{{ $k->nama }}" {{ old('kelas', $user->kelas) === $k->nama ? 'selected' : '' }}>{{ $k->tingkat }} - {{ $k->nama }}</option>
          @endforeach
        </select>
      </label>
      <label>Email
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
      </label>
    </div>
    <button class="btn btn-coklat lms-edit-btn" type="submit">Edit Profil</button>
  </form>
</div>
@endsection
