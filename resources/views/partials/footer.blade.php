{{-- Footer bersama --}}
<footer class="site-footer" id="belajar">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand">
          <img src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Logo Kaya Nusantara">
        </div>
        <p class="footer-tagline">Belajar Budaya, Mengenal Identitas, Melestarikan Warisan Bangsa</p>
        <p class="footer-desc">Kenali, pelajari, dan lestarikan keberagaman budaya Indonesia melalui pengalaman belajar yang interaktif dan menyenangkan.</p>

        <div class="footer-col">
          <h4>Sosial Media</h4>
          {{-- Link kosong sesuai brief --}}
          <div class="socials">
            <a href="#" aria-label="Instagram" title="Menyusul">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4.5"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
            </a>
            <a href="#" aria-label="TikTok" title="Menyusul">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.6 7.4a5.6 5.6 0 0 1-3.3-1.1v6.9a5.7 5.7 0 1 1-5.7-5.7c.3 0 .6 0 .9.1v2.9a2.8 2.8 0 1 0 2 2.7V2h2.9a5.6 5.6 0 0 0 3.2 4.9z"/></svg>
            </a>
            <a href="#" aria-label="Facebook" title="Menyusul">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v7h3v-7h2.5l.5-3H14V9z"/></svg>
            </a>
          </div>
        </div>
      </div>

      <div class="footer-col">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('selasar') }}">Selasar Budaya</a></li>
          <li><a href="{{ route('home') }}#galeri">Galeri Karya</a></li>
          <li><a href="{{ route('jelajah360') }}">Jelajah Budaya 360&deg;</a></li>
          <li><a href="{{ route('belajar') }}">Ruang Belajar</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Hubungi Kami</h4>
        <ul class="footer-contact">
          <li><a href="{{ route('tim') }}">Tim Kaya Nusantara</a></li>
          <li><a href="mailto:kenalibudayanusantara@gmail.com">kenalibudayanusantara@gmail.com</a></li>
          <li><a href="tel:+62895413561810">0895413561810</a></li>
          <li>Jl. Perumahan Ayodya, Sekaran,<br>Kec. Gunungpati, Kota Semarang,<br>Jawa Tengah 50229</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      &copy; 2025 Kaya Nusantara
    </div>
  </div>
</footer>

{{-- Widget chatbot AI --}}
<div class="chatbot" id="chatbot">
  <div class="chatbot-panel" id="chatbotPanel" hidden>
    <div class="chatbot-head">
      <span class="chatbot-ava"><img src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt="Kaira"></span>
      <b>Kaira</b>
      <button type="button" class="chatbot-close" id="chatbotClose" aria-label="Tutup chat">&times;</button>
    </div>
    <div class="chatbot-body" id="chatbotBody">
      @auth
        <div class="chatbot-bubble bot">Hallo, aku Kaira asisten belajarmu! Tanya saja tentang kebudayaan Indonesia, materi di Kelas Saya jadi rujukan utamaku.</div>
      @else
        <div class="chatbot-bubble bot">Hallo, aku Kaira! Untuk mulai mengobrol dan bertanya seputar kebudayaan Indonesia, silakan masuk terlebih dahulu.</div>
        <div class="chatbot-login-cta">
          <a class="btn btn-coklat" href="{{ route('login', ['redirect' => url()->current()]) }}">Masuk untuk Chat</a>
        </div>
      @endauth
    </div>
    @auth
      <form class="chatbot-form" id="chatbotForm">
        @csrf
        <input type="text" id="chatbotInput" placeholder="Silakan ketik..." maxlength="1000" autocomplete="off">
        <button type="submit" aria-label="Kirim">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M3.4 20.4 21.5 12 3.4 3.6l-.01 6.53L14 12 3.39 13.87z"/></svg>
        </button>
      </form>
    @else
      <div class="chatbot-form chatbot-form-guest">
        <p>Login diperlukan untuk menggunakan chat AI.</p>
      </div>
    @endauth
  </div>
  <button type="button" class="chatbot-fab" id="chatbotFab" aria-label="Buka chat Kaira">
    <span class="chatbot-fab-text">Hallo, ada yang bisa Kaira bantu?</span>
    <span class="chatbot-fab-icon"><img src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt=""></span>
  </button>
</div>

<div class="toast" id="toast" role="status"></div>

<button class="to-top" id="toTop" aria-label="Kembali ke atas">
  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<script src="{{ asset('assets/js/main.js') }}?v=29" defer></script>
</body>
</html>


