@extends('layouts.main')

@section('title', 'Kaya Nusantara - Jendela Edukatif Digital Budaya')

@section('content')

{{--HERO — background auto-slide 3 foto budaya (sesuai desain Canva)--}}
<section class="hero" id="beranda">
  <div class="hero-bg" aria-hidden="true">
    <div class="hero-slide is-on" style="background-image:url('{{ asset('assets/img/hero/hero-wayang.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-tarikecak.webp') }}')"></div>
    <div class="hero-slide" style="background-image:url('{{ asset('assets/img/hero/hero-pacujalur.webp') }}')"></div>
  </div>
  <div class="container hero-inner">
    <span class="hero-badge">Belajar Budaya, Mengenal Identitas, Melestarikan Warisan Bangsa</span>

    <h1 class="hero-title">Kaya Nusantara</h1>

    <p class="hero-tagline">Jendela Edukatif Digital<br>Identitas Budaya Nasional</p>

    <p class="hero-sub">Kenali, pelajari, dan lestarikan keberagaman budaya Indonesia melalui pengalaman belajar yang interaktif dan menyenangkan.</p>
  </div>
</section>

{{--JELAJAH NUSANTARA + SEARCH--}}
<section class="section jelajah" id="jelajah">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">Jelajah Nusantara</span>
      <h2>Jelajahi Budaya Indonesia</h2>
    </div>

    <p class="lead">Indonesia merupakan negara yang memiliki kebudayaan yang sangat beragam, kaya, dan unik (dikenal sebagai salah satu negara megadiversity dunia). Yu jelajahi Budaya Indonesia bersama Kaya Nusantara!</p>

    <form class="big-search" id="mainSearch" role="search">
      <input type="search" id="mainSearchInput" placeholder="Cari Budaya Indonesia" aria-label="Cari Budaya Indonesia">
      <button class="btn" type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
          <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Cari
      </button>
    </form>
  </div>
</section>

{{-- ============ LANGKAH STRATEGIS — 2 KOLOM ============ --}}
<section class="section cream" id="selasar">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">Langkah Strategis</span>
      <h2>Langkah Strategis Kaya Nusantara</h2>
      <p>Kaya Nusantara telah teruji melalui PjBL siswa kelas XI SMA Karangturi sejak Oktober 2025, produk ini menghasilkan Photo Story Book berjudul &ldquo;Mozaik Keberagaman Kota Atlas&rdquo;, serta menjadi wadah diseminasi karya artikel, publikasi ilmiah, dll., sebagai langkah inovatif membentuk generasi toleran, unggul, dan berbudaya</p>
    </div>

    <div class="strategy-grid reveal stagger">
      <div class="strategy-col">
        {{-- Kolom 1: Galeri Karya Budaya --}}
        <article class="strategy-card" id="galeri">
          <div class="strategy-head">
            <div class="icon"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="" loading="lazy"></div>
            <h3>Galeri Karya Budaya</h3>
          </div>
          <div class="kicker">Telah diselenggarakan di SMA Karangturi</div>
          <p>Hasil karya berupa Photo Story Book dan telah mendapatkan Hak Cipta Kekayaan Intelektual (KI), dapat diakses melalui tautan berikut:</p>

          <a class="link-row" href="https://drive.google.com/file/d/1-dM1jhadnNx_s4ybu1vU--1xaCFcX0DI/view?usp=drivesdk" target="_blank" rel="noopener">
            <span class="t">Photo Story Book<br><span class="sub">&ldquo;Mozaik Harmoni Keberagaman Kota Atlas&rdquo;</span></span>
            <span class="go">Lihat</span>
          </a>

          <a class="link-row" href="https://hakcipta.dgip.go.id/legal/c/NDM2MTY0NzEwNDllZGI2ZWQ4ZjZjMDcyNjVkYjdiOTI=" target="_blank" rel="noopener">
            <span class="t">Hak Cipta Kekayaan Intelektual<br><span class="sub">Photo Story Book</span></span>
            <span class="go">Lihat</span>
          </a>
        </article>

        {{-- Kolom 1 bawah: Publikasi Ilmiah --}}
        <article class="strategy-card" id="publikasi">
          <div class="strategy-head">
            <div class="icon"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="" loading="lazy"></div>
            <h3>Publikasi Ilmiah</h3>
          </div>
          <div class="kicker">Diseminasi Karya Publikasi Ilmiah Budaya di Indonesia</div>
          <p>Hasil karya berupa Publikasi Ilmiah dari penulis, dapat diakses pada tautan berikut:</p>

          @php
            $publikasi = [
              ['Cultural Conservation of Wong Kejawen Religion (Folklore Study of the Kejawen Community in Sidorejo Village, Batang Regency)', 'https://garuda.kemdiktisaintek.go.id/documents/detail/3759074'],
              ['Religious Learning on Students Believe in Sapta Dharma at School', 'https://www.atlantis-press.com/proceedings/icospolhum-21/125971440'],
              ['Local Education Practices of Sedulur Sikep Community: Resisting Formal Education and Developing the Value of Local Education', 'https://www.atlantis-press.com/proceedings/icess-21/125961151'],
              ['From Handshaking To Smiling: The Impact Of Global Policies On Local Communities In The Pandemic Era', 'https://jurnal.unpad.ac.id/umbara/article/view/30656'],
              ['Pandu Budaya School: Regeneration Agent and Strategy to Preserve Culture in Jalawastu Traditional Village', 'https://kneopen.com/kne-social/article/view/18655/'],
              ['Praktik Pilot Project Reformulasi Produksi Penyelematan Warisan Budaya Tak Benda Wedang Rojo berbasis Kemitraan Green Culture Berkelanjutan pada Desa Pariwisata Nongkosawit', 'https://garuda.kemdiktisaintek.go.id/documents/detail/6538513'],
            ];
          @endphp
          @foreach ($publikasi as [$judul, $url])
            <a class="link-row" href="{{ $url }}" target="_blank" rel="noopener">
              <span class="t">{{ $judul }}</span>
              <span class="go">Lihat</span>
            </a>
          @endforeach
        </article>
      </div>

      {{-- Kolom 2: Dokumentasi Pendukung --}}
      <article class="strategy-card" id="dokumentasi">
        <div class="strategy-head">
          <div class="icon"><img src="{{ asset('assets/img/ornamen-batik.webp') }}" alt="" loading="lazy"></div>
          <h3>Dokumentasi Pendukung</h3>
        </div>
        <div class="kicker">Dokumentasi Galeri Karya Budaya</div>

        <div class="dok-grid">
          <img class="dok-img dok-cover" src="{{ asset('assets/img/dokumentasi/cover.webp') }}" alt="Cover Photo Story Book Mozaik Harmoni Keberagaman Kota Atlas" loading="lazy">
          <img class="dok-img dok-pengantar" src="{{ asset('assets/img/dokumentasi/pengantar.webp') }}" alt="Pengantar Photo Story" loading="lazy">
          <img class="dok-img dok-hak" src="{{ asset('assets/img/dokumentasi/hakcipta.webp') }}" alt="Surat Pencatatan Ciptaan Hak Cipta KI" loading="lazy">
          <img class="dok-img dok-keg1" src="{{ asset('assets/img/dokumentasi/kegiatan1.webp') }}" alt="Dokumentasi kegiatan PjBL bersama siswa" loading="lazy">
          <img class="dok-img dok-keg2" src="{{ asset('assets/img/dokumentasi/kegiatan2.webp') }}" alt="Dokumentasi kegiatan di SMA Karangturi" loading="lazy">
        </div>

        <p class="dok-caption">Karya ini menjadi langkah strategis dalam mewujudkan generasi muda yang peduli akan budaya, kreatif untuk berkarya, dan inovatif dalam berinovasi.</p>
      </article>
    </div>
  </div>
</section>

{{-- ============ PETA KARYA NUSANTARA ============ --}}
<section class="section" id="peta">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">Peta Kaya Nusantara</span>
      <h2>Peta Jejak Keberdampakan</h2>
      <p>Klik Provinsi <strong>Jawa Tengah</strong> dan <strong>Papua</strong> pada peta untuk melihat detail publikasi.</p>
    </div>

    <div class="map-stats reveal stagger">
      <div class="map-stat"><strong data-count="2">0</strong><span>Wilayah Terintegrasi</span></div>
      <div class="map-stat"><strong data-count="36">0</strong><span>Coming Soon</span></div>
      <div class="map-stat"><strong data-count="3">0</strong><span>Galeri Karya</span></div>
      <div class="map-stat"><strong data-count="2">0</strong><span>Sekolah Terdampak Berkelanjutan</span></div>
    </div>

    <div class="map-toolbar">
      <div class="legend">
        <span><i class="dot terdampak"></i> Terdampak</span>
        <span><i class="dot soon"></i> Coming Soon</span>
        <span><i class="dot hover"></i> Hover Aktif</span>
      </div>

      <div class="focus-callout">
        <span class="star">&#9733;</span>
        <p><b>Fokus Utama</b>Klik Provinsi Jawa Tengah &amp; Papua pada peta untuk melihat detail publikasi.</p>
      </div>
    </div>

    <div class="map-wrap">
      <div class="map-box">
        <span class="map-label">Interaktif</span>
        <h3>Peta Indonesia</h3>

        <svg viewBox="0 0 900 400" xmlns="http://www.w3.org/2000/svg" role="img"
             aria-label="Peta Indonesia — 33 provinsi, Jawa Tengah dan Papua wilayah terintegrasi">
          <path class="island" data-prov="aceh" d="M68.5,63.3L73.7,67.5L69.7,73.3L65.1,80.5L68,86.8L68.1,96.2L71,105.1L64.7,108.7L62.3,100.5L57,94.5L49.9,83.9L41.2,80.4L35.5,73.9L27,66.8L21.2,61L17.6,54.7L16.1,46.8L23.4,44.2L29.1,47.9L35.7,51.2L44.7,51.5L51.5,51.7L59.3,51.4L65.9,58L68.5,63.3ZM25.6,99.3L32.8,99L37.9,103.6L31,102.1L25.6,99.3Z"/>
          <path class="island" data-prov="sumaterabarat" d="M91.2,180L84.6,182.2L80.3,174.4L86.3,168.7L89.4,175.6L91.2,180ZM128.4,183.4L131,190.5L126.5,198.7L122.7,192.8L119.3,182.3L115.6,175.4L113.6,168.4L108.6,161.8L103.5,157.1L99.8,150L93.3,146.9L97.5,141.1L105.1,142.4L103.8,134.5L111.8,137.7L112.5,145.2L119.3,148L121.9,155.8L127.4,160.9L133.8,165.1L141.6,170L139.7,177.2L135.5,183.3L128.4,183.4Z"/>
          <path class="island" data-prov="yogyakarta" d="M310.8,307.3L304,304.3L298.6,300.2L306,295.1L312.4,300.3L313.4,307.6L310.8,307.3Z"/>
          <path class="island" data-prov="sumaterautara" d="M82.5,79.6L89,82.5L97.2,87.7L104.3,93.6L107.3,100.5L112.9,106.5L112.4,116.9L114.4,123.7L109.5,129L110.5,136.9L103.8,134.5L106.2,141.6L99.2,141.6L92.5,145.2L88.8,139.3L84.9,127L84.7,119.5L77.7,113.5L72.5,107.2L70.6,99.3L67.6,93.1L67.6,85.8L67.2,78.6L70.3,72.4L77.1,74.4L82.4,79.1L82.5,79.6ZM67.1,134.8L64.3,140.9L59.1,133.5L54.8,128.2L63,129L67.1,134.8Z"/>
          <path class="island" data-prov="bangkabelitung" d="M208.8,186.5L212.9,180.5L217.6,185.9L224.8,187.5L225.8,195.8L237.4,200.4L232.6,206.6L224,206.2L219.2,200.7L216.8,192.1L209,191.8L208.8,186.5ZM261.3,211.7L251.9,213.1L251.7,205.8L255.9,199.5L262.5,202.6L263.4,209.9L261.3,211.7Z"/>
          <path class="island" data-prov="papuabarat" d="M767.1,205.2L762.6,210.6L758.4,216L778.4,222.9L771.2,232.4L767.3,226.1L759.6,226.4L752.8,223.5L747.3,217.6L750.1,210.7L745.7,216.7L744.2,224.9L736.9,228.6L730.2,220.7L732.4,214.2L724.4,208.4L717.5,206.4L724.7,202.4L731.5,204.5L736.2,198.9L742.5,201.3L747.8,206L750.8,199.8L754.5,194.1L747.7,193.2L740.7,193.3L733.5,194.8L722.4,194.9L718.6,189.4L717.7,182.5L710.6,181L704.2,177.4L697.3,179.2L702.1,172L707,165.3L716,162.4L724.4,157.9L731.6,159.3L738.3,161.8L745.9,165.6L754,165.1L756.4,172.9L758.3,180.9L757.1,188.7L757.8,196.1L761.6,201.8L767.1,205.2ZM686.5,155.2L693,152.4L699.9,152.8L693.5,156L686.6,156.9L686.5,155.2ZM695.2,166.1L688,168.9L694.7,166.7L695.2,166.1ZM690.5,169.9L697.9,168.8L697.4,175.8L691.3,172.5L690.5,169.9ZM681.9,190.7L673,187.2L679.4,184.2L687,186.3L681.9,190.7Z"/>
          <path class="island" data-prov="jawatimur" d="M365.8,298.3L374.4,296.3L380.8,299L380.1,311.8L385.1,317.4L378,315.2L370.5,314.3L363.8,311.7L356.1,309.2L349.9,311.9L342.6,310.9L334.6,309L327.3,310.2L319.4,309.2L319.2,302.5L319.4,295.6L325.2,291.9L328.3,284.4L334.8,280.2L341.8,282.1L347.9,285.1L351.5,293.7L357.5,298.8L365.8,298.3ZM371.2,282.2L366.1,287.1L357.9,289L349.3,288.1L364.2,282.7L371.2,282.2Z"/>
          <path class="island" data-prov="kalimantanbarat" d="M277,140.8L277.8,133.4L279.2,125.9L283,120L289.6,113.5L291,120.6L296.7,124.9L301.4,130.1L308.3,135.1L314.8,131.8L324,132.1L333,132.3L338.8,126.6L344.9,121.3L352.3,121.2L357.8,125.1L364.8,126.2L373.2,123.8L372.5,131.2L370.7,138L363.2,146.2L362.1,153.8L358.7,161L351.6,162.3L344.8,164.6L336,164.8L330.4,169L324.3,175L318.5,179.8L316,188.6L318.4,197.6L316.7,204.6L311.3,208.6L303.3,208.5L301.5,201.8L305,195.3L299.6,190.3L298,183.4L295.6,174.4L292.7,167.9L287.3,162.9L280.3,158L281.6,150.8L276.8,145.2L277,140.8ZM284.3,164.8L291.2,167.2L284.3,168.7L284.3,164.8Z"/>
          <path class="island" data-prov="kalimantanselatan" d="M383.4,218.9L382.7,210.9L386.3,204.8L390.3,198.3L397.4,193.5L398.6,185.8L400.3,178.7L407.1,176.2L405.4,183.9L408.2,190.7L419.1,196.3L415.9,202.5L412.8,208.7L412.3,215.5L406.3,222.5L393.9,227.4L386.7,231L385.1,224.2L383.4,218.9ZM412.6,219L417.1,212.4L417.6,219.8L415.7,226.7L412.6,219Z"/>
          <path class="island" data-prov="kalimantantimur" d="M431.1,173.6L424.3,174.2L422.4,181.8L416.1,184.2L420.4,190.7L422.3,197.4L412,195.8L406.1,190.2L405.4,182.6L407.3,174.9L402.2,167.5L397.3,159.9L398.8,153.2L391.4,155L388.9,148.1L395.2,144.1L392.3,137.3L385.3,139.2L377.4,141.1L370.6,138.7L371.6,131.4L376.5,125.1L383.9,124.1L391.1,127.1L401.6,130.5L407.6,124.9L415.4,116.2L417.5,107.6L426.4,105.5L436.1,101.9L444.3,106.5L451.6,107.4L443.9,109.9L446.8,116L452.2,120.2L457.7,124L464.4,128.6L464.9,136.1L458.6,134L451,134.2L444.3,138.2L441.3,145L438.7,155.7L437.7,162.5L434,169.6L431.1,173.6Z"/>
          <path class="island" data-prov="kepulauanriau" d="M187.4,131.2L193.9,128.7L194.5,136L189.2,131.6L187.4,131.2ZM195.7,153.5L202.2,156.7L193.1,156.7L195.7,153.5ZM261.6,80.5L263.5,70.8L266.8,77.3L262.3,82.3L261.6,80.5Z"/>
          <path class="island" data-prov="lampung" d="M217.8,257.6L210,258.5L203.9,261.8L198,258.1L194.3,264.6L188.9,258.8L183.1,252.7L179.1,247.2L186.1,245L189.7,239L195,231.7L202.5,230.9L207.5,225.2L214.2,227.7L217.9,233.7L218.8,240.5L218.7,251.5L217.8,257.6Z"/>
          <path class="island" data-prov="maluku" d="M645.7,220.4L639.1,223.3L644.5,218.4L645.7,220.4ZM607.9,221.3L602.3,215.5L607.8,210.3L617.2,209.7L623.2,212.8L626,219.9L617.6,223.9L607.9,221.3ZM760.3,260L767.1,260.4L762.7,266L758.5,260.3L760.3,260ZM766.2,264.6L768.4,271.4L761.8,269.9L766.2,264.6ZM758.7,269.9L764.1,275.6L758.5,282.9L756.7,274.2L758.7,269.9ZM654.6,205.7L661.8,207.9L669.2,204.7L676,206.6L684.3,208L690.9,216.2L693.9,224.4L687.5,222L678.6,217.7L669.2,214.2L660.9,215L653.2,215.4L645.3,212.4L639.2,217.4L640.2,209.9L647.8,206.1L654.6,205.7ZM702.3,293.3L707.5,289L709.2,297L703.6,302.5L701.2,295.8L702.3,293.3ZM617.8,297.9L611,303.3L603.5,301.6L611.1,295.9L617.8,297.9ZM737.9,256.3L734.5,263.3L736.8,254L737.9,256.3Z"/>
          <path class="island" data-prov="malukuutara" d="M632.1,134.9L628.9,127.9L631.7,121L634.4,114.6L639.3,109.1L637.2,116.3L640.7,124.7L635.6,131.1L643.3,130L646.8,123.6L653.9,121.4L653.4,128.6L648.6,133.7L651.1,140.7L656.1,145.8L648.9,143.7L641.7,142.3L638.9,149.3L641.1,159.3L648.8,168.8L640.6,164.5L637.6,158.4L634.9,150L632.2,143.5L633.3,135.9L632.1,134.9ZM633.6,163.9L627,161.2L634.4,160.1L633.6,163.9ZM639.4,179.5L632.5,184.5L629.1,178.4L635.6,177.2L639.4,179.5ZM652.6,107.8L645.9,112.6L646.4,104.3L653.4,104L652.6,107.8ZM583.1,184.1L589.3,187.3L581,188.1L571.7,190.1L571.7,183L580.6,183.4L583.1,184.1ZM601.3,187.9L591.1,188.5L600.5,185.5L608.9,186L601.3,187.9ZM601.6,189.6L603.5,197.5L599.4,191.3L601.6,189.6Z"/>
          <path class="island" data-prov="nusatenggarabarat" d="M452.9,308.3L462.1,309.3L468.8,309.6L472.5,315.4L465.9,317.7L458.7,320.7L451.3,319.8L443.9,321.2L437.7,323.9L431,324.9L425.5,321.1L427.6,314.4L433.7,310.7L441.5,311.5L445.4,317.2L454.9,316.3L446.3,310.8L451.3,305.6L452.9,308.3ZM410.1,318.5L412.4,312L418.4,307.8L425.4,310.4L422.1,318.1L415,321.2L408.5,319.3L410.1,318.5Z"/>
          <path class="island" data-prov="nusatenggaratimur" d="M568.3,344.9L560.2,348.6L557.5,342L557.8,334.7L563.7,329.5L570.7,332L575.8,325.7L581.9,322L584,329L580.5,336.5L574.4,342.2L568.3,344.9ZM552.7,310.8L559.9,307L555.5,312.7L552.7,310.8ZM486.1,312.8L492.8,309.1L501.9,310.4L512,312.6L518.6,314.4L525.2,312.2L531.5,316L537.3,311.2L543.8,307.6L542,314.1L534.9,317.7L528.1,317.7L521.7,320.6L514.3,318.8L507.5,322L500.2,320.3L493.1,320L486.2,319.7L485.6,312.9L486.1,312.8ZM546.4,355.1L552,350.9L549.3,357.6L542.6,359.3L546.4,355.1ZM481.8,338.6L474.6,337L467.5,333L474.6,329.6L481.9,330.1L489.5,331.8L496.7,334.5L500.8,339.9L499.5,346.7L491,346.4L486.1,341.3L481.8,338.6ZM584.4,310.5L576.6,311.2L582.3,306.4L584.4,310.5Z"/>
          <path class="island aktif" data-prov="papua" d="M881.8,198.6L887.8,271.6L885.2,278.5L888,303.8L887.8,325L880.4,319.2L875.5,312.6L868.4,307.3L859.3,307.2L851.3,306.4L850,299L847.2,290.8L854.3,287.6L860.7,289.8L854.6,285L848.8,281.5L843.6,277.2L838.8,272.5L836.1,264.5L836.5,257.8L834.1,251.1L827.5,252.3L822.1,248L816.6,244L809.4,244L802.9,241.8L796.6,239.3L787.2,237L780.2,235.9L772.2,233.3L778.4,222.9L758.4,216L762.6,210.6L767.1,205.2L770.9,211.6L779.9,216.1L785.2,212L790.9,208.1L796.1,201.7L798.9,194.8L806,193.8L812.8,192.7L815.5,186.5L820.6,182L827,179.9L833.1,182.8L843.1,185.4L849.7,189L864,196.3L870.9,195.6L878.2,197.9L881.8,198.6ZM789.2,171.7L782.4,165.6L789.8,164.7L795.8,171.3L788.8,172.3L789.2,171.7ZM856.3,288.4L848.5,287.7L842.3,284.9L848.4,281.7L856.2,285.6L856.3,288.4ZM796.1,187L789.6,184.7L782.5,183.4L789.6,182.6L796.4,182.8L807.6,184.5L799.1,186.8L796.1,187ZM835.2,293.5L844.9,291.8L851.4,295.6L847.7,301.8L842.4,308.5L828.2,310.9L826.8,303.8L831.6,296.1L835.2,293.5Z"/>
          <path class="island" data-prov="riau" d="M143.5,168.9L133.6,165.5L127.4,160.9L121.9,155.8L122.7,149.2L115.6,147L110.9,140.3L108.6,133.5L108.8,126.1L115.3,122.6L113.9,109.5L121.7,111.8L131.9,112.5L133.9,119.1L145.2,123.6L148,129.8L152.9,136L162.1,137.5L162.2,145L156,148.2L166.8,143.9L175.3,143.9L179.6,151.6L172.8,152.3L179.1,157.9L171.8,161.3L166.5,165.6L160.1,170L153.5,170.9L145.2,168.1L143.5,168.9ZM134,116.4L138.5,110.9L140,117.8L134,116.4ZM145.8,120.8L153.9,122.5L146.7,123.2L145.8,120.8ZM157.6,131.6L167.1,134.4L160.4,132.5L157.6,131.6ZM162.3,136.6L153.4,135.7L159.1,131.9L165,135.7L162.3,136.6Z"/>
          <path class="island" data-prov="sulawesiselatan" d="M480.1,238.1L480.5,231.4L477.4,222.1L477.1,215.1L479,207.4L483.1,201L480.8,192.6L487.8,188.8L494.3,190.5L501.3,193.5L510.1,195.8L516.5,198.8L522.2,203L516.4,208.3L508.8,204.2L500.6,201.7L494.6,205.9L495.3,213.3L495.7,221.2L494.7,228L494.5,235.7L495.2,243.5L494.7,252.9L486.6,257L479.5,259L475.6,252.8L478.8,245.2L480.1,238.1ZM496.6,273.1L496.3,264.8L498.1,271.9L496.6,273.1Z"/>
          <path class="island" data-prov="bengkulu" d="M155.9,231L150.4,226.9L146,218.6L137.9,213.2L133.8,207.2L128.8,201.5L131.6,194.8L136.5,200.3L144.9,203.3L149.9,209.2L156.3,214.8L164.1,215.6L159.3,221.3L163.3,227.8L169.9,232.5L173.6,238.6L179,242.7L172.1,244.1L164.8,237.8L155.9,231Z"/>
          <path class="island" data-prov="sulawesitengah" d="M508,178.8L515.5,170L524.9,170.4L533.9,166.3L541,166.2L549.9,162.4L552.1,170.6L545.8,168L539.6,173L533.4,179.9L526.5,182.1L521.1,187.4L514,185.8L517.4,192.7L526.6,202L531.9,206.8L534.1,213.9L528.3,208.8L519.7,206.5L516.5,198.8L510.1,195.8L501.3,193.5L495.5,187.3L487.8,188.8L481.6,180.8L480.5,172.8L481.8,166L483.1,158.4L480.3,151.6L486,147.2L488.2,138.8L492.6,133.2L498.3,137L503.3,131.7L508.1,126.6L515.6,126.5L520.4,131.6L527.2,131L516.9,135.2L510,138.3L505,143.9L497.5,141.6L490.4,147.7L488,155.8L489,163.4L493.8,169.8L498.8,175.3L506.6,178.1L508,178.8ZM547.4,176.5L543.2,181.9L543.2,173.9L549.6,178L547.4,176.5Z"/>
          <path class="island" data-prov="sulawesiutara" d="M587.7,122.8L583.5,129.7L578.5,134.5L574.9,140.4L568.2,144.1L557.9,145.8L554.3,139.4L547.2,134L555.1,134.5L563.2,135.5L569.7,132.2L575.7,127.5L580.1,122.5L586.4,119.3L587.7,122.8ZM618.5,68.4L616.6,75.3L615.1,68.8L618.5,68.4Z"/>
          <path class="island" data-prov="sulawesitenggara" d="M536.9,256.8L541.4,250.8L541.3,244.1L544,235.7L548.8,240.6L544.1,247L549.2,252.3L542.6,255.3L536.9,256.8ZM518.4,242.6L516.9,235.3L513.6,227.4L504.6,218.6L508.2,212.4L507.6,205.1L512.3,209.9L519.5,206.2L528.1,207.9L532.4,213L529.8,219.3L535,224.1L538.9,230.6L540.1,237.3L531,237L528.2,243.2L520.2,243.9L518.4,242.6ZM524.1,254.4L523.9,247.7L526.9,255.4L524.1,254.4ZM538.2,253.4L531.1,253.9L533.2,245.8L537.2,240.3L540.4,246.1L538.2,253.4Z"/>
          <path class="island" data-prov="bali" d="M396.4,317.8L390.7,312.5L382.2,307.9L390.1,307.5L401.3,306.8L406.2,311.4L399.5,314.8L396.4,317.8Z"/>
          <path class="island" data-prov="banten" d="M222.1,263.4L228.6,265.2L235.1,267.4L229.4,272.3L231,280.3L221.1,281.2L212.5,282.3L206.2,279.9L213.9,277.7L218.2,271.5L221.3,264.6L222.1,263.4Z"/>
          <path class="island" data-prov="gorontalo" d="M533.7,141.5L522.2,143.6L515.4,142.5L510,138.3L516.9,135.2L526.2,133.6L532.9,132.5L539.7,134.5L546.6,133.7L551.7,138.8L553.9,145.2L546.2,141.5L539.2,142.4L533.7,141.5Z"/>
          <path class="island" data-prov="jambi" d="M146.7,204.1L138.8,199.6L131.7,194.8L128.6,187L135.4,183.3L139.7,177.2L141.7,170L148.2,168.5L154.3,172L162.5,168.3L171,166.7L177.9,169.6L185.2,171L191.9,176.8L189.8,184.5L180.9,184.6L174.4,187.7L172.7,196.3L165.2,195.6L157,201.4L150,201.4L146.7,204.1Z"/>
          <path class="island" data-prov="jawabarat" d="M270.2,279.2L274.6,284.8L269.9,290.2L273.3,296.5L267.8,300.3L258.2,298.6L251.8,295.6L236.4,293L229.7,291.6L231.8,285.2L229.4,278.9L230.3,271.6L237.4,272.3L240.6,266.3L249.2,268.4L255.9,269.2L263.3,270.9L269.6,274.9L270.2,279.2Z"/>
          <path class="island aktif" data-prov="jawatengah" d="M329.7,280L328,287.4L320.4,289.4L320.2,296.3L318.6,305L311.8,304.1L306.8,299.3L299.9,297.2L290.7,299.6L281.8,297.9L274.8,297.5L271.9,291.2L274.6,284.8L279.7,280.1L286.6,281.7L295.2,283.1L303.4,283.6L309.2,279.1L316.1,273.3L323.3,279.1L329.7,280Z"/>
          <path class="island" data-prov="kalimantantengah" d="M407.1,176.2L400.3,178.7L398.6,185.8L398.2,193.8L390.3,198.3L386.3,204.8L382.7,211L380.3,217.3L373,215.5L366.5,217.4L358.1,210.1L350.7,214.4L343.3,215.1L333.7,218.8L331.7,212.3L330.6,205.2L323.8,207L316.2,209.8L319.1,203.8L317.1,194.1L316.6,183.7L320.7,178.2L327.4,174.3L332.7,168.6L338.5,165.3L348.7,163.8L355.8,160.9L361.3,155.6L362.6,149L367.1,143L373.7,138.9L381.5,142L386.9,137.5L395.2,143.2L388.9,148.1L391.4,155L398.4,152L397.6,158.9L400.1,166.9L405.5,171.6L407.1,176.2Z"/>
          <path class="island" data-prov="sulawesibarat" d="M472,217.8L466.1,214.3L466.7,206.5L469.7,199.1L472.4,192.4L474.8,185.7L474.4,177.9L477.7,171.8L478.9,178.6L483.6,183.6L484.4,190.3L482.5,197L481.1,203.9L480.8,210.7L478.2,217.8L472,217.8Z"/>
          <path class="island" data-prov="sumateraselatan" d="M200.9,196.2L207.9,196.6L213.8,200.8L217.7,206.9L223.1,213.1L217.9,219.8L218.7,228L212.6,225.3L204.9,226.4L198.2,232.6L190.2,234.3L190.2,242.8L182.5,244.9L177.2,239.7L173,233.7L165.5,232.4L160.7,227L160.5,220.3L156.3,214.8L151.2,209.8L146.3,204.2L153.9,202.9L160.2,199.8L166.5,196.3L172.8,192.9L177.8,185.7L185,185.4L191,182.4L191.3,189.6L199,189.6L197.3,196.3L200.9,196.2Z"/>
          <path class="island" data-prov="kalimantanutara" d="M423.6,68.9L430.7,68.8L437.4,69.7L441.3,75.3L445.9,80.5L439.2,81.1L439.1,87.8L442.6,93.6L445.8,99.7L448,106L441.3,104.1L435,101.9L427.9,105.1L421.2,104.3L416.9,110.9L414.5,117.5L410.6,123.1L403.9,125.5L399.5,130.7L393.1,128.3L386.5,125.7L387.1,118.8L390.7,113.1L391.8,106.5L394.9,100.4L397.6,94.1L402.8,89.7L403.9,83.1L403.7,76.3L407.3,70.7L413.9,68.9L420.6,69.6L423.6,68.9Z"/>
          <circle class="marker" data-prov="jawatengah" cx="300" cy="290" r="10" tabindex="0"
                  role="button" aria-label="Detail Jawa Tengah"/>
          <circle class="marker" data-prov="papua" cx="840" cy="220" r="10" tabindex="0"
                  role="button" aria-label="Detail Papua"/>
        </svg>
      </div>

      <aside class="map-detail" aria-live="polite">
        <span class="map-label">Detail Wilayah</span>
        <h3 id="provName">Indonesia</h3>

        <div class="detail-row"><span class="k">Status</span><span class="v" id="provStatus">Pilih wilayah</span></div>
        <div class="detail-row"><span class="k">Kategori</span><span class="v" id="provKategori">Provinsi</span></div>
        <div class="detail-row"><span class="k">Program</span><span class="v" id="provProgram">Kaya Nusantara</span></div>

        <div class="detail-note" id="provNote">Klik marker hijau pada peta (Jawa Tengah / Papua) untuk melihat detail publikasi.</div>
      </aside>
    </div>
  </div>
</section>

{{-- ============ FAQ ============ --}}
<section class="section cream" id="faq">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">FAQ</span>
      <h2>Mengenal Lebih Dekat</h2>
      <p>Pertanyaan umum seputar Kaya Nusantara dan platform edukasi budayanya.</p>
    </div>

    <div class="faq-list reveal stagger">
      @php
        $faqs = [
          ['Apa itu Kaya Nusantara?', 'Kaya Nusantara (Kenali Budaya Nusantara) merupakan platform edukasi dan media pembelajaran digital yang bertujuan memperkenalkan, mempelajari, dan melestarikan keberagaman budaya Indonesia. Platform ini mengintegrasikan tujuh unsur kebudayaan ke dalam materi edukasi dan pembelajaran interaktif bagi siswa SD, SMP, dan SMA/sederajat.'],
          ['Apa saja materi kebudayaan yang tersedia di Kaya Nusantara?', 'Kaya Nusantara menyediakan materi berdasarkan tujuh unsur kebudayaan, yaitu bahasa, sistem pengetahuan, organisasi sosial, sistem peralatan hidup dan teknologi, sistem mata pencaharian hidup, sistem religi, serta kesenian. Materi dilengkapi informasi, gambar, artikel, video, dan aktivitas pembelajaran.'],
          ['Siapa saja yang dapat menggunakan website Kaya Nusantara?', 'Kaya Nusantara dapat digunakan oleh masyarakat umum, siswa SD, SMP, SMA/sederajat, serta guru. Pengunjung umum dapat mengakses informasi kebudayaan, sedangkan siswa dan guru dapat memanfaatkan fasilitas pembelajaran melalui akun masing-masing.'],
          ['Bagaimana cara siswa mengikuti pembelajaran di Kaya Nusantara?', 'Siswa dapat mendaftar atau masuk menggunakan akun yang telah dimiliki, kemudian bergabung ke kelas melalui kode kelas yang diberikan guru. Setelah bergabung, siswa dapat mengakses materi, mengerjakan tugas, mengikuti asesmen, berdiskusi, dan memantau perkembangan belajarnya.'],
          ['Apakah siswa dapat mengunggah hasil karya melalui Kaya Nusantara?', 'Ya. Siswa dapat mengunggah hasil pembelajaran berupa ringkasan materi, artikel, makalah, poster, infografis, foto, maupun video yang berkaitan dengan kebudayaan Indonesia. Karya tersebut dapat diperiksa dan dinilai guru sebelum dipublikasikan di Galeri Kaya Nusantara.'],
          ['Apa saja yang dapat dilakukan guru melalui Kaya Nusantara?', 'Guru dapat membuat dan mengelola kelas digital, menyediakan materi pembelajaran, memberikan tugas dan proyek, menyusun asesmen, menilai hasil pekerjaan siswa, serta memantau perkembangan belajar melalui laporan pembelajaran yang tersedia.'],
          ['Apakah Kaya Nusantara menyediakan kuis atau evaluasi pembelajaran?', 'Ya. Kaya Nusantara menyediakan fitur kuis dan asesmen interaktif untuk mengukur pemahaman siswa terhadap materi kebudayaan. Bentuk evaluasi dapat berupa pilihan ganda, benar-salah, menjodohkan, isian singkat, maupun soal uraian yang disusun sesuai jenjang pendidikan.'],
          ['Bagaimana Kaya Nusantara membantu melestarikan kebudayaan Indonesia?', 'Kaya Nusantara berperan sebagai media edukasi dan dokumentasi digital yang memperkenalkan keberagaman budaya Indonesia kepada generasi muda. Melalui pembelajaran interaktif, eksplorasi budaya daerah, serta publikasi karya siswa, platform ini mendorong keterlibatan generasi muda dalam mengenal, menghargai, dan melestarikan warisan budaya bangsa.'],
        ];
      @endphp

      @foreach ($faqs as $i => $faq)
        <div class="faq-item">
          <span class="faq-num">{{ $i + 1 }}</span>
          <span class="faq-q">{{ $faq[0] }}</span>
          <span class="faq-plus">+</span>
        </div>
        <div class="faq-a"><p>{{ $faq[1] }}</p></div>
      @endforeach
    </div>
  </div>
</section>

{{-- ============ TESTIMONI — slider ala senandungasa (2 contoh, konten menyusul) ============ --}}
<section class="section" id="testimoni">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">Testimoni</span>
      <h2>Kata Mereka tentang Kaya Nusantara</h2>
      <p>Dukungan dari mitra pendidikan dan pemerintah untuk ekosistem belajar budaya digital.</p>
    </div>

    <div class="testi-slider">
      <button class="testi-arrow prev" id="testiPrev" aria-label="Testimoni sebelumnya">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
      </button>

      <div class="testi-viewport" id="testiViewport">
        <div class="testi-track" id="testiTrack">
          @foreach ([
            ['inisial' => 'T1', 'nama' => 'Nama Testimoni 1', 'jabatan' => 'Jabatan / Institusi — menyusul', 'teks' => 'Kaya Nusantara menjadi langkah nyata memperkenalkan kebudayaan kepada generasi muda melalui media yang menyenangkan dan mudah diakses. Saya mendukung penuh pengembangan platform ini.'],
            ['inisial' => 'T2', 'nama' => 'Nama Testimoni 2', 'jabatan' => 'Jabatan / Institusi — menyusul', 'teks' => 'Platform yang sangat relevan dengan kebutuhan pembelajaran budaya di sekolah. Fitur kelas dan pengumpulan karya siswanya memudahkan guru dalam mengelola pembelajaran.'],
          ] as $t)
            <article class="testi-slide">
              <div class="ava">{{ $t['inisial'] }}</div>
              <div class="quote">&ldquo;</div>
              <p>{{ $t['teks'] }}</p>
              <b>{{ $t['nama'] }}</b>
              <span>{{ $t['jabatan'] }}</span>
            </article>
          @endforeach
        </div>
      </div>

      <button class="testi-arrow next" id="testiNext" aria-label="Testimoni berikutnya">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>

    <div class="testi-dots" id="testiDots" role="tablist" aria-label="Pilih testimoni"></div>

    <p class="testi-note">*Konten testimoni masih contoh — menunggu materi final.</p>
  </div>
</section>

{{-- ============ MITRA KOLABORASI ============ --}}
<section class="section cream" id="mitra">
  <div class="container reveal">
    <div class="section-head center">
      <span class="eyebrow">Mitra Kolaborasi</span>
      <h2>Didukung Oleh</h2>
      <p>Kolaborasi lintas institusi untuk merawat identitas budaya bangsa.</p>
    </div>

    <div class="mitra-grid reveal stagger">
      @foreach ([
        ['unnes.webp', 'Universitas Negeri Semarang'],
        ['undip.webp', 'Universitas Diponegoro'],
        ['sma-karangturi.webp', 'SMA Karangturi'],
        ['kemenkebud.webp', 'Kementerian Kebudayaan'],
      ] as $mitra)
        <div class="mitra-card">
          <div class="mitra-logo"><img src="{{ asset('assets/img/mitra/'.$mitra[0]) }}" alt="{{ $mitra[1] }}" loading="lazy"></div>
          <b>{{ $mitra[1] }}</b>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
