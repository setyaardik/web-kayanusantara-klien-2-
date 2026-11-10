@extends('admin.layout')
@section('title','Users')
@section('content')
<div class="admin-top"><h1>Akun Users</h1><a class="btn" href="{{ route('admin.users.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Sekolah / Kelas</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->id }}</td><td><b>{{ $i->name }}</b></td><td class="muted">{{ $i->email }}</td><td>{{ $i->role }}</td><td class="muted">{{ $i->sekolah }} {{ $i->kelas }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.users.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.users.destroy',$i) }}" onsubmit="return confirm('Hapus user ini?')">@csrf @method('DELETE')<button class="btn sm danger" {{ $i->id===auth()->id()?'disabled':'' }}>Hapus</button></form></td></tr>
@empty<tr><td colspan="6" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
