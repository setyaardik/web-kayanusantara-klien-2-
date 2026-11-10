@extends('admin.layout')
@section('title','Toko Produk')
@section('content')
<div class="admin-top"><h1>Toko Kaya Nusantara (Selasar)</h1><a class="btn" href="{{ route('admin.toko.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Urutan</th><th>Gambar</th><th>Judul</th><th>Harga</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>
@forelse($items as $i)
<tr><td>{{ $i->urutan }}</td><td>@if($i->gambar)<img class="thumb" src="{{ asset($i->gambar) }}" alt="">@endif</td>
<td><b>{{ Str::limit($i->judul,60) }}</b><div class="muted">{{ Str::limit($i->penulis,50) }}</div></td><td>{{ $i->harga }}</td><td>{{ $i->aktif?'Ya':'Tidak' }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.toko.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.toko.destroy',$i) }}" onsubmit="return confirm('Hapus produk ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="6" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
