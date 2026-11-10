@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Destinasi')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Destinasi</h1><a class="btn outline" href="{{ route('admin.destinasi.index') }}">Kembali</a></div>
<div class="card"><form method="POST" enctype="multipart/form-data" action="{{ $item->exists?route('admin.destinasi.update',$item):route('admin.destinasi.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="grid cols-2"><div class="field"><label>Nama</label><input type="text" name="nama" value="{{ old('nama',$item->nama) }}" required></div>
<div class="field"><label>Slug (opsional)</label><input type="text" name="slug" value="{{ old('slug',$item->slug) }}"></div></div>
<div class="field"><label>Daerah</label><input type="text" name="daerah" value="{{ old('daerah',$item->daerah) }}" required></div>
<div class="field"><label>Deskripsi</label><textarea name="deskripsi" required>{{ old('deskripsi',$item->deskripsi) }}</textarea></div>
<div class="grid cols-2"><div class="field"><label>Upload Gambar</label><input type="file" name="gambar_file" accept="image/*"></div>
<div class="field"><label>atau Path Gambar</label><input type="text" name="gambar" value="{{ old('gambar',$item->gambar) }}"></div></div>
@if($item->gambar)<p class="muted">Saat ini: <img class="thumb" src="{{ asset($item->gambar) }}" alt=""></p>@endif
<div class="field"><label>URL Tour (opsional, kosong = "Menyusul")</label><input type="text" name="tour_url" value="{{ old('tour_url',$item->tour_url) }}"></div>
<div class="grid cols-2"><div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div>
<div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true)?'checked':'' }}> Aktif</label></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
