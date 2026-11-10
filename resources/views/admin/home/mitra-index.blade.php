@extends('admin.layout')
@section('title','Mitra Kolaborasi')
@section('content')
<div class="admin-top"><h1>Mitra Kolaborasi (Home)</h1><a class="btn" href="{{ route('admin.mitra.create') }}">+ Tambah</a></div>
<div class="card"><table>
<thead><tr><th>Urutan</th><th>Logo</th><th>Nama</th><th>Aktif</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($items as $i)
<tr>
  <td>{{ $i->urutan }}</td>
  <td>@if($i->logo)<img class="thumb" src="{{ asset($i->logo) }}" alt="">@endif</td>
  <td><b>{{ $i->nama }}</b><div class="muted">{{ $i->logo }}</div></td>
  <td>{{ $i->aktif ? 'Ya' : 'Tidak' }}</td>
  <td class="actions">
    <a class="btn sm outline" href="{{ route('admin.mitra.edit',$i) }}">Edit</a>
    <form method="POST" action="{{ route('admin.mitra.destroy',$i) }}" onsubmit="return confirm('Hapus mitra ini?')">@csrf @method('DELETE')<button class="btn sm danger" type="submit">Hapus</button></form>
  </td>
</tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
