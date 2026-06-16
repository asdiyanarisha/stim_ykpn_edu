
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title'        => 'STIM YKPN Yogyakarta — School of Management',
    'description'  => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.',
    'ogImage'      => null,
    'ogType'       => 'website',
    'canonicalUrl' => null,
    'schemaJson'   => null,
    // Google Search Console & Bing verification — isi di config/seo.php atau env
    'googleVerification' => env('GOOGLE_SITE_VERIFICATION', ''),
    'bingVerification'   => env('BING_SITE_VERIFICATION', ''),
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title'        => 'STIM YKPN Yogyakarta — School of Management',
    'description'  => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.',
    'ogImage'      => null,
    'ogType'       => 'website',
    'canonicalUrl' => null,
    'schemaJson'   => null,
    // Google Search Console & Bing verification — isi di config/seo.php atau env
    'googleVerification' => env('GOOGLE_SITE_VERIFICATION', ''),
    'bingVerification'   => env('BING_SITE_VERIFICATION', ''),
]); ?>
<?php foreach (array_filter(([
    'title'        => 'STIM YKPN Yogyakarta — School of Management',
    'description'  => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.',
    'ogImage'      => null,
    'ogType'       => 'website',
    'canonicalUrl' => null,
    'schemaJson'   => null,
    // Google Search Console & Bing verification — isi di config/seo.php atau env
    'googleVerification' => env('GOOGLE_SITE_VERIFICATION', ''),
    'bingVerification'   => env('BING_SITE_VERIFICATION', ''),
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $siteName      = 'STIM YKPN Yogyakarta';
    $defaultOgImg  = url('/images/img/logo/logo-stim-new.png');
    $resolvedImg   = $ogImage ? $ogImage : $defaultOgImg;
    $resolvedUrl   = $canonicalUrl ? $canonicalUrl : url()->current();
    // Strip query strings from canonical URL to avoid duplicate content
    $resolvedUrl   = strtok($resolvedUrl, '?');
    $fullTitle     = str_contains($title, 'STIM YKPN') ? $title : $title . ' — STIM YKPN Yogyakarta';
?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($fullTitle); ?></title>
<meta name="description" content="<?php echo e(Str::limit($description, 160)); ?>">
<meta name="author" content="<?php echo e($siteName); ?>">
<meta name="robots" content="index, follow">
<?php if($googleVerification): ?>
<meta name="google-site-verification" content="<?php echo e($googleVerification); ?>">
<?php endif; ?>
<?php if($bingVerification): ?>
<meta name="msvalidate.01" content="<?php echo e($bingVerification); ?>">
<?php endif; ?>


<link rel="canonical" href="<?php echo e($resolvedUrl); ?>">


<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicon-180x180.png">
<meta name="theme-color" content="#f18721">


<meta property="og:type" content="<?php echo e($ogType); ?>">
<meta property="og:site_name" content="<?php echo e($siteName); ?>">
<meta property="og:title" content="<?php echo e($fullTitle); ?>">
<meta property="og:description" content="<?php echo e(Str::limit($description, 200)); ?>">
<meta property="og:image" content="<?php echo e($resolvedImg); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="<?php echo e($resolvedUrl); ?>">
<meta property="og:locale" content="id_ID">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@stimykpn">
<meta name="twitter:title" content="<?php echo e($fullTitle); ?>">
<meta name="twitter:description" content="<?php echo e(Str::limit($description, 200)); ?>">
<meta name="twitter:image" content="<?php echo e($resolvedImg); ?>">


<?php if($schemaJson): ?>
<script type="application/ld+json">
<?php echo json_encode($schemaJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

</script>
<?php endif; ?>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RT4REKCKBS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RT4REKCKBS');
</script>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/components/seo-head.blade.php ENDPATH**/ ?>