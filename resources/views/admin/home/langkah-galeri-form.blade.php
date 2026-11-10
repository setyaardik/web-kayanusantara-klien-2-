@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Galeri')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Item Galeri</h1><a class="btn outline" href="{{ route('admin.langkah-galeri.index') }}">Kembali</a></div>
<div class="card"><form method="POST" action="{{ $item->exists?route('admin.langkah-galeri.update',$item):route('admin.langkah-galeri.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="field"><label>Judul</label><input type="text" name="judul" value="{{ old('judul',$item->judul) }}" required></div>
<div class="field"><label>Subjudul (opsional, boleh HTML sederhana)</label><input type="text" name="subjudul" value="{{ old('subjudul',$item->subjudul) }}"></div>
<div class="field"><label>URL</label><input type="text" name="url" value="{{ old('url',$item->url) }}" required></div>
<div class="grid cols-3"><div class="field"><label>Label Tombol</label><input type="text" name="label_tombol" value="{{ old('label_tombol',$item->label_tombol ?? 'Lihat') }}"></div>
<div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div>
<div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true)?'checked':'' }}> Aktif</label></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
