@extends('admin.layout')
@section('title', ($item->exists?'Edit':'Tambah').' FAQ')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} FAQ</h1><a class="btn outline" href="{{ route('admin.faq.index') }}">Kembali</a></div>
<div class="card"><form method="POST" action="{{ $item->exists ? route('admin.faq.update',$item) : route('admin.faq.store') }}">
@csrf @if($item->exists) @method('PUT') @endif
<div class="field"><label>Pertanyaan</label><textarea name="pertanyaan" required>{{ old('pertanyaan',$item->pertanyaan) }}</textarea></div>
<div class="field"><label>Jawaban</label><textarea name="jawaban" required style="min-height:160px">{{ old('jawaban',$item->jawaban) }}</textarea></div>
<div class="grid cols-2">
  <div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}" min="0"></div>
  <div class="field"><label>&nbsp;</label><label class="check"><input type="checkbox" name="aktif" value="1" {{ old('aktif',$item->aktif ?? true) ? 'checked':'' }}> Aktif</label></div>
</div>
<button class="btn" type="submit">Simpan</button>
</form></div>
@endsection
