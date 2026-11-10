{{-- Layout khusus auth (login/registrasi) â€” tanpa header & footer, background auto-slide seperti hero Home --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Masuk â€” Kaya Nusantara')</title>
  <link rel="icon" href="{{ asset('assets/img/logo.ico') }}?v=2" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/img/logo-putih.png') }}?v=2" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=45">
</head>
<body>
  @yield('content')
  <script src="{{ asset('assets/js/main.js') }}?v=20" defer></script>
</body>
</html>


