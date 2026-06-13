{{--
  SEO Head Component - STIM YKPN Yogyakarta
  Usage:
    <x-seo-head
      title="Judul Halaman"
      description="Deskripsi singkat halaman (max 160 karakter)"
      :ogImage="$imageUrl"        (opsional, default ke logo STIM)
      ogType="website"            (opsional, default: website)
      :canonicalUrl="url('...')" (opsional, default ke URL saat ini)
      :schemaJson="$schemaArray"  (opsional, JSON-LD tambahan)
    />
--}}
@props([
    'title'        => 'STIM YKPN Yogyakarta — School of Management',
    'description'  => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.',
    'ogImage'      => null,
    'ogType'       => 'website',
    'canonicalUrl' => null,
    'schemaJson'   => null,
    // Google Search Console & Bing verification — isi di config/seo.php atau env
    'googleVerification' => env('GOOGLE_SITE_VERIFICATION', ''),
    'bingVerification'   => env('BING_SITE_VERIFICATION', ''),
])

@php
    $siteName      = 'STIM YKPN Yogyakarta';
    $defaultOgImg  = url('/images/img/logo/logo-stim-new.png');
    $resolvedImg   = $ogImage ? $ogImage : $defaultOgImg;
    $resolvedUrl   = $canonicalUrl ? $canonicalUrl : url()->current();
    // Strip query strings from canonical URL to avoid duplicate content
    $resolvedUrl   = strtok($resolvedUrl, '?');
    $fullTitle     = str_contains($title, 'STIM YKPN') ? $title : $title . ' — STIM YKPN Yogyakarta';
@endphp

{{-- ==========================================
     BASIC SEO META TAGS
     ========================================== --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ Str::limit($description, 160) }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow">
@if($googleVerification)
<meta name="google-site-verification" content="{{ $googleVerification }}">
@endif
@if($bingVerification)
<meta name="msvalidate.01" content="{{ $bingVerification }}">
@endif

{{-- ==========================================
     CANONICAL URL (mencegah duplikat konten)
     ========================================== --}}
<link rel="canonical" href="{{ $resolvedUrl }}">

{{-- ==========================================
     FAVICON (multi-size untuk semua browser & device)
     ========================================== --}}
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicon-180x180.png">
<meta name="theme-color" content="#f18721">

{{-- ==========================================
     OPEN GRAPH / FACEBOOK
     ========================================== --}}
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ Str::limit($description, 200) }}">
<meta property="og:image" content="{{ $resolvedImg }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="{{ $resolvedUrl }}">
<meta property="og:locale" content="id_ID">

{{-- ==========================================
     TWITTER CARD
     ========================================== --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@stimykpn">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ Str::limit($description, 200) }}">
<meta name="twitter:image" content="{{ $resolvedImg }}">

{{-- ==========================================
     ADDITIONAL SCHEMA (slot opsional)
     ========================================== --}}
@if($schemaJson)
<script type="application/ld+json">
{!! json_encode($schemaJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- ==========================================
     GOOGLE ANALYTICS (GA4)
     ========================================== --}}
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RT4REKCKBS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RT4REKCKBS');
</script>
