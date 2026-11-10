@extends('admin.layout')
@section('title','Destinasi 360')
@section('content')
<div class="admin-top"><h1>Destinasi 360 (Jelajah Budaya)</h1><a class="btn" href="{{ route('admin.destinasi.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Gambar</th><th>Nama / Daerah</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td>@if($i->gambar)<img class="thumb" src="{{ asset($i->gambar) }}" alt="">@endif</td>
<td><b>{{ $i->nama }}</b><div class="muted">{{ $i->daerah }}</div></td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.destinasi.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.destinasi.destroy',$i) }}" onsubmit="return confirm('Hapus destinasi ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
