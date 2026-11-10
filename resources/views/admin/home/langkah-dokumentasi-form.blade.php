@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Dokumentasi')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Dokumentasi</h1><a class="btn outline" href="{{ route('admin.langkah-dokumentasi.index') }}">Kembali</a></div>
<div class="card"><form method="POST" enctype="multipart/form-data" action="{{ $item->exists?route('admin.langkah-dokumentasi.update',$item):route('admin.langkah-dokumentasi.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="grid cols-2"><div class="field"><label>Upload Gambar</label><input type="file" name="gambar_file" accept="image/*"></div>
<div class="field"><label>atau Path Gambar</label><input type="text" name="gambar" value="{{ old('gambar',$item->gambar) }}"></div></div>
@if($item->gambar)<p class="muted">Saat ini: <img class="thumb" src="{{ asset($item->gambar) }}" alt=""></p>@endif
<div class="field"><label>Alt Text</label><input type="text" name="alt" value="{{ old('alt',$item->alt) }}" required></div>
<div class="field"><label>Kelas CSS (untuk layout grid, mis. dok-cover, dok-pengantar, dok-hak, dok-keg1, dok-keg2)</label><input type="text" name="kelas" value="{{ old('kelas',$item->kelas) }}"></div>
<div class="grid cols-2"><div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div>
<div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true)?'checked':'' }}> Aktif</label></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
