<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Kaya Nusantara</title>
  <link rel="icon" href="{{ asset('assets/img/logo.ico') }}?v=2" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Montserrat',sans-serif;background:#201a17;color:#201a17;padding:20px}
    .box{width:100%;max-width:420px;background:#f7efe0;border:1px solid #e6dccb;border-radius:18px;padding:28px 28px 24px;box-shadow:0 20px 50px rgba(0,0,0,.35)}
    h1{margin:0 0 6px;font-size:1.5rem;color:#201a17}
    p.sub{margin:0 0 18px;color:#6b5a4d;font-size:.92rem}
    .err{background:#fdecec;color:#7a2222;border:1px solid #f1c2c2;padding:10px 12px;border-radius:10px;margin-bottom:14px;font-size:.9rem}
    label{display:block;font-size:.85rem;font-weight:600;margin-bottom:6px;color:#201a17}
    input{width:100%;padding:11px 12px;border:1.5px solid #e0d4c1;border-radius:10px;font:inherit;margin-bottom:14px;box-sizing:border-box}
    input:focus{outline:none;border-color:#e0b251;box-shadow:0 0 0 3px rgba(224,178,81,.2)}
    .btn{width:100%;padding:11px 14px;border:none;border-radius:10px;background:#5c2e26;color:#fff;font-weight:700;font-size:.95rem;cursor:pointer}
    .btn:hover{filter:brightness(1.05)}
    .check{display:flex;align-items:center;gap:8px;font-weight:500;font-size:.88rem;margin:-4px 0 14px}
    .check input{width:auto;margin:0}
    .back{display:inline-block;margin-top:14px;color:#5c2e26;font-size:.88rem;text-decoration:none;font-weight:600}
  </style>
</head>
<body>
  <div class="box">
    <h1>Login Admin</h1>
    <p class="sub">Masuk untuk mengelola konten Kaya Nusantara.</p>
    @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf
      <label>Username / Email</label>
      <input type="text" name="username" value="{{ old('username') }}" required autofocus placeholder="adminkayanusantara">
      <label>Password</label>
      <input type="password" name="password" required placeholder="••••••••">
      <label class="check"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
      <button class="btn" type="submit">Masuk ke Dashboard</button>
    </form>
    <a class="back" href="{{ route('home') }}">&larr; Kembali ke Website</a>
  </div>
</body>
</html>
