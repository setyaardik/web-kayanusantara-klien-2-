@extends('layouts.main')

@section('title', 'Jelajah Budaya 360° — Kaya Nusantara')

@section('content')

{{--HERO JELAJAH BUDAYA 360 — 1 foto background Museum Sonobudoyo (docx: pembuka, tombol Mulai Tur)--}}
<section class="hero hero-jelajah" id="jelajah-top">
  <div class="hero-bg" aria-hidden="true">
    <div class="hero-slide is-on" style="background-image:url('{{ asset('assets/img/hero-jelajah.webp') }}')"></div>
  </div>
  <div class="container hero-inner">
    <span class="hero-badge">• Eksplorasi Budaya Melalui Panorama 360&deg; dan Tur Virtual</span>

    <h1 class="hero-title">Jelajah Budaya 360&deg;</h1>

    <p class="hero-tagline">JELAJAHI NUSANTARA</p>

    <p class="hero-sub">Mengenal keberagaman budaya Indonesia melalui tujuh unsur kebudayaan, pengalaman visual interaktif, dan perjalanan virtual ke berbagai penjuru Nusantara.</p>

    <div class="hero-actions">
      <a class="btn btn-coklat" href="#visual">Mulai Tur</a>
    </div>
  </div>
</section>

{{--PENGALAMAN VISUAL INTERAKTIF — Museum Sonobudoyo (Canva slide 35); klik tombol -> tour jogja360 (docx)--}}
<section class="visual-section" id="visual">
  <div class="container">
    <div class="visual-head reveal">
      <div>
        <p class="visual-eyebrow">Pengalaman Visual Interaktif</p>
        <h2 class="visual-title">Jelajah Budaya 360&deg;</h2>
      </div>
      <p class="visual-sub">Rasakan pengalaman menjelajahi kekayaan budaya Indonesia melalui panorama dan tur virtual. Klik salah satu destinasi untuk memulai eksplorasi.</p>
    </div>

    <article class="museum-card reveal">
      <div class="museum-img">
        <img src="{{ asset('assets/img/hero-jelajah.webp') }}" alt="Museum Sonobudoyo" loading="lazy">
      </div>
      <div class="museum-body">
        <p class="museum-kicker">Mulai Uji Coba Virtual Tour!</p>
        <h3 class="museum-title">Museum Sonobudoyo</h3>
        <p class="museum-desc">Museum Sonobudoyo di Yogyakarta merupakan museum yang menyimpan beragam koleksi warisan budaya dan sejarah Nusantara, khususnya kebudayaan Jawa. Melalui Jelajah Budaya 360&deg;, pengunjung dapat mengenal berbagai koleksi seperti wayang, keris, batik, senjata tradisional, dan artefak bersejarah sekaligus mempelajari nilai, filosofi, serta tradisi yang menjadi bagian dari kekayaan budaya Indonesia.</p>
        <a class="btn btn-coklat museum-btn" href="https://jogja360.net/virtual-tour/viewer/index.php?code=d9d4f495e875a2e075a1a4a6e1b9770f" target="_blank" rel="noopener">Klik untuk Memulai Tour Museum Sonobudoyo</a>
        <p class="museum-arsip"><img class="museum-arsip-logo" src="{{ asset('assets/img/logo-jogja.webp') }}" alt="Logo Kota Yogyakarta"> Arsip Dinas Kebudayaan Kota Yogyakarta</p>
      </div>
    </article>

    {{--Daftar destinasi 360 — Canva slide 36-37 (masih section Pengalaman Visual Interaktif)--}}
    <div class="destinasi-head reveal">
      <div class="destinasi-title-wrap">
        <p class="destinasi-eyebrow">Mulai Jelajah Budaya 360&deg; bersama</p>
        <h2 class="destinasi-title">Kaya Nusantara</h2>
      </div>
      <form class="unsur-search destinasi-search" id="destinasi-search" onsubmit="return false">
        <input type="search" id="destinasi-q" placeholder="Cari Destinasi Budaya" aria-label="Cari destinasi budaya">
        <button type="submit" class="unsur-search-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          Cari
        </button>
      </form>
    </div>

    <div class="destinasi-grid reveal stagger">
      @php
        $destinasi = [
          ['slug'=>'paresean','nama'=>'Paresean','daerah'=>'Lombok','desk'=>'Peresean adalah tradisi pertarungan seni tari dan adu ketangkasan tradisional khas suku Sasak dari Lombok, Nusa Tenggara Barat.'],
          ['slug'=>'ladosan-dhahar','nama'=>'Ladosan Dhahar','daerah'=>'Yogyakarta','desk'=>'Ladosan Dhahar adalah tradisi jamuan makan ala bangsawan dari Keraton Ngayogyakarta Hadiningrat.'],
          ['slug'=>'lembah-baliem','nama'=>'Lembah Baliem','daerah'=>'Wamena','desk'=>'Festival Budaya Lembah Baliem (FBLB) adalah perayaan budaya tahunan tertua di Papua.'],
          ['slug'=>'wayang-orang','nama'=>'Wayang Orang','daerah'=>'Solo','desk'=>'Wayang Orang Sriwedari adalah salah satu kelompok dan panggung seni pertunjukan teater tradisional Jawa (wayang orang) tertua dan paling legendaris yang berasal dari Kota Surakarta (Solo), Jawa Tengah.'],
          ['slug'=>'pacu-jalur','nama'=>'Pacu Jalur','daerah'=>'Riau','desk'=>'Pacu Jalur adalah tradisi perlombaan dayung perahu panjang tradisional yang berasal dari Kabupaten Kuantan Singingi (Kuansing), Provinsi Riau.'],
          ['slug'=>'tari-kecak','nama'=>'Tari Kecak Uluwatu','daerah'=>'Bali','desk'=>'Tari Kecak Uluwatu adalah salah satu atraksi budaya paling ikonik di Bali yang memadukan tarian tradisional, epos Ramayana, dan pemandangan matahari terbenam (sunset) di atas Samudra Hindia.'],
        ];
      @endphp
      @foreach ($destinasi as $d)
      <article class="destinasi-card" data-nama="{{ strtolower($d['nama'].' '.$d['daerah']) }}">
        <div class="destinasi-img">
          <img src="{{ asset('assets/img/destinasi/'.$d['slug'].'.webp') }}" alt="{{ $d['nama'] }}" loading="lazy">
        </div>
        <div class="destinasi-body">
          <div class="destinasi-row">
            <h3>{{ $d['nama'] }}</h3>
            <span>{{ $d['daerah'] }}</span>
          </div>
          <p>{{ $d['desk'] }}</p>
          <a class="btn btn-coklat destinasi-btn" href="#" title="Menyusul">Klik untuk Memulai Tour</a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

{{--TIPS BELAJAR LEBIH DEKAT — Canva slide 38--}}
<section class="tips-section" id="tips">
  <div class="container">
    <p class="unsur-eyebrow reveal">Tips Belajar Lebih Dekat</p>
    <h2 class="unsur-title reveal">Bukan sekadar melihat, tetapi memahami</h2>
    <p class="unsur-sub reveal">Setiap destinasi menyimpan pengetahuan tentang cara hidup, kepercayaan, teknologi, seni, dan nilai masyarakat. Jelajah virtual membantu kamu mengamati warisan budaya dari sudut pandang yang lebih dekat.</p>

    <div class="tips-grid reveal stagger">
      <article class="tips-card">
        <h3><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Amati detail</h3>
        <p>Perhatikan bentuk bangunan, motif, warna, bahan, serta ornamen pada setiap objek budaya. Amati keunikan dan perbedaannya untuk memahami ciri khas serta keterampilan masyarakat setempat.</p>
      </article>
      <article class="tips-card">
        <h3><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Tambah wawasan</h3>
        <p>Bacalah informasi mengenai sejarah, fungsi, filosofi, dan nilai budaya dari setiap objek. Hubungkan pengetahuan tersebut dengan kehidupan masyarakat agar kamu memahami makna di balik tradisi.</p>
      </article>
      <article class="tips-card">
        <h3><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Jelajahi daerah</h3>
        <p>Kenali berbagai wilayah Indonesia melalui rumah adat, museum, kampung tradisional, dan bangunan bersejarah. Bandingkan keunikan setiap daerah untuk menemukan kekayaan dan keberagaman budaya Nusantara.</p>
      </article>
      <article class="tips-card">
        <h3><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Jaga warisan</h3>
        <p>Hargai dan pelajari budaya sebagai identitas bangsa. Tunjukkan kepedulian dengan menjaga peninggalan sejarah, menghormati tradisi setempat, serta ikut memperkenalkan kekayaan budaya kepada generasi berikutnya.</p>
      </article>
    </div>
  </div>
</section>

{{--AGENDA KAYA NUSANTARA — Kalender Budaya Indonesia (Canva slide 39-50, satu section interaktif)--}}
<section class="agenda-section" id="agenda">
  <div class="container">
    <div class="agenda-head reveal">
      <p class="agenda-eyebrow">Agenda Kaya Nusantara</p>
      <h2>Kalender Budaya Indonesia</h2>
      <p class="agenda-sub">Kenali perayaan, festival, dan tradisi dari berbagai daerah.</p>
      <p class="agenda-pilih">Pilih bulan untuk melihat agenda 2027</p>
    </div>

    <div class="agenda-months reveal" role="tablist">
      @php
        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
      @endphp
      @foreach ($bulan as $b)
        <button class="agenda-chip {{ $b === 'Januari' ? 'is-active' : '' }}" data-bulan="{{ $b }}">{{ strtoupper($b) }}</button>
      @endforeach
    </div>

    <div class="agenda-panel reveal">
      <span class="agenda-badge" id="agenda-badge">JANUARI</span>
      <div class="agenda-empty" id="agenda-empty">
        <p class="agenda-empty-title">Belum ada agenda pilihan untuk bulan ini.</p>
        <p>Kalender dapat dilengkapi dengan festival dan tradisi dari daerah lainnya.</p>
      </div>
      @foreach ($bulan as $i => $b)
        @foreach (($agendaPerBulan[$i + 1] ?? collect()) as $a)
        <div class="agenda-item" data-bulan="{{ $b }}" hidden>
          <p class="agenda-kat">{{ $a->kategori }}</p>
          <p class="agenda-nama">{{ $a->nama }}</p>
          <p class="agenda-tgl">{{ $a->tanggal_label }}</p>
          <p class="agenda-desk">{{ $a->deskripsi }}</p>
        </div>
        @endforeach
      @endforeach
      <p class="agenda-note">Jadwal festival dan upacara adat dapat berubah setiap tahun mengikuti kalender lokal, kondisi daerah, dan keputusan penyelenggara. Periksa informasi resmi sebelum berkunjung.</p>
    </div>
  </div>
</section>

@endsection
