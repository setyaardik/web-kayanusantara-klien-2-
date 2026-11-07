@extends('layouts.main')

@section('title', 'Selasar Budaya — Kaya Nusantara')

@section('content')

{{--HERO SELASAR BUDAYA — auto-slide 3 foto (sesuai Canva slide 14)--}}
<section class="hero hero-selasar" id="selasar-top">
  <div class="hero-bg" aria-hidden="true">
    <div class="hero-slide is-on" style="background-image:url('{{ asset('assets/img/hero-selasar/sb1.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero-selasar/sb2.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero-selasar/sb3.webp') }}')"></div>
  </div>
  <div class="container hero-inner">
    <span class="hero-badge">Belajar Budaya, Mengenal Identitas, Melestarikan Warisan Bangsa</span>

    <h1 class="hero-title">Selasar Budaya</h1>

    <p class="hero-tagline">Jelajahi Nusantara</p>

    <p class="hero-sub">Indonesia menyimpan kekayaan budaya yang luar biasa. Mari mengenal tujuh unsur kebudayaan, memahami nilai-nilai di baliknya, dan menjaga warisan bangsa untuk generasi mendatang.</p>

    <div class="hero-actions">
      <a class="btn btn-coklat" href="#unsur">Jelajahi 7 Unsur</a>
      <a class="btn btn-cream" href="#kuis">Coba Kuis Budaya</a>
    </div>
  </div>
</section>

{{--PELAJARI 7 UNSUR KEBUDAYAAN — sesuai Canva slide 17-18, filter kategori, TANPA pelajari selengkapnya/login (nanti)--}}
<section class="unsur-section" id="unsur">
  <div class="container">
    <p class="unsur-eyebrow reveal">Selasar Budaya</p>
    <h2 class="unsur-title reveal">Pelajari Tujuh Unsur Kebudayaan</h2>
    <p class="unsur-sub reveal">Kenali unsur-unsur pembentuk kehidupan masyarakat Indonesia. Pilih salah satu kategori untuk membaca materi, contoh, dan nilai budayanya.</p>

    <form class="unsur-search" id="unsur-search" onsubmit="return false">
      <input type="search" id="unsur-q" placeholder="Cari Unsur Kebudayaan" aria-label="Cari unsur kebudayaan">
      <button type="submit" class="unsur-search-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        Cari
      </button>
    </form>

    <div class="unsur-filter" role="tablist">
      <button class="unsur-chip is-active" data-filter="semua">Semua Unsur</button>
      <button class="unsur-chip" data-filter="sosial">Kehidupan Sosial</button>
      <button class="unsur-chip" data-filter="pengetahuan">Pengetahuan</button>
      <button class="unsur-chip" data-filter="karya">Karya dan Ekspresi</button>
    </div>

    <div class="unsur-grid reveal stagger">
      @php
        $unsur = [
          ['slug'=>'bahasa','nama'=>'Bahasa','kat'=>'sosial','desk'=>'Alat komunikasi, identitas, dan pewarisan pengetahuan.'],
          ['slug'=>'sistem-pengetahuan','nama'=>'Sistem Pengetahuan','kat'=>'pengetahuan','desk'=>'Pengetahuan masyarakat tentang alam dan kehidupan.'],
          ['slug'=>'organisasi-sosial','nama'=>'Organisasi Sosial','kat'=>'sosial','desk'=>'Hubungan kekerabatan dan tata kehidupan masyarakat.'],
          ['slug'=>'peralatan-hidup-dan-teknologi','nama'=>'Peralatan Hidup dan Teknologi','kat'=>'karya','desk'=>'Alat, rumah, pakaian, dan teknologi tradisional.'],
          ['slug'=>'mata-pencaharian','nama'=>'Mata Pencaharian','kat'=>'sosial','desk'=>'Cara masyarakat memenuhi kebutuhan hidup.'],
          ['slug'=>'sistem-religi','nama'=>'Sistem Religi','kat'=>'pengetahuan','desk'=>'Kepercayaan, nilai spiritual, dan tradisi masyarakat.'],
          ['slug'=>'kesenian','nama'=>'Kesenian','kat'=>'karya','desk'=>'Ekspresi keindahan melalui seni dan pertunjukan.'],
        ];
      @endphp
      @foreach ($unsur as $u)
      <article class="unsur-card" data-kat="{{ $u['kat'] }}">
        <div class="unsur-card-img">
          <img src="{{ asset('assets/img/unsur/'.$u['slug'].'.webp') }}" alt="{{ $u['nama'] }}" loading="lazy">
        </div>
        <div class="unsur-card-body">
          <span class="unsur-tag">{{ $u['nama'] }}</span>
          <p>{{ $u['desk'] }}</p>
          <a class="unsur-more" href="#unsur" data-unsur="{{ $u['slug'] }}">Pelajari Selengkapnya &gt;</a>
        </div>
      </article>
      @endforeach
    </div>

    {{--PEMBELAJARAN BERMAKNA — bagian dari section Pelajari 7 Unsur (Canva p18); popup materi & login: isi menyusul--}}
    <div class="bermakna-box reveal" id="bermakna">
      <div class="bermakna-text">
        <p class="bermakna-eyebrow">Pembelajaran Bermakna</p>
        <h2 class="bermakna-title">Budaya bukan sekadar warisan, tetapi identitas yang hidup.</h2>
        <p class="bermakna-desc">Setiap unsur kebudayaan menyimpan pengetahuan, nilai, dan cara hidup masyarakat. Pelajari keberagamannya dengan pikiran terbuka dan rasa ingin tahu. Materi disusun berdasarkan tujuh unsur kebudayaan, contoh budaya dari berbagai wilayah Indonesia, serta belajar melalui teks, ilustrasi, dan aktivitas.</p>
        @auth
          <a class="btn btn-coklat bermakna-btn" href="#unsur">
            Halo, {{ auth()->user()->name }} — Mulai Belajar
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6z"/></svg>
          </a>
        @else
          <a class="btn btn-coklat bermakna-btn" href="{{ route('login') }}?redirect={{ urlencode(url('/selasar-budaya#bermakna')) }}">
            Login untuk Belajar bersama Kaya Nusantara
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6 8-6s8 2 8 6z"/></svg>
          </a>
        @endauth
      </div>
      <div class="bermakna-img">
        <img class="bermakna-foto" src="{{ asset('assets/img/bermakna.webp') }}" alt="Ladosan Dhahar Yogyakarta">
        <img class="bermakna-logo" src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaya Nusantara">
      </div>
    </div>
  </div>
</section>

{{--PENGALAMAN BELAJAR — section sendiri (Canva p26: 6 kartu langkah belajar)--}}
<section class="pengalaman-section" id="pengalaman">
  <div class="container">
    <p class="unsur-eyebrow reveal">Pengalaman Belajar</p>
    <h2 class="unsur-title reveal">Belajar dengan cara yang menyenangkan</h2>
    <p class="unsur-sub reveal">Setiap materi mengajak kamu mengenal, memahami, mengamati, dan merefleksikan kebudayaan Indonesia.</p>

    <div class="pengalaman-grid reveal stagger">
      @php
        $pengalaman = [
          ['ikon'=>'M12 2l2.4 7.2H22l-6 4.6 2.3 7.2-6.3-4.5-6.3 4.5L8 13.8 2 9.2h7.6z','judul'=>'Kenali Konsepnya','desk'=>'Pahami pengertian, ciri-ciri, fungsi, dan peran setiap unsur kebudayaan dalam kehidupan masyarakat.'],
          ['ikon'=>'M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z','judul'=>'Lihat Contoh Budaya','desk'=>'Amati contoh kebudayaan dari berbagai daerah melalui foto, ilustrasi, dan dokumentasi.'],
          ['ikon'=>'M12 3l9 8-9 10-9-10z','judul'=>'Pahami Nilai Budaya','desk'=>'Temukan nilai kebersamaan, kearifan lokal, kreativitas, dan identitas dalam setiap budaya.'],
          ['ikon'=>'M12 2a10 10 0 100 20 10 10 0 000-20zM3 12h18M12 3c3 3.5 3 14.5 0 18M12 3c-3 3.5-3 14.5 0 18','judul'=>'Jelajahi Keberagaman','desk'=>'Bandingkan tradisi dan praktik budaya antardaerah tanpa mengabaikan konteks lokalnya.'],
          ['ikon'=>'M17 3l4 4-11 11H6v-4zM14 6l4 4','judul'=>'Buat Karya','desk'=>'Tuangkan pemahaman melalui ringkasan, artikel, poster, wawancara, atau dokumentasi budaya.'],
          ['ikon'=>'M9 11l3 3 8-8M21 12a9 9 0 11-6-8.5','judul'=>'Uji Pemahaman','desk'=>'Kerjakan kuis singkat untuk mengingat kembali materi yang telah dipelajari.'],
        ];
      @endphp
      @foreach ($pengalaman as $p)
      <article class="pengalaman-card">
        <h3>
          <span class="pengalaman-ikon" aria-hidden="true">
            <img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="" loading="lazy">
          </span>
          {{ $p['judul'] }}
        </h3>
        <p>{{ $p['desk'] }}</p>
      </article>
      @endforeach
    </div>
  </div>
</section>

{{--UJI PENGETAHUANMU — satu section kuis interaktif 5 soal (Canva p27-31)--}}
<section class="kuis-section" id="kuis">
  <div class="container">
    <p class="kuis-eyebrow reveal">Uji Pengetahuanmu</p>
    <h2 class="kuis-title reveal">Seberapa kenal kamu dengan budaya Nusantara?</h2>
    <p class="kuis-sub reveal">Jawab pertanyaan singkat berikut. Kenali jawaban yang benar dan pelajari penjelasannya.</p>

    <div class="kuis-card reveal" id="kuis-card">
      <p class="kuis-meta">KUIS BUDAYA • <span id="kuis-now">1</span>/5</p>
      <h3 class="kuis-q" id="kuis-q"></h3>
      <div class="kuis-opts" id="kuis-opts"></div>
      <p class="kuis-expl" id="kuis-expl" hidden></p>
      <button class="kuis-next" id="kuis-next" type="button" hidden></button>
    </div>

    <div class="kuis-card kuis-result" id="kuis-result" hidden>
      <p class="kuis-meta">KUIS BUDAYA • SELESAI</p>
      <h3 class="kuis-q" id="kuis-score"></h3>
      <p class="kuis-expl" id="kuis-msg"></p>
      <button class="kuis-next" id="kuis-retry" type="button">Ulangi Kuis</button>
    </div>

    <script type="application/json" id="kuis-data">
    [
      {"q":"Apa fungsi utama bahasa dalam kehidupan masyarakat?","opts":["Sebagai alat komunikasi dan pewaris pengetahuan","Hanya sebagai hiburan","Sebagai alat pertanian","Sebagai bangunan tradisional"],"a":0,"e_tepat":"Tepat! Bahasa memungkinkan manusia berkomunikasi, menyampaikan gagasan, dan mewariskan pengetahuan serta nilai budaya.","e":"Belum tepat. Bahasa memungkinkan manusia berkomunikasi, menyampaikan gagasan, dan mewariskan pengetahuan serta nilai budaya."},
      {"q":"Gotong royong termasuk contoh unsur kebudayaan apa?","opts":["Kesenian","Organisasi sosial","Sistem religi","Peralatan hidup"],"a":1,"e_tepat":"Tepat! Gotong royong merupakan bentuk kerja sama dan hubungan sosial dalam kehidupan masyarakat.","e":"Belum tepat. Gotong royong merupakan bentuk kerja sama dan hubungan sosial dalam kehidupan masyarakat."},
      {"q":"Rumah adat dan perahu tradisional termasuk unsur...","opts":["Bahasa","Sistem pengetahuan","Peralatan hidup dan teknologi","Sistem religi"],"a":2,"e_tepat":"Tepat! Rumah dan perahu merupakan hasil ciptaan manusia untuk memenuhi kebutuhan hidup.","e":"Belum tepat. Rumah dan perahu merupakan hasil ciptaan manusia untuk memenuhi kebutuhan hidup."},
      {"q":"Pengetahuan mengenai musim tanam termasuk...","opts":["Sistem pengetahuan","Organisasi sosial","Kesenian","Bahasa"],"a":0,"e_tepat":"Tepat! Pengetahuan tentang musim tanam merupakan pengetahuan lokal dalam memahami alam dan lingkungan.","e":"Belum tepat. Pengetahuan tentang musim tanam merupakan pengetahuan lokal dalam memahami alam dan lingkungan."},
      {"q":"Tari tradisional, wayang, dan musik daerah termasuk unsur...","opts":["Mata pencaharian","Sistem religi","Organisasi sosial","Kesenian"],"a":3,"e_tepat":"Tepat! Tari, wayang, dan musik merupakan bentuk ekspresi seni masyarakat.","e":"Belum tepat. Tari, wayang, dan musik merupakan bentuk ekspresi seni masyarakat."}
    ]
    </script>
  </div>
</section>

{{--KENALI • PELAJARI • LESTARIKAN — CTA penutup (Canva p32); footer di layout--}}
<section class="lestarikan-section" id="lestarikan">
  <div class="container">
    <div class="lestarikan-box reveal">
      <p class="bermakna-eyebrow">Kenali • Pelajari • Lestarikan</p>
      <h2 class="lestarikan-title">Budaya Indonesia adalah kekayaan kita bersama</h2>
      <p class="lestarikan-sub">Mulailah dari mengenal budaya di sekitarmu, lalu bagikan pengetahuan itu kepada generasi berikutnya.</p>
      <a class="btn btn-coklat lestarikan-btn" href="#unsur">Kembali Jelajahi 7 Unsur Kebudayaan &gt;</a>
    </div>
  </div>
</section>

{{--POP-UP PELAJARI SELENGKAPNYA — materi per unsur sesuai Canva p19-25--}}
<div class="unsur-modal" id="unsur-modal" data-base="{{ asset('') }}" hidden role="dialog" aria-modal="true" aria-labelledby="unsur-modal-judul">
  <div class="unsur-dialog">
    <button class="unsur-close" id="unsur-close" type="button" aria-label="Tutup">&times;</button>
    <div class="unsur-dialog-head">
      <img id="unsur-modal-img" src="" alt="">
      <div class="unsur-dialog-intro">
        <span class="unsur-tag" id="unsur-modal-judul"></span>
        <p id="unsur-modal-desk"></p>
      </div>
    </div>
    <hr class="unsur-div">
    <div class="unsur-block">
      <h4><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Fungsi dalam kehidupan</h4>
      <p id="unsur-modal-fungsi"></p>
    </div>
    <div class="unsur-block">
      <h4><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Contoh di Indonesia</h4>
      <p id="unsur-modal-contoh"></p>
    </div>
    <div class="unsur-block">
      <h4><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt=""> Nilai budaya</h4>
      <p id="unsur-modal-nilai"></p>
    </div>
    <div class="unsur-aktivitas">
      <h4>Aktivitas Belajar</h4>
      <p id="unsur-modal-aktivitas"></p>
    </div>
  </div>
</div>

<script type="application/json" id="unsur-detail">
{
  "bahasa": {"nama":"Bahasa","desk":"Bahasa adalah alat komunikasi yang digunakan masyarakat untuk menyampaikan gagasan, menyimpan pengetahuan, serta mewariskan nilai budaya dari satu generasi ke generasi berikutnya.","fungsi":"Bahasa berfungsi sebagai alat komunikasi, identitas kelompok, sarana pewarisan pengetahuan, serta media penyampaian nilai dan tradisi dari satu generasi ke generasi berikutnya.","contoh":"Bahasa Jawa, Sunda, Batak, Bugis, Dani, Mee, Asmat, dan berbagai bahasa daerah lainnya. Indonesia juga memiliki bahasa Indonesia sebagai bahasa persatuan.","nilai":"Bahasa daerah menyimpan cara pandang, pengetahuan lokal, cerita lisan, dan identitas masyarakat. Melestarikannya berarti menjaga salah satu sumber kekayaan bangsa.","aktivitas":"Cari lima kosakata bahasa daerah dari keluargamu atau lingkungan sekitar. Tuliskan arti dan contoh penggunaannya."},
  "sistem-pengetahuan": {"nama":"Sistem Pengetahuan","desk":"Sistem pengetahuan merupakan kumpulan pengetahuan yang dimiliki dan dikembangkan masyarakat untuk memahami lingkungan serta menjalani kehidupan.","fungsi":"Pengetahuan membantu masyarakat mengenali alam, mengelola sumber daya, menjaga kesehatan, membaca tanda-tanda lingkungan, dan menyelesaikan persoalan sehari-hari.","contoh":"Pengetahuan tentang musim tanam, pengobatan tradisional, navigasi laut, astronomi, pengolahan pangan, dan pemanfaatan tanaman lokal.","nilai":"Pengetahuan lokal menunjukkan hubungan manusia dengan alam dan pengalaman yang diwariskan antargenerasi. Pengetahuan tersebut dapat dipelajari berdampingan dengan ilmu pengetahuan modern.","aktivitas":"Wawancarai anggota keluarga tentang satu pengetahuan lokal yang masih digunakan hingga sekarang."},
  "organisasi-sosial": {"nama":"Organisasi Sosial","desk":"Organisasi sosial merupakan sistem hubungan dan aturan yang mengatur kehidupan bersama, termasuk kekerabatan, kelompok masyarakat, serta lembaga sosial.","fungsi":"Organisasi sosial mengatur peran dan tanggung jawab, menjaga keteraturan, membangun solidaritas, serta membantu masyarakat bekerja sama.","contoh":"Gotong royong, musyawarah, sistem kekerabatan, kelompok adat, lembaga masyarakat, dan struktur kepemimpinan adat.","nilai":"Nilai kebersamaan, tanggung jawab, saling menghormati, dan kepedulian menjadi bagian penting dalam kehidupan sosial masyarakat Indonesia.","aktivitas":"Amati kegiatan gotong royong di lingkunganmu. Catat siapa saja yang terlibat dan bagaimana mereka bekerja sama."},
  "peralatan-hidup-dan-teknologi": {"nama":"Peralatan Hidup dan Teknologi","desk":"Unsur ini mencakup benda, alat, dan teknologi yang diciptakan atau digunakan manusia untuk memenuhi kebutuhan hidup.","fungsi":"Peralatan dan teknologi membantu manusia membangun tempat tinggal, menghasilkan makanan, berpakaian, bepergian, dan melakukan berbagai pekerjaan.","contoh":"Rumah Gadang, Tongkonan, Honai, perahu tradisional, alat pertanian, tenun, gerabah, dan berbagai peralatan rumah tangga.","nilai":"Benda budaya memperlihatkan kreativitas, kemampuan beradaptasi, dan pengetahuan teknis masyarakat sesuai kondisi lingkungan mereka.","aktivitas":"Pilih satu benda tradisional. Gambarkan bentuknya, jelaskan fungsi, bahan, dan cara pembuatannya."},
  "mata-pencaharian": {"nama":"Mata Pencaharian","desk":"Sistem mata pencaharian hidup merupakan cara masyarakat memperoleh penghasilan dan memenuhi kebutuhan hidup melalui berbagai kegiatan ekonomi.","fungsi":"Kegiatan mata pencaharian menyediakan kebutuhan pangan dan barang, menggerakkan perekonomian, serta membentuk hubungan manusia dengan lingkungan.","contoh":"Bertani, berkebun, beternak, menangkap ikan, berburu dan meramu, membuat kerajinan, serta berdagang.","nilai":"Mata pencaharian memperlihatkan kemampuan masyarakat memanfaatkan sumber daya alam secara kreatif dan menyesuaikan diri dengan kondisi geografis.","aktivitas":"Dokumentasikan satu pekerjaan tradisional di daerahmu. Jelaskan alat, proses, dan hasil yang diperoleh."},
  "sistem-religi": {"nama":"Sistem Religi","desk":"Sistem religi berkaitan dengan kepercayaan, keyakinan, praktik spiritual, serta hubungan manusia dengan hal-hal yang dianggap suci atau sakral.","fungsi":"Sistem religi dapat menjadi pedoman kehidupan, sumber nilai moral, pembentuk solidaritas, serta landasan berbagai tradisi dan upacara masyarakat.","contoh":"Tradisi keagamaan, upacara adat yang berkaitan dengan kepercayaan, tempat ibadah, dan praktik spiritual masyarakat yang beragam.","nilai":"Keberagaman sistem kepercayaan perlu dipahami dengan sikap saling menghormati. Setiap tradisi memiliki konteks dan makna yang perlu dihargai.","aktivitas":"Pelajari satu tradisi keagamaan atau upacara adat melalui sumber yang tepercaya. Jelaskan nilai sosialnya dengan tetap menghormati kesakralannya."},
  "kesenian": {"nama":"Kesenian","desk":"Kesenian merupakan hasil ekspresi kreativitas manusia yang diwujudkan melalui berbagai bentuk karya dan pertunjukan.","fungsi":"Kesenian menjadi sarana ekspresi, hiburan, komunikasi, identitas budaya, pendidikan nilai, serta pewarisan tradisi.","contoh":"Tari Saman, Tari Kecak, wayang kulit, gamelan, angklung, batik, ukiran, tenun, seni sastra, dan musik tradisional.","nilai":"Kesenian memperlihatkan kreativitas dan identitas masyarakat. Karya seni juga dapat menjadi media untuk menyampaikan sejarah, pesan moral, dan pandangan hidup.","aktivitas":"Pilih satu karya seni daerah. Buat poster yang menjelaskan asal, bentuk, fungsi, dan nilai budayanya."}
}
</script>

@endsection
