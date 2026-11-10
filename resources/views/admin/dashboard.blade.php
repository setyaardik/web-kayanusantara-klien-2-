@extends('admin.layout')
@section('title','Dashboard Admin')
@section('content')
<div class="admin-top">
  <h1>Dashboard Admin</h1>
  <div class="muted">Kelola konten Home, Selasar Budaya, Jelajah 360, dan Akun.</div>
</div>
<div class="grid cols-3">
  <div class="card stat"><b>{{ $counts['faq'] }}</b><span>FAQ</span></div>
  <div class="card stat"><b>{{ $counts['testimoni'] }}</b><span>Testimoni</span></div>
  <div class="card stat"><b>{{ $counts['mitra'] }}</b><span>Mitra</span></div>
  <div class="card stat"><b>{{ $counts['berita'] }}</b><span>Berita (Selasar)</span></div>
  <div class="card stat"><b>{{ $counts['toko'] }}</b><span>Produk Toko</span></div>
  <div class="card stat"><b>{{ $counts['agenda'] }}</b><span>Agenda (Jelajah)</span></div>
  <div class="card stat"><b>{{ $counts['destinasi'] }}</b><span>Destinasi 360</span></div>
  <div class="card stat"><b>{{ $counts['user'] }}</b><span>Users</span></div>
</div>
<div class="card" style="margin-top:16px">
  <p class="muted" style="margin:0">Gunakan menu di kiri untuk menambah, mengubah, atau menghapus data. Perubahan tampil di website sesuai urutan dan status aktif. Untuk gambar, Anda bisa unggah file atau isi path (mis. <code>assets/img/...</code>).</p>
</div>
@endsection
