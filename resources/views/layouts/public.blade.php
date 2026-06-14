<!DOCTYPE html>
<html lang="id">
<head>
  @yield('seo')
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/img/logo/logo-stim-new.webp">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js', 'resources/js/frontend.js'])

  @stack('styles')
</head>
<body>

  @include('components.navbar')

  @yield('content')

  @include('components.footer')

  @stack('scripts')
</body>
</html>
