@extends('admin.layout')
@section('title','Berita')
@section('content')
<div class="admin-top"><h1>Berita Terbaru (Selasar)</h1><a class="btn" href="{{ route('admin.berita.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Gambar</th><th>Judul</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td>@if($i->gambar)<img class="thumb" src="{{ asset($i->gambar) }}" alt="">@endif</td>
<td><b>{{ Str::limit($i->judul,70) }}</b><div class="muted">{{ Str::limit($i->url,50) }}</div></td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.berita.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.berita.destroy',$i) }}" onsubmit="return confirm('Hapus berita ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
