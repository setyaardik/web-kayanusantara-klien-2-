@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Berita')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Berita</h1><a class="btn outline" href="{{ route('admin.berita.index') }}">Kembali</a></div>
<div class="card"><form method="POST" enctype="multipart/form-data" action="{{ $item->exists?route('admin.berita.update',$item):route('admin.berita.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="field"><label>Judul</label><input type="text" name="judul" value="{{ old('judul',$item->judul) }}" required></div>
<div class="field"><label>Ringkasan / Excerpt</label><textarea name="excerpt" required>{{ old('excerpt',$item->excerpt) }}</textarea></div>
<div class="grid cols-2"><div class="field"><label>Upload Gambar</label><input type="file" name="gambar_file" accept="image/*"></div>
<div class="field"><label>atau Path Gambar</label><input type="text" name="gambar" value="{{ old('gambar',$item->gambar) }}"></div></div>
@if($item->gambar)<p class="muted">Saat ini: <img class="thumb" src="{{ asset($item->gambar) }}" alt=""></p>@endif
<div class="field"><label>URL Artikel</label><input type="text" name="url" value="{{ old('url',$item->url) }}" required></div>
<div class="grid cols-2"><div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div>
<div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true)?'checked':'' }}> Aktif</label></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
