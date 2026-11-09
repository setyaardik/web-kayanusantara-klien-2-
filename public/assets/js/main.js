/* ============================================================
   Karya Nusantara — Interaksi Beranda
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Toast ---------- */
  const toastEl = document.getElementById('toast');
  let toastTimer;
  function toast(msg) {
    if (!toastEl) return;
    toastEl.textContent = msg;
    toastEl.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2600);
  }

  /* ---------- Header tetap 50% — tanpa perubahan saat scroll ---------- */

  /* ---------- Search panel (ikon di paling kanan) ---------- */
  const searchToggle = document.getElementById('searchToggle');
  const searchPanel = document.getElementById('searchPanel');
  searchToggle?.addEventListener('click', () => {
    const open = searchPanel.classList.toggle('open');
    searchToggle.setAttribute('aria-expanded', open);
    if (open) setTimeout(() => document.getElementById('headerSearchInput')?.focus(), 250);
  });

  function bindSearch(formId, inputId, closePanel) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const q = (document.getElementById(inputId)?.value || '').trim();
      toast(q
        ? `Pencarian "${q}" — fitur search menyusul 🙏`
        : 'Ketik kata kunci budaya yang ingin dicari.');
      if (closePanel) {
        searchPanel?.classList.remove('open');
        searchToggle?.setAttribute('aria-expanded', 'false');
      }
    });
  }
  bindSearch('headerSearch', 'headerSearchInput', true);
  bindSearch('mainSearch', 'mainSearchInput', false);

  /* ---------- Nav mobile ---------- */
  const navToggle = document.getElementById('navToggle');
  const mainNav = document.getElementById('mainNav');
  navToggle?.addEventListener('click', () => {
    const open = mainNav.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', open);
  });

  /* ---------- Dropdown Home: dibuka dengan KLIK ---------- */
  const homeDrop = document.getElementById('homeDrop');
  const dropToggle = document.getElementById('dropToggle');
  dropToggle?.addEventListener('click', (e) => {
    e.stopPropagation();
    const open = homeDrop.classList.toggle('open');
    dropToggle.setAttribute('aria-expanded', open);
  });
  // tutup saat klik di luar dropdown
  document.addEventListener('click', (e) => {
    if (homeDrop?.classList.contains('open') && !homeDrop.contains(e.target)) {
      homeDrop.classList.remove('open');
      dropToggle?.setAttribute('aria-expanded', 'false');
    }
  });
  // tutup saat tekan Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && homeDrop?.classList.contains('open')) {
      homeDrop.classList.remove('open');
      dropToggle?.setAttribute('aria-expanded', 'false');
    }
  });

  /* ---------- FAQ accordion ---------- */
  document.querySelectorAll('.faq-item').forEach((item) => {
    const ans = item.nextElementSibling;
    if (!ans || !ans.classList.contains('faq-a')) return;

    item.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      // tutup semua
      document.querySelectorAll('.faq-item.open').forEach((o) => {
        o.classList.remove('open');
        const a = o.nextElementSibling;
        if (a) a.style.maxHeight = null;
      });

      if (!isOpen) {
        item.classList.add('open');
        ans.style.maxHeight = ans.scrollHeight + 'px';
      }
    });
  });

  /* ---------- Peta: detail Jateng & Papua ---------- */
  const provData = {
    jawatengah: {
      name: 'Jawa Tengah',
      status: ['Terintegrasi', true],
      kategori: 'Provinsi',
      program: 'Karya Nusantara',
      note: 'Detail publikasi Jawa Tengah — konten tingkat kecamatan menyusul (blok sementara sesuai brief).'
    },
    papua: {
      name: 'Papua',
      status: ['Terintegrasi', true],
      kategori: 'Provinsi',
      program: 'Karya Nusantara',
      note: 'Detail publikasi Papua — konten menyusul (blok sementara sesuai brief).'
    }
  };

  const els = {
    name: document.getElementById('provName'),
    status: document.getElementById('provStatus'),
    kategori: document.getElementById('provKategori'),
    program: document.getElementById('provProgram'),
    note: document.getElementById('provNote'),
  };

  function showProv(key) {
    const d = provData[key];
    if (!d || !els.name) return;
    els.name.textContent = d.name;
    els.status.textContent = d.status[0];
    els.status.classList.toggle('hijau', d.status[1]);
    els.kategori.textContent = d.kategori;
    els.program.textContent = d.program;
    els.note.textContent = d.note;
    toast(`Detail wilayah: ${d.name}`);
  }

  document.querySelectorAll('[data-prov]').forEach((el) => {
    el.addEventListener('click', () => showProv(el.dataset.prov));
    el.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        showProv(el.dataset.prov);
      }
    });
  });

  /* ---------- Smooth scroll dengan offset header ---------- */
  document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener('click', (e) => {
      const id = a.getAttribute('href');
      if (id.length < 2) return;
      const target = document.querySelector(id);
      if (!target) return;
      e.preventDefault();
      const y = target.getBoundingClientRect().top + window.scrollY - 78;
      window.scrollTo({ top: y, behavior: 'smooth' });
      mainNav?.classList.remove('open');
      navToggle?.setAttribute('aria-expanded', 'false');
      homeDrop?.classList.remove('open');
    });
  });

  /* ---------- Reveal saat scroll ---------- */
  const revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('tampak');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach((el) => io.observe(el));
  }

  /* ---------- Tombol ke atas ---------- */
  const toTop = document.getElementById('toTop');
  if (toTop) {
    window.addEventListener('scroll', () => {
      toTop.classList.toggle('tampak', window.scrollY > 500);
    }, { passive: true });
    toTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---------- Hero background auto-slide ---------- */
  const slides = document.querySelectorAll('.hero-slide');
  if (slides.length > 1) {
    let cur = 0;
    setInterval(() => {
      slides[cur].classList.remove('is-on');
      cur = (cur + 1) % slides.length;
      slides[cur].classList.add('is-on');
    }, 6000);
  }

  /* ---------- Slider testimoni ---------- */
  const track = document.getElementById('testiTrack');
  if (track) {
    const slides = track.children.length;
    const dotsEl = document.getElementById('testiDots');
    let idx = 0;

    // buat titik indikator
    for (let i = 0; i < slides; i++) {
      const d = document.createElement('button');
      d.setAttribute('aria-label', 'Testimoni ' + (i + 1));
      d.addEventListener('click', () => go(i));
      dotsEl.appendChild(d);
    }
    const dots = dotsEl.children;

    function go(i) {
      idx = (i + slides) % slides;
      track.style.transform = `translateX(-${idx * 100}%)`;
      [...dots].forEach((d, n) => d.classList.toggle('aktif', n === idx));
    }

    document.getElementById('testiPrev')?.addEventListener('click', () => go(idx - 1));
    document.getElementById('testiNext')?.addEventListener('click', () => go(idx + 1));

    // opsional: geser otomatis tiap 6 detik
    setInterval(() => go(idx + 1), 6000);
    go(0);
  }

  /* ---------- Animasi angka stat ---------- */
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = +el.dataset.count;
        const step = Math.max(1, Math.round(target / 35));
        let cur = 0;
        const t = setInterval(() => {
          cur += step;
          if (cur >= target) { cur = target; clearInterval(t); }
          el.textContent = cur;
        }, 35);
        io.unobserve(el);
      });
    }, { threshold: 0.4 });
    counters.forEach((c) => io.observe(c));
  }

  /* ---------- Selasar: filter kategori 7 unsur ---------- */
  const unsurChips = document.querySelectorAll('.unsur-chip');
  if (unsurChips.length) {
    const cards = document.querySelectorAll('.unsur-card');
    unsurChips.forEach((chip) => {
      chip.addEventListener('click', () => {
        unsurChips.forEach((c) => c.classList.remove('is-active'));
        chip.classList.add('is-active');
        const f = chip.dataset.filter;
        cards.forEach((card) => {
          card.hidden = !(f === 'semua' || card.dataset.kat === f);
        });
      });
    });

    // pencarian unsur - filter by nama
    const unsurInput = document.getElementById('unsur-q');
    if (unsurInput) {
      unsurInput.addEventListener('input', () => {
        const q = unsurInput.value.trim().toLowerCase();
        unsurChips.forEach((c) => c.classList.remove('is-active'));
        unsurChips[0].classList.add('is-active');
        cards.forEach((card) => {
          const nama = card.querySelector('.unsur-tag').textContent.toLowerCase();
          card.hidden = q !== '' && !nama.includes(q);
        });
      });
    }
  }

  /* ---------- Selasar: kuis interaktif 5 soal (satu section) ---------- */  const kuisDataEl = document.getElementById('kuis-data');
  if (kuisDataEl) {
    const kuis = JSON.parse(kuisDataEl.textContent);
    const qEl = document.getElementById('kuis-q');
    const nowEl = document.getElementById('kuis-now');
    const optsEl = document.getElementById('kuis-opts');
    const explEl = document.getElementById('kuis-expl');
    const nextEl = document.getElementById('kuis-next');
    const cardEl = document.getElementById('kuis-card');
    const resultEl = document.getElementById('kuis-result');
    const scoreEl = document.getElementById('kuis-score');
    const msgEl = document.getElementById('kuis-msg');
    const retryEl = document.getElementById('kuis-retry');
    const huruf = ['A', 'B', 'C', 'D'];
    let idx = 0, skor = 0, terkunci = false;

    function renderKuis() {
      const item = kuis[idx];
      terkunci = false;
      nowEl.textContent = idx + 1;
      qEl.textContent = item.q;
      explEl.hidden = true;
      nextEl.hidden = true;
      optsEl.innerHTML = '';
      item.opts.forEach((teks, i) => {
        const b = document.createElement('button');
        b.type = 'button';
        b.className = 'kuis-opt';
        b.textContent = huruf[i] + '. ' + teks;
        b.addEventListener('click', () => jawab(i));
        optsEl.appendChild(b);
      });
    }

    function jawab(i) {
      if (terkunci) return;
      terkunci = true;
      const item = kuis[idx];
      const benar = i === item.a;
      if (benar) skor++;
      [...optsEl.children].forEach((b, j) => {
        b.disabled = true;
        if (j === item.a) b.classList.add('is-ok');
        else if (j === i) b.classList.add('is-no');
      });
      explEl.textContent = benar && item.e_tepat ? item.e_tepat : item.e;
      explEl.hidden = false;
      nextEl.textContent = idx === kuis.length - 1 ? 'Lihat Hasil >' : 'Pertanyaan Berikutnya >';
      nextEl.hidden = false;
      nextEl.focus();
    }

    nextEl.addEventListener('click', () => {
      if (idx < kuis.length - 1) { idx++; renderKuis(); return; }
      cardEl.hidden = true;
      resultEl.hidden = false;
      scoreEl.textContent = 'Skor kamu: ' + skor + ' dari ' + kuis.length;
      msgEl.textContent = skor === kuis.length
        ? 'Luar biasa! Kamu sangat mengenal budaya Nusantara.'
        : skor >= 3 ? 'Hebat! Terus pelajari tujuh unsur kebudayaan di atas.'
        : 'Tidak apa-apa. Baca lagi materinya, lalu coba kuisnya kembali.';
    });

    retryEl.addEventListener('click', () => {
      idx = 0; skor = 0;
      resultEl.hidden = true;
      cardEl.hidden = false;
      renderKuis();
    });

    renderKuis();
  }

  /* ---------- Auth: tombol mata lihat/sembunyi password ---------- */
  document.querySelectorAll('.pass-eye').forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = btn.closest('.pass-wrap').querySelector('input');
      const show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      btn.querySelector('.eye-on').style.display = show ? 'none' : '';
      btn.querySelector('.eye-off').style.display = show ? '' : 'none';
      btn.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Lihat kata sandi');
    });
  });

  /* ---------- Header: dropdown menu akun ---------- */
  const userToggle = document.getElementById('userToggle');
  const userDrop = document.getElementById('userDrop');
  if (userToggle && userDrop) {
    userToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = userDrop.classList.toggle('open');
      userToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', (e) => {
      if (!userDrop.contains(e.target)) userDrop.classList.remove('open');
    });
  }

  /* ---------- Jelajah 360: cari destinasi ---------- */
  const destInput = document.getElementById('destinasi-q');
  if (destInput) {
    const destCards = document.querySelectorAll('.destinasi-card');
    destInput.addEventListener('input', () => {
      const q = destInput.value.trim().toLowerCase();
      destCards.forEach((card) => {
        card.hidden = q !== '' && !card.dataset.nama.includes(q);
      });
    });
  }

  /* ---------- Jelajah 360: agenda per bulan ---------- */
  const agendaChips = document.querySelectorAll('.agenda-chip');
  if (agendaChips.length) {
    const agendaBadge = document.getElementById('agenda-badge');
    const agendaEmpty = document.getElementById('agenda-empty');
    const agendaItems = document.querySelectorAll('.agenda-item');
    agendaChips.forEach((chip) => {
      chip.addEventListener('click', () => {
        agendaChips.forEach((c) => c.classList.remove('is-active'));
        chip.classList.add('is-active');
        const b = chip.dataset.bulan;
        agendaBadge.textContent = b.toUpperCase();
        let ada = false;
        agendaItems.forEach((item) => {
          const tampil = item.dataset.bulan === b;
          item.hidden = !tampil;
          item.classList.remove('anim');
          void item.offsetWidth;
          if (tampil) { ada = true; item.classList.add('anim'); }
        });
        agendaEmpty.hidden = ada;
        agendaEmpty.classList.remove('anim');
        void agendaEmpty.offsetWidth;
        if (!ada) agendaEmpty.classList.add('anim');
      });
    });
  }

  /* ---------- Chatbot AI Kaya Nusantara ---------- */
  const chatbotFab = document.getElementById('chatbotFab');
  const chatbotPanel = document.getElementById('chatbotPanel');
  const chatbotGreet = document.getElementById('chatbotGreet');
  const chatbotBody = document.getElementById('chatbotBody');
  const chatbotForm = document.getElementById('chatbotForm');
  const chatbotInput = document.getElementById('chatbotInput');
  if (chatbotFab && chatbotPanel) {
    const togglePanel = (show) => {
      chatbotPanel.hidden = !show;
      chatbotGreet?.classList.add('hidden');
      if (show) chatbotInput.focus();
    };
    chatbotFab.addEventListener('click', () => togglePanel(chatbotPanel.hidden));
    document.getElementById('chatbotClose').addEventListener('click', () => togglePanel(false));
    const bubble = (teks, kelas) => {
      const b = document.createElement('div');
      b.className = 'chatbot-bubble ' + kelas;
      b.textContent = teks;
      chatbotBody.appendChild(b);
      chatbotBody.scrollTop = chatbotBody.scrollHeight;
      return b;
    };
    chatbotForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const pesan = chatbotInput.value.trim();
      if (!pesan) return;
      bubble(pesan, 'me');
      chatbotInput.value = '';
      const token = chatbotForm.querySelector('input[name="_token"]').value;
      const loading = bubble('Sedang mengetik...', 'bot');
      const btn = chatbotForm.querySelector('button');
      btn.disabled = true;
      try {
        const res = await fetch('/chat', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
          body: JSON.stringify({ pesan }),
        });
        const data = await res.json();
        loading.textContent = data.pesan || 'Maaf, aku belum bisa menjawab itu.';
      } catch (err) {
        loading.textContent = 'Koneksi terputus. Coba lagi nanti ya.';
      }
      btn.disabled = false;
      chatbotInput.focus();
    });
  }

  /* ---------- Guru: pop-up beri nilai ---------- */
  const nilaiModal = document.getElementById('nilai-modal');
  if (nilaiModal) {
    const nilaiForm = document.getElementById('nilai-form');
    const nilaiNama = document.getElementById('nilai-nama');
    const closeNilai = () => { nilaiModal.hidden = true; document.body.classList.remove('modal-lock'); };
    document.querySelectorAll('[data-nilai]').forEach((btn) => {
      btn.addEventListener('click', () => {
        nilaiForm.action = '/ruang-belajar/guru/penilaian/' + btn.dataset.nilai;
        nilaiNama.textContent = btn.dataset.nama;
        nilaiModal.hidden = false;
        document.body.classList.add('modal-lock');
        nilaiModal.querySelector('.lms-dialog-close').focus({ preventScroll: true });
      });
    });
    nilaiModal.querySelector('.lms-dialog-close').addEventListener('click', closeNilai);
    nilaiModal.addEventListener('click', (e) => { if (e.target === nilaiModal) closeNilai(); });
  }

  /* ---------- LMS: filter penilaian (kelas/unsur, visual) ---------- */
  const filterKelas = document.getElementById('filterKelas');
  const filterUnsur = document.getElementById('filterUnsur');
  if (filterKelas && filterUnsur) {
    const rows = document.querySelectorAll('.lms-list-row[data-kelas]');
    const apply = () => {
      rows.forEach((row) => {
        const okKelas = !filterKelas.value || row.dataset.kelas === filterKelas.value;
        const okUnsur = !filterUnsur.value || (row.dataset.unsur || '').includes(filterUnsur.value);
        row.hidden = !(okKelas && okUnsur);
      });
    };
    filterKelas.addEventListener('change', apply);
    filterUnsur.addEventListener('change', apply);
  }

  /* ---------- LMS: notifikasi popup ---------- */
  const notifBtn = document.getElementById('notifBtn');
  const notifPop = document.getElementById('notifPop');
  if (notifBtn && notifPop) {
    notifBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = notifPop.classList.toggle('open');
      notifBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', (e) => {
      if (!notifPop.contains(e.target)) notifPop.classList.remove('open');
    });
    const okBtn = document.getElementById('notifOk');
    if (okBtn) okBtn.addEventListener('click', () => notifPop.classList.remove('open'));
  }

  /* ---------- LMS: filter status materi Kelas Saya ---------- */
  document.querySelectorAll('.lms-chip[data-status]').forEach((chip) => {
    chip.addEventListener('click', () => {
      document.querySelectorAll('.lms-chip[data-status]').forEach((c) => c.classList.remove('is-active'));
      chip.classList.add('is-active');
      const s = chip.dataset.status;
      let tampil = 0;
      document.querySelectorAll('.lms-materi').forEach((card) => {
        const showCard = s === 'semua' || card.dataset.status === s;
        card.hidden = !showCard;
        if (showCard) tampil++;
      });
      const empty = document.getElementById('kelasEmpty');
      if (empty) empty.hidden = tampil > 0;
    });
  });

  /* ---------- LMS: pop-up materi + Mengerti ---------- */
  const materiModal = document.getElementById('materi-modal');
  const materiDataEl = document.getElementById('materi-data');
  if (materiModal && materiDataEl) {
    const data = JSON.parse(materiDataEl.textContent);
    const closeMateri = () => { materiModal.hidden = true; document.body.classList.remove('modal-lock'); };
    document.querySelectorAll('.lms-buka[data-materi]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const slug = btn.dataset.materi;
        const d = data[slug];
        if (!d) return;
        document.getElementById('materi-img').src = '/assets/img/materi/' + slug + '.webp';
        document.getElementById('materi-img').alt = d.nama;
        document.getElementById('materi-judul').textContent = d.nama;
        document.getElementById('materi-desk').textContent = d.desk;
        document.getElementById('materi-form').action = '/ruang-belajar/materi/' + slug + '/selesai';
        materiModal.hidden = false;
        document.body.classList.add('modal-lock');
        document.getElementById('materi-close').focus({ preventScroll: true });
      });
    });
    document.getElementById('materi-close').addEventListener('click', closeMateri);
    materiModal.addEventListener('click', (e) => { if (e.target === materiModal) closeMateri(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMateri(); });
  }

  /* ---------- LMS: pop-up tambah (kelas/materi/tugas/kuis) ---------- */
  const pasangan = [['addKelasBtn', 'kelas-modal'], ['addMateriBtn', 'materi-modal'], ['addTugasBtn', 'tugas-modal'], ['addKuisBtn', 'kuis-modal']];
  pasangan.forEach(([btnId, modalId]) => {
    const btn = document.getElementById(btnId);
    const modal = document.getElementById(modalId);
    if (!btn || !modal) return;
    btn.addEventListener('click', () => {
      modal.hidden = false;
      document.body.classList.add('modal-lock');
      modal.querySelector('.unsur-close').focus({ preventScroll: true });
    });
    const close = () => { modal.hidden = true; document.body.classList.remove('modal-lock'); };
    modal.querySelector('.lms-dialog-close, .unsur-close').addEventListener('click', close);
    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
    modal.querySelector('[data-close]')?.addEventListener('click', close);
  });

  /* ---------- Selasar: pop-up Pelajari Selengkapnya per unsur ---------- */
  const modalEl = document.getElementById('unsur-modal');
  const detailEl = document.getElementById('unsur-detail');
  if (modalEl && detailEl) {
    const detail = JSON.parse(detailEl.textContent);
    const base = (modalEl.dataset.base || '').replace(/\/$/, '');
    const fields = {
      img: document.getElementById('unsur-modal-img'),
      judul: document.getElementById('unsur-modal-judul'),
      desk: document.getElementById('unsur-modal-desk'),
      fungsi: document.getElementById('unsur-modal-fungsi'),
      contoh: document.getElementById('unsur-modal-contoh'),
      nilai: document.getElementById('unsur-modal-nilai'),
      aktivitas: document.getElementById('unsur-modal-aktivitas'),
    };
    let savedY = 0;
    const closeModal = () => {
      modalEl.hidden = true;
      document.body.classList.remove('modal-lock');
      window.scrollTo(0, savedY);
    };
    document.querySelectorAll('.unsur-more[data-unsur]').forEach((link) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const d = detail[link.dataset.unsur];
        if (!d) return;
        fields.img.src = base + '/assets/img/unsur/' + link.dataset.unsur + '.webp';
        fields.img.alt = d.nama;
        fields.judul.textContent = d.nama;
        fields.desk.textContent = d.desk;
        fields.fungsi.textContent = d.fungsi;
        fields.contoh.textContent = d.contoh;
        fields.nilai.textContent = d.nilai;
        fields.aktivitas.textContent = d.aktivitas;
        savedY = window.scrollY;
        modalEl.hidden = false;
        document.body.classList.add('modal-lock');
        document.getElementById('unsur-close').focus({ preventScroll: true });
      });
    });
    document.getElementById('unsur-close').addEventListener('click', closeModal);
    modalEl.addEventListener('click', (e) => { if (e.target === modalEl) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
  }
});

