@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' Agenda')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} Agenda</h1><a class="btn outline" href="{{ route('admin.agenda.index') }}">Kembali</a></div>
<div class="card"><form method="POST" action="{{ $item->exists?route('admin.agenda.update',$item):route('admin.agenda.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="grid cols-2"><div class="field"><label>Bulan (1-12)</label>
<select name="bulan" required>@for($m=1;$m<=12;$m++)<option value="{{ $m }}" {{ (int)old('bulan',$item->bulan ?? 1)===$m?'selected':'' }}>{{ [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][$m] }}</option>@endfor</select></div>
<div class="field"><label>Urutan</label><input type="number" name="urutan" value="{{ old('urutan',$item->urutan ?? 0) }}"></div></div>
<div class="field"><label>Kategori</label><input type="text" name="kategori" value="{{ old('kategori',$item->kategori) }}" required></div>
<div class="field"><label>Nama Acara</label><input type="text" name="nama" value="{{ old('nama',$item->nama) }}" required></div>
<div class="field"><label>Label Tanggal</label><input type="text" name="tanggal_label" value="{{ old('tanggal_label',$item->tanggal_label) }}" required placeholder="mis. 15 Februari 2027"></div>
<div class="field"><label>Deskripsi</label><textarea name="deskripsi" required>{{ old('deskripsi',$item->deskripsi) }}</textarea></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
