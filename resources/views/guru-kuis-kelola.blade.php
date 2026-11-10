@extends('layouts.lms')

@section('lms-title', 'Kelola Kuis')

@php $activeMenu = 'guru-kuis'; @endphp

@section('lms-content')
<div class="lms-head-row">
  <div>
    <h3 class="lms-h">{{ $kuis->judul }}</h3>
    <p class="lms-p">{{ $kuis->deskripsi ?? 'Pilihan ganda' }} &middot; {{ $kuis->soal->count() }} soal</p>
  </div>
  <div class="lms-actions" style="display:flex;gap:8px;align-items:center">
    <a class="dash-btn" href="{{ route('guru.kuis') }}">Kembali</a>
    <form method="POST" action="{{ route('guru.kuis.hapus', $kuis) }}" onsubmit="return confirm('Hapus kuis ini beserta soal & hasilnya?')">
      @csrf
      @method('DELETE')
      <button class="dash-btn" type="submit">Hapus Kuis</button>
    </form>
  </div>
</div>

<div class="lms-list">
  @forelse ($kuis->soal as $s)
    <div class="lms-list-row">
      <div>
        <b>{{ $s->urutan }}. {{ $s->pertanyaan }}</b><br>
        <small>{{ implode(' · ', json_decode($s->pilihan ?: '[]') ?: []) }} &mdash; jawaban: {{ (json_decode($s->pilihan ?: '[]') ?: [])[$s->jawaban] ?? '-' }}</small>
      </div>
      <form method="POST" action="{{ route('guru.soal.hapus', $s) }}" onsubmit="return confirm('Hapus soal ini?')">
        @csrf
        @method('DELETE')
        <button class="dash-btn" type="submit">Hapus</button>
      </form>
    </div>
  @empty
    <p class="dash-empty">Belum ada soal. Tambahkan soal pertama di bawah.</p>
  @endforelse
</div>

<div class="lms-panel">
  <h3>Tambah Soal</h3>
  <form method="POST" action="{{ route('guru.kuis.soal.store', $kuis) }}">
    @csrf
    <div class="lms-info-grid">
      <label class="lms-span2">Pertanyaan
        <textarea name="pertanyaan" rows="3" required></textarea>
      </label>
      @foreach (['A', 'B', 'C', 'D'] as $i => $huruf)
        <label>Pilihan {{ $huruf }}
          <input type="text" name="pilihan[]" required>
        </label>
      @endforeach
      <label>Jawaban benar
        <select name="jawaban" required>
          @foreach (['A', 'B', 'C', 'D'] as $i => $huruf)
            <option value="{{ $i }}">{{ $huruf }}</option>
          @endforeach
        </select>
      </label>
      <label>Penjelasan
        <input type="text" name="penjelasan" placeholder="Opsional">
      </label>
    </div>
    <button class="btn btn-coklat lms-edit-btn" type="submit">Tambah Soal</button>
  </form>
</div>
@endsection
