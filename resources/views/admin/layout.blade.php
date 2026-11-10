<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') — Kaya Nusantara</title>
  <link rel="icon" href="{{ asset('assets/img/logo.ico') }}?v=2" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root { --bg:#f4efe6; --card:#fff; --ink:#201a17; --muted:#6b5a4d; --line:#e6dccb; --accent:#5c2e26; --gold:#e0b251; }
    *{box-sizing:border-box} body{margin:0;font-family:'Montserrat',sans-serif;background:var(--bg);color:var(--ink)}
    .admin-wrap{display:flex;min-height:100vh}
    .admin-side{width:260px;background:#201a17;color:#f7efe0;padding:22px 18px;position:sticky;top:0;height:100vh;overflow:auto}
    .admin-brand{display:flex;align-items:center;gap:10px;font-weight:700;margin-bottom:18px}
    .admin-brand img{height:28px}
    .admin-nav h4{margin:18px 10px 8px;font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:#c9b79a}
    .admin-nav a{display:block;padding:9px 12px;border-radius:10px;color:#f7efe0;text-decoration:none;font-size:.9rem;margin-bottom:4px}
    .admin-nav a:hover,.admin-nav a.active{background:rgba(224,178,81,.16);color:#fff}
    .admin-main{flex:1;padding:28px 30px}
    .admin-top{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:20px}
    .admin-top h1{margin:0;font-size:1.5rem}
    .card{background:var(--card);border:1px solid var(--line);border-radius:14px;padding:18px;box-shadow:0 8px 24px rgba(32,26,23,.05)}
    .btn{display:inline-flex;align-items:center;gap:6px;padding:9px 14px;border-radius:10px;border:1px solid var(--accent);background:var(--accent);color:#fff;text-decoration:none;font-weight:600;font-size:.88rem;cursor:pointer}
    .btn.outline{background:#fff;color:var(--accent)}
    .btn.danger{background:#8b2f2f;border-color:#8b2f2f}
    .btn.sm{padding:6px 10px;font-size:.8rem;border-radius:8px}
    .flash{padding:12px 14px;border-radius:10px;margin-bottom:14px;font-size:.9rem}
    .flash.ok{background:#e9f6ec;color:#245a34;border:1px solid #bfe3c8}
    .flash.err{background:#fdecec;color:#7a2222;border:1px solid #f1c2c2}
    table{width:100%;border-collapse:collapse;font-size:.9rem}
    th,td{padding:10px 10px;border-bottom:1px solid var(--line);text-align:left;vertical-align:top}
    th{font-size:.78rem;text-transform:uppercase;letter-spacing:.06em;color:var(--muted)}
    .actions{display:flex;gap:8px;flex-wrap:wrap}
    .muted{color:var(--muted);font-size:.85rem}
    .grid{display:grid;gap:14px}
    .grid.cols-2{grid-template-columns:repeat(2,1fr)}
    .grid.cols-3{grid-template-columns:repeat(3,1fr)}
    label{display:block;font-size:.85rem;font-weight:600;margin-bottom:6px}
    input[type=text],input[type=email],input[type=password],input[type=number],input[type=url],select,textarea{width:100%;padding:10px 12px;border:1.5px solid var(--line);border-radius:10px;font:inherit;background:#fff}
    textarea{min-height:110px;resize:vertical}
    .field{margin-bottom:14px}
    .check{display:flex;align-items:center;gap:8px;font-weight:500}
    .thumb{width:64px;height:44px;object-fit:cover;border-radius:8px;border:1px solid var(--line);background:#f7f2e8}
    .stat{padding:16px}
    .stat b{display:block;font-size:1.6rem;color:var(--accent)}
    .stat span{color:var(--muted);font-size:.85rem}
    @media(max-width:900px){.admin-wrap{flex-direction:column}.admin-side{width:100%;height:auto;position:relative}.grid.cols-2,.grid.cols-3{grid-template-columns:1fr}.admin-main{padding:18px}}
  </style>
</head>
<body>
  <div class="admin-wrap">
    <aside class="admin-side">
      <div class="admin-brand"><img src="{{ asset('assets/img/logo-putih.png') }}?v=2" alt=""> Admin</div>
      <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <h4>Home</h4>
        <a href="{{ route('admin.faq.index') }}">FAQ</a>
        <a href="{{ route('admin.testimoni.index') }}">Testimoni</a>
        <a href="{{ route('admin.mitra.index') }}">Mitra Kolaborasi</a>
        <a href="{{ route('admin.langkah-galeri.index') }}">Langkah: Galeri</a>
        <a href="{{ route('admin.langkah-publikasi.index') }}">Langkah: Publikasi</a>
        <a href="{{ route('admin.langkah-dokumentasi.index') }}">Langkah: Dokumentasi</a>
        <h4>Selasar Budaya</h4>
        <a href="{{ route('admin.berita.index') }}">Berita Terbaru</a>
        <a href="{{ route('admin.toko.index') }}">Toko (Produk)</a>
        <h4>Jelajah 360</h4>
        <a href="{{ route('admin.agenda.index') }}">Agenda / Kalender</a>
        <a href="{{ route('admin.destinasi.index') }}">Destinasi 360</a>
        <h4>Akun</h4>
        <a href="{{ route('admin.users.index') }}">Users</a>
        <h4>Lainnya</h4>
        <a href="{{ route('home') }}" target="_blank">Lihat Website</a>
        <form method="POST" action="{{ route('admin.logout') }}" style="margin-top:12px">
          @csrf
          <button type="submit" style="width:100%;text-align:left;padding:9px 12px;border-radius:10px;border:0;background:rgba(255,255,255,.08);color:#f7efe0;cursor:pointer;font:inherit">Logout Admin</button>
        </form>
      </nav>
    </aside>
    <main class="admin-main">
      @if(session('ok')) <div class="flash ok">{{ session('ok') }}</div> @endif
      @if(session('err')) <div class="flash err">{{ session('err') }}</div> @endif
      @if($errors->any())
        <div class="flash err"><ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
      @endif
      @yield('content')
    </main>
  </div>
</body>
</html>
