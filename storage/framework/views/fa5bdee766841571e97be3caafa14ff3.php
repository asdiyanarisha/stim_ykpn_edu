<?php $__env->startSection('seo'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Brosur & Materi PMB — STIM YKPN Yogyakarta','description' => 'Unduh brosur resmi dan materi penerimaan mahasiswa baru STIM YKPN Yogyakarta.','canonicalUrl' => url('/brosur')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Brosur & Materi PMB — STIM YKPN Yogyakarta','description' => 'Unduh brosur resmi dan materi penerimaan mahasiswa baru STIM YKPN Yogyakarta.','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/brosur'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $attributes = $__attributesOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $component = $__componentOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__componentOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
  <style>
    body { background-color: #f8fafc; }

    .academic-content-section {
      padding: 80px 0;
    }

    .academic-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 40px;
      align-items: start;
    }

    /* Sidebar Navigation */
    .academic-sidebar {
      background: #ffffff;
      border-radius: 16px;
      padding: 20px 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
      border: 1px solid #e2e8f0;
      position: sticky;
      top: 100px;
    }

    .sidebar-title {
      font-size: 14px;
      font-weight: 800;
      color: var(--gray-400);
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 0 24px 12px;
      border-bottom: 1px solid #e2e8f0;
      margin-bottom: 12px;
    }

    .sidebar-menu {
      list-style: none;
    }

    .sidebar-menu li a {
      display: block;
      padding: 12px 24px;
      color: var(--navy-900);
      font-weight: 600;
      font-size: 15px;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
    }

    .sidebar-menu li a:hover {
      background: #f8fafc;
      color: var(--orange-500);
    }

    .sidebar-menu li a.active {
      color: var(--orange-500);
      background: rgba(241, 135, 33, 0.05);
      border-left-color: var(--orange-500);
    }

    /* Main Article */
    .academic-article {
      background: #ffffff;
      border-radius: 20px;
      padding: 50px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.04);
      border: 1px solid #e2e8f0;
    }

    .article-header {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px dashed #cbd5e1;
    }

    .article-header h2 {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy-900);
    }

    .article-body {
      color: #475569;
      font-size: 16px;
      line-height: 1.8;
    }

    .article-body p {
      margin-bottom: 20px;
    }

    .target-list {
      list-style: none;
      margin-top: 30px;
    }

    .target-list li {
      position: relative;
      padding-left: 40px;
      margin-bottom: 24px;
      background: #f8fafc;
      padding: 24px 24px 24px 60px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
    }
    .target-list li::before {
      content: '';
      position: absolute;
      left: 20px;
      top: 26px;
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23f18721' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='9 18 15 12 9 6'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
    }

    .target-list li h4 {
      font-size: 18px;
      color: var(--navy-900);
      margin-bottom: 8px;
    }

    @media (max-width: 992px) {
      .academic-layout { grid-template-columns: 1fr; }
      .academic-sidebar { position: relative; top: 0; }
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Brosur</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Informasi program pendidikan STIM YKPN Yogyakarta dalam format dokumen brosur.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Informasi</div>
        <ul class="sidebar-menu">
          <li><a href="/brosur" class="active">Brosur</a></li>
          <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">Portal</a></li>
          <li><a href="/unduh">Unduh</a></li>
          <li><a href="/alumni">Alumni</a></li>
          <li><a href="/lowongan-kerja">Lowongan Kerja</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Brosur STIM YKPN</h2>
        </div>
        <div class="article-body">
          <?php $__empty_1 = true; $__currentLoopData = $brochures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brochure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="brochure-item" style="margin-bottom: 30px; <?php if(!$loop->last): ?> border-bottom: 1px dashed #cbd5e1; padding-bottom: 30px; <?php endif; ?>">
              <?php if($brochure->description): ?>
                <p style="margin-bottom: 20px;"><?php echo e($brochure->description); ?></p>
              <?php endif; ?>
              
              <div style="text-align: center; padding: 40px; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1; margin-bottom: 30px;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--primary-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 16px;">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
                <h3 style="font-size: 1.25rem; color: var(--navy-900); margin-bottom: 12px;"><?php echo e($brochure->title); ?></h3>
                <p style="color: var(--gray-500); margin-bottom: 24px;">
                  Format: <?php echo e($brochure->file_path ? strtoupper(pathinfo(parse_url($brochure->file_path, PHP_URL_PATH), PATHINFO_EXTENSION)) : 'PDF'); ?> 
                  <?php if($brochure->file_size): ?>
                    | Ukuran: <?php echo e($brochure->file_size); ?>

                  <?php endif; ?>
                </p>
                <?php if($brochure->file_path): ?>
                  <a href="<?php echo e($brochure->file_path); ?>" class="btn btn-primary" style="display: inline-flex;" download target="_blank" onclick="gtag('event', 'download_brosur')">
                    Unduh Brosur
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                      <polyline points="7 10 12 15 17 10"></polyline>
                      <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                  </a>
                <?php else: ?>
                  <span style="color: var(--gray-500);">File tidak tersedia</span>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align: center; padding: 40px; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">
              <p style="color: var(--gray-500); margin-bottom: 0;">Belum ada brosur yang tersedia saat ini.</p>
            </div>
          <?php endif; ?>
        </div>
      </article>

    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/brosur.blade.php ENDPATH**/ ?>