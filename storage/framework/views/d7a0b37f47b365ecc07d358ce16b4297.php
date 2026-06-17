<!DOCTYPE html>
<html lang="id">
<head>
  <?php echo $__env->yieldContent('seo'); ?>
  
  <!-- Favicon -->
  <link rel="icon" type="image/webp" href="/images/logo-stim-baru.webp?v=2">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js', 'resources/js/frontend.js']); ?>

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<?php
  $publicRoutes = [
    '/', 'berita', 'berita/*', 'dosen', 'profil', 'pendaftaran-pmb', 'fasilitas', 'prestasi', 'spmi',
    'sasaran-pendidikan', 'cara-mencapai-sasaran', 'beban-studi', 'sks',
    'jenjang-studi', 'kegiatan-akademik', 'dosen-pembimbing', 'sanksi-akademik',
    'kalender-akademik', 'kehadiran-kuliah', 'tata-tertib-kuliah', 'jumlah-kehadiran',
    'seminar-proposal', 'ketentuan-ujian', 'logo', 'sambutan-ketua', 'pimpinan', 'visi-misi',
    'unduh', 'program', 'program/*', 'biaya-kuliah', 'beasiswa', 'program-reguler',
    'program-ekstensi', 'pengumuman-diterima', 'kegiatan-mahasiswa', 'ukm', 'ppkpt',
    'pengumuman', 'video', 'informasi-tempat-tinggal', 'brosur', 'alumni', 'lowongan-kerja',
    'lowongan-kerja/*', 'whatsapp-contact', 'jurnal-penelitian', 'jurnal-pengabdian', 'perpustakaan'
  ];
  
  $isPublicPage = request()->is(...$publicRoutes);
?>

<?php if($isPublicPage): ?>
  <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<?php if($isPublicPage): ?>
  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/layouts/public.blade.php ENDPATH**/ ?>