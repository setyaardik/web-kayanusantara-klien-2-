@extends('admin.layout')
@section('title', ($item->exists?'Edit':'Tambah').' Mitra')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Mitra</h1><a class="btn outline" href="{{ route('admin.mitra.index') }}">Kembali</a></div>
<div class="card"><form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.mitra.update',$item) : route('admin.mitra.store') }}">
@csrf @if($item->exists) @method('PUT') @endif
<div class="field"><label>Nama</label><input type="text" name="nama" value="{{ old('nama',$item->nama) }}" required></div>
<div class="grid cols-2">
  <div class="field"><label>Upload Logo</label><input type="file" name="logo_file" accept="image/*"></div>
  <div class="field"><label>atau Path Logo</label><input type="text" name="logo" value="{{ old('logo',$item->logo) }}" placeholder="assets/img/mitra/nama.webp"></div>
</div>
@if($item->logo)<p class="muted">Saat ini: <img class="thumb" src="{{ asset($item->logo) }}" alt=""> {{ $item->logo }}</p>@endif
<div class="grid cols-2">
  <div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}" min="0"></div>
  <div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true) ? 'checked':'' }}> Aktif</label></div>
</div>
<button class="btn" type="submit">Simpan</button>
</form></div>
@endsection
