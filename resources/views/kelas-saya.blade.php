@extends('layouts.lms')

@section('lms-title', 'Kelas Saya')

@php $activeMenu = 'kelas-saya'; @endphp

@section('lms-content')
<div class="lms-chips">
  <button class="lms-chip is-active" data-status="semua">Semua Materi</button>
  <button class="lms-chip" data-status="belum">Belum Dipelajari</button>
  <button class="lms-chip" data-status="sedang">Sedang Dipelajari</button>
  <button class="lms-chip" data-status="selesai">Selesai</button>
</div>

<div class="lms-cards">
  @foreach ($list as $u)
  <article class="lms-materi" data-status="{{ $u->status }}" data-nama="{{ strtolower($u->nama) }}">
    <div class="lms-materi-img"><img src="{{ asset('assets/img/materi/'.$u->slug.'.webp') }}" alt="{{ $u->nama }}" loading="lazy"></div>
    <span class="unsur-tag">{{ strtoupper($u->nama) }}</span>
    <p>{{ $u->ringkasan }}</p>
    <div class="bar"><i style="width:{{ $u->persen }}%"></i></div>
    <div class="dash-row">
      <button type="button" class="lms-buka" data-materi="{{ $u->slug }}">Buka &gt;</button>
      <span class="lms-status {{ $u->status }}">{{ $u->status === 'selesai' ? 'Selesai' : ($u->status === 'sedang' ? 'Sedang Dipelajari' : 'Belum Dipelajari') }}</span>
    </div>
  </article>
  @endforeach
</div>
<p class="lms-empty" id="kelasEmpty" hidden>Tidak ada materi dengan status ini.</p>

{{-- Pop-up materi per unsur (isi dari data unsur) --}}
<div class="unsur-modal" id="materi-modal" hidden role="dialog" aria-modal="true">
  <div class="lms-materi-dialog">
    <button class="lms-materi-close" id="materi-close" type="button" aria-label="Tutup">&times;</button>
    <img id="materi-img" src="" alt="">
    <div class="lms-materi-body">
      <span class="unsur-tag" id="materi-judul"></span>
      <p id="materi-desk"></p>
      <div class="unsur-aktivitas lms-materi-isinya">
        <h4>Materi Pembelajaran</h4>
        <div id="materi-list-items"></div>
        <p id="materi-list-empty" style="display:none">Belum ada materi untuk unsur ini.</p>
      </div>
      <form method="POST" action="" id="materi-form">
        @csrf
        <button class="btn btn-coklat lms-mengerti" type="submit">Mengerti, tandai selesai</button>
      </form>
    </div>
  </div>
</div>

<script type="application/json" id="materi-data">
{!! json_encode($list->mapWithKeys(fn ($u) => [
  $u->slug => [
    'id' => $u->id,
    'nama' => $u->nama,
    'desk' => $u->deskripsi ?? $u->ringkasan,
    'persen' => $u->persen,
    'materi' => ($materi[$u->id] ?? collect())->map(fn ($m) => [
      'judul' => $m->judul,
      'rangkuman' => $m->rangkuman ?? $m->isi ?? '',
      'kelas' => $m->kelas ? ($m->kelas->tingkat . ' - ' . $m->kelas->nama) : 'Semua Kelas',
      'submateri' => (int)($m->submateri_count ?? 0),
    ])->values()->all(),
  ]
])->all(), JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
