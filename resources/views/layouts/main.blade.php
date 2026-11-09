{{-- Layout utama Ã¢â‚¬â€ Kaya Nusantara --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Kaya Nusantara Ã¢â‚¬â€ Jendela Edukatif Digital Budaya')</title>
  <meta name="description" content="Kenali, pelajari, dan lestarikan keberagaman budaya Indonesia melalui pengalaman belajar yang interaktif dan menyenangkan.">
  <link rel="icon" href="{{ asset('assets/img/logo.ico') }}?v=2" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/img/logo-putih.png') }}?v=2" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset('assets/img/logo-putih.png') }}?v=2">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero/hero-wayang.webp') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=62">
  {{-- Font display swap + preconnect sudah di atas; JS defer di footer --}}
</head>
<body>
  @include('partials.header')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>
