@extends('admin.layout')
@section('title','FAQ')
@section('content')
<div class="admin-top"><h1>FAQ (Home)</h1><a class="btn" href="{{ route('admin.faq.create') }}">+ Tambah</a></div>
<div class="card"><table>
<thead><tr><th>Urutan</th><th>Pertanyaan</th><th>Aktif</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($items as $i)
<tr>
  <td>{{ $i->urutan }}</td>
  <td><b>{{ Str::limit($i->pertanyaan,80) }}</b><div class="muted">{{ Str::limit($i->jawaban,100) }}</div></td>
  <td>{{ $i->aktif ? 'Ya' : 'Tidak' }}</td>
  <td class="actions">
    <a class="btn sm outline" href="{{ route('admin.faq.edit',$i) }}">Edit</a>
    <form method="POST" action="{{ route('admin.faq.destroy',$i) }}" onsubmit="return confirm('Hapus FAQ ini?')">@csrf @method('DELETE')<button class="btn sm danger" type="submit">Hapus</button></form>
  </td>
</tr>
@empty<tr><td colspan="4" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
