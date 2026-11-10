@extends('admin.layout')
@section('title','Langkah - Publikasi')
@section('content')
<div class="admin-top"><h1>Langkah Strategis: Publikasi Ilmiah</h1><a class="btn" href="{{ route('admin.langkah-publikasi.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Judul</th><th>URL</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td><b>{{ Str::limit($i->judul,90) }}</b></td><td class="muted">{{ Str::limit($i->url,45) }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.langkah-publikasi.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.langkah-publikasi.destroy',$i) }}" onsubmit="return confirm('Hapus publikasi ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
