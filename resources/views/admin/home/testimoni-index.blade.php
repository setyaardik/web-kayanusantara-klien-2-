@extends('admin.layout')
@section('title','Testimoni')
@section('content')
<div class="admin-top"><h1>Testimoni (Home)</h1><a class="btn" href="{{ route('admin.testimoni.create') }}">+ Tambah</a></div>
<div class="card"><table>
<thead><tr><th>Urutan</th><th>Nama / Jabatan</th><th>Teks</th><th>Aktif</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($items as $i)
<tr>
  <td>{{ $i->urutan }}</td>
  <td><b>{{ $i->inisial }} — {{ $i->nama }}</b><div class="muted">{{ $i->jabatan }}</div></td>
  <td>{{ Str::limit($i->teks,90) }}</td>
  <td>{{ $i->aktif ? 'Ya' : 'Tidak' }}</td>
  <td class="actions">
    <a class="btn sm outline" href="{{ route('admin.testimoni.edit',$i) }}">Edit</a>
    <form method="POST" action="{{ route('admin.testimoni.destroy',$i) }}" onsubmit="return confirm('Hapus testimoni ini?')">@csrf @method('DELETE')<button class="btn sm danger" type="submit">Hapus</button></form>
  </td>
</tr>
@empty<tr><td colspan="5" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
