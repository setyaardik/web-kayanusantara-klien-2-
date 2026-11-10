@extends('layouts.main')

@section('title', 'Tim Kaya Nusantara — Kaya Nusantara')

@section('content')

{{-- Hero Tim — auto-slide 3 foto (sama seperti beranda) --}}
<section class="hero hero-tim">
  <div class="hero-bg" aria-hidden="true">
    <div class="hero-slide is-on" style="background-image:url('{{ asset('assets/img/hero/hero-wayang.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-tarikecak.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-pacujalur.webp') }}')"></div>
  </div>
  <div class="container hero-inner">
    <h1 class="hero-title">Meet Our Expert Teams</h1>

    <p class="hero-sub">Kenali, pelajari, dan lestarikan keberagaman budaya Indonesia melalui pengalaman belajar yang interaktif dan menyenangkan.</p>
  </div>
</section>

{{-- Daftar Tim (slide 89-91) --}}
<section class="section tim-section">
  <div class="container">
    @php
      $tim = [
        ['foto' => 'handika-mukti.jpg', 'nama' => 'Handika Mukti, S.Pd.', 'peran' => 'Project Manager'],
        ['foto' => 'harto-wicaksono.jpg', 'nama' => 'Harto Wicaksono, S.Pd., M.A.', 'peran' => 'Researcher and Cultural Curator'],
        ['foto' => 'risa-nurhaliza.jpg', 'nama' => 'Risa Nurhaliza, S.I.Kom.', 'peran' => 'Public Relation'],
        ['foto' => 'setya-ardi-kurniawan.jpeg', 'nama' => 'Setya Ardi Kurniawan, S.Kom.', 'peran' => 'Developer'],
        ['foto' => 'pramudya-akbar-dewangga.jpg', 'nama' => 'Pramudya Akbar Dewangga, S.Pd., M.Pd.', 'peran' => 'Learning Designer / Learning Developer'],
        ['foto' => 'dewi-mukti-sari.jpg', 'nama' => 'Dewi Mukti Sari, S.Pd.', 'peran' => 'Quality Assurance (QA) / Educational Evaluator'],
        ['foto' => 'chairunisa-zeny-puspita.jpg', 'nama' => 'Chairunisa Zeny Puspita, S.Tr.M.', 'peran' => 'Marketing'],
        ['foto' => 'myke-ardianti.jpg', 'nama' => 'Myke Ardianti', 'peran' => 'UI/UX Designer'],
        ['foto' => 'oktario-yudistira.jpg', 'nama' => 'Oktario Yudistira', 'peran' => 'Content Writer'],
      ];
    @endphp

    <div class="tim-grid reveal stagger">
      @foreach ($tim as $anggota)
        <article class="tim-card">
          <div class="tim-photo">
            <img src="{{ asset('assets/img/tim/' . $anggota['foto']) }}" alt="{{ $anggota['nama'] }}" loading="lazy">
          </div>
          <div class="tim-info">
            <h3 class="tim-nama">{{ $anggota['nama'] }}</h3>
            <p class="tim-peran">{{ $anggota['peran'] }}</p>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>

@endsection
