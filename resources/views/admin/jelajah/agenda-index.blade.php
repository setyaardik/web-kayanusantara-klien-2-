@extends('admin.layout')
@section('title','Agenda')
@section('content')
<div class="admin-top"><h1>Agenda / Kalender Budaya (Jelajah 360)</h1><a class="btn" href="{{ route('admin.agenda.create') }}">+ Tambah</a></div>
<div class="card"><table><thead><tr><th>Bulan</th><th>Urutan</th><th>Kategori</th><th>Nama</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
@php $bln=[1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; @endphp
@forelse($items as $i)
<tr><td>{{ $bln[$i->bulan] ?? $i->bulan }}</td><td>{{ $i->urutan }}</td><td>{{ $i->kategori }}</td><td><b>{{ Str::limit($i->nama,50) }}</b></td><td class="muted">{{ $i->tanggal_label }}</td>
<td class="actions"><a class="btn sm outline" href="{{ route('admin.agenda.edit',$i) }}">Edit</a>
<form method="POST" action="{{ route('admin.agenda.destroy',$i) }}" onsubmit="return confirm('Hapus agenda ini?')">@csrf @method('DELETE')<button class="btn sm danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="6" class="muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
