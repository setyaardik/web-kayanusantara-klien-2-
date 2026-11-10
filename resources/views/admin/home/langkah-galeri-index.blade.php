@extends('admin.layout')
@section('title','Langkah - Galeri')
@section('content')
<div class="admin-top"><h1>Langkah Strategis: Galeri Karya</h1><a class="btn" href="{{ route('admin.langkah-galeri.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Judul</th><th>URL</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td><b>{{ $i->judul }}</b>@if($i->subjudul)<div class="muted">{{ $i->subjudul }}</div>@endif</td><td class="muted">{{ Str::limit($i->url,50) }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.langkah-galeri.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.langkah-galeri.destroy',$i) }}" onsubmit="return confirm('Hapus item ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
