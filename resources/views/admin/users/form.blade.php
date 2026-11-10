@extends('admin.layout')
@section('title',($item->exists?'Edit':'Tambah').' User')
@section('content')
<div class="admin-top"><h1>{{ $item->exists?'Edit':'Tambah' }} User</h1><a class="btn outline" href="{{ route('admin.users.index') }}">Kembali</a></div>
<div class="card"><form method="POST" action="{{ $item->exists?route('admin.users.update',$item):route('admin.users.store') }}">@csrf @if($item->exists) @method('PUT') @endif
<div class="grid cols-2"><div class="field"><label>Nama</label><input type="text" name="name" value="{{ old('name',$item->name) }}" required></div>
<div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email',$item->email) }}" required></div></div>
<div class="grid cols-2"><div class="field"><label>Password {{ $item->exists?'(kosongkan jika tidak diubah)':'' }}</label><input type="password" name="password" {{ $item->exists?'':'required' }} minlength="8"></div>
<div class="field"><label>Role</label>
<select name="role" required>
@foreach(['siswa','guru','umkm','admin'] as $r)<option value="{{ $r }}" {{ old('role',$item->role ?? 'siswa')===$r?'selected':'' }}>{{ ucfirst($r) }}</option>@endforeach
</select></div></div>
<div class="grid cols-2"><div class="field"><label>Sekolah</label><input type="text" name="sekolah" value="{{ old('sekolah',$item->sekolah) }}"></div>
<div class="field"><label>Kelas</label><input type="text" name="kelas" value="{{ old('kelas',$item->kelas) }}"></div></div>
<button class="btn" type="submit">Simpan</button></form></div>
@endsection
