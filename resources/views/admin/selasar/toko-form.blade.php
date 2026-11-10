@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Produk')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Produk Toko</h1><a class="btn outline" href="{{ route('admin.toko.index') }}">Kembali</a></div>
<div class="card"><form method="POST" enctype="multipart/form-data" action="{{ $item->exists?route('admin.toko.update',$item):route('admin.toko.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="field"><label>Judul Produk</label><input type="text" name="judul" value="{{ old('judul',$item->judul) }}" required></div>
<div class="field"><label>Detail (satu poin per baris)</label><textarea name="detail_text">{{ old('detail_text', is_array($item->detail)?implode("\n",$item->detail):'') }}</textarea></div>
<div class="grid cols-2"><div class="field"><label>Penulis / Penerbit / Tahun</label><input type="text" name="penulis" value="{{ old('penulis',$item->penulis) }}" required></div>
<div class="field"><label>Harga</label><input type="text" name="harga" value="{{ old('harga',$item->harga) }}" required></div></div>
<div class="grid cols-2"><div class="field"><label>Upload Gambar</label><input type="file" name="gambar_file" accept="image/*"></div>
<div class="field"><label>atau Path Gambar</label><input type="text" name="gambar" value="{{ old('gambar',$item->gambar) }}"></div></div>
@if($item->gambar)<p class="muted">Saat ini: <img class="thumb" src="{{ asset($item->gambar) }}" alt=""></p>@endif
<div class="grid cols-2"><div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div>
<div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true)?'checked':'' }}> Aktif</label></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
