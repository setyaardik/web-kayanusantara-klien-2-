@extends('admin.layout')
@section('title', ($item->exists?'Edit':'Tambah').' Testimoni')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Testimoni</h1><a class="btn outline" href="{{ route('admin.testimoni.index') }}">Kembali</a></div>
<div class="card"><form method="POST" action="{{ $item->exists ? route('admin.testimoni.update',$item) : route('admin.testimoni.store') }}">
@csrf @if($item->exists) @method('PUT') @endif
<div class="grid cols-2">
  <div class="field"><label>Inisial</label><input type="text" name="inisial" value="{{ old('inisial',$item->inisial) }}" maxlength="10"></div>
  <div class="field"><label>Nama</label><input type="text" name="nama" value="{{ old('nama',$item->nama) }}" required></div>
</div>
<div class="field"><label>Jabatan / Institusi</label><input type="text" name="jabatan" value="{{ old('jabatan',$item->jabatan) }}"></div>
<div class="field"><label>Teks Testimoni</label><textarea name="teks" required style="min-height:140px">{{ old('teks',$item->teks) }}</textarea></div>
<div class="grid cols-2">
  <div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}" min="0"></div>
  <div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true) ? 'checked':'' }}> Aktif</label></div>
</div>
<button class="btn" type="submit">Simpan</button>
</form></div>
@endsection
