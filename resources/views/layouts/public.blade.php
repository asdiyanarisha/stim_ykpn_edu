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
@php
  $publicRoutes = [
    '/', 'berita', 'berita/*', 'dosen', 'profil', 'pmb', 'fasilitas', 'prestasi', 'spmi',
    'sasaran-pendidikan', 'cara-mencapai-sasaran', 'beban-studi', 'sks',
    'jenjang-studi', 'kegiatan-akademik', 'dosen-pembimbing', 'sanksi-akademik',
    'kalender-akademik', 'kehadiran-kuliah', 'tata-tertib-kuliah', 'jumlah-kehadiran',
    'seminar-proposal', 'ketentuan-ujian', 'logo', 'sambutan-ketua', 'pimpinan', 'visi-misi',
    'unduh', 'program', 'program/*'
  ];
  
  $isPublicPage = request()->is(...$publicRoutes);
@endphp

@if($isPublicPage)
  @include('components.navbar')
@endif

@yield('content')

@if($isPublicPage)
  @include('components.footer')
@endif

@stack('scripts')
</body>
</html>
