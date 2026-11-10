@extends('admin.layout')
@section('title','Langkah - Dokumentasi')
@section('content')
<div class="admin-top"><h1>Langkah Strategis: Dokumentasi</h1><a class="btn" href="{{ route('admin.langkah-dokumentasi.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Gambar</th><th>Alt</th><th>Kelas CSS</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td>@if($i->gambar)<img class="thumb" src="{{ asset($i->gambar) }}" alt="">@endif</td><td>{{ Str::limit($i->alt,60) }}</td><td class="muted">{{ $i->kelas }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.langkah-dokumentasi.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.langkah-dokumentasi.destroy',$i) }}" onsubmit="return confirm('Hapus dokumentasi ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="6" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
