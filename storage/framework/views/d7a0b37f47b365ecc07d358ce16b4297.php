<!DOCTYPE html>
<html lang="id">
<head>
  <?php echo $__env->yieldContent('seo'); ?>
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/img/logo/logo-stim-new.webp">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js', 'resources/js/frontend.js']); ?>

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>

  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/layouts/public.blade.php ENDPATH**/ ?>