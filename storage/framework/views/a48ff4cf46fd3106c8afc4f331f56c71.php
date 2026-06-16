

<?php $__env->startSection('seo'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Biaya Kuliah — STIM YKPN Yogyakarta','description' => 'Informasi lengkap biaya kuliah, UKT, dan biaya pendaftaran mahasiswa baru STIM YKPN Yogyakarta 2026/2027. Tersedia beasiswa dan keringanan biaya.','canonicalUrl' => url('/biaya-kuliah')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Biaya Kuliah — STIM YKPN Yogyakarta','description' => 'Informasi lengkap biaya kuliah, UKT, dan biaya pendaftaran mahasiswa baru STIM YKPN Yogyakarta 2026/2027. Tersedia beasiswa dan keringanan biaya.','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/biaya-kuliah'))]); ?>
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
    body {
      background-color: #f8fafc;
    }

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
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
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
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
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
      .academic-layout {
        grid-template-columns: 1fr;
      }

      .academic-sidebar {
        position: relative;
        top: 0;
      }
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Biaya Kuliah</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Informasi
        rincian biaya pendidikan untuk jenjang S1 Manajemen, S1 Bisnis Digital, dan D3 Manajemen di STIM YKPN
        Yogyakarta.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">

      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">PMB</div>
        <ul class="sidebar-menu">
          <li><a href="/pendaftaran-pmb">Pendaftaran</a></li>
          <li><a href="/biaya-kuliah" class="active">Biaya Kuliah</a></li>
          <li><a href="/beasiswa">Beasiswa</a></li>
          <li><a href="/program-reguler">Program Reguler</a></li>
          <li><a href="/program-ekstensi">Program Ekstensi</a></li>
          <li><a href="/pengumuman-diterima">Pengumuman Diterima</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Rincian Biaya Pendidikan</h2>
        </div>
        <div class="article-body">

          <p style="margin-bottom: 30px;">Berikut adalah rincian biaya pendidikan untuk program studi S1 Manajemen, S1
            Bisnis Digital, dan D3 Manajemen di STIM YKPN Yogyakarta.</p>

          <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px;">

          <!-- S1 Manajemen Card -->
          <div
            style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--blue-500);">
            <h3 style="color: var(--blue-500); font-size: 1.4rem; margin-bottom: 20px; text-align: center;">S1
              Manajemen</h3>
            <h4
              style="font-size: 1.1rem; color: #333; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
              Biaya Kuliah</h4>
            <ul style="list-style: none; padding: 0; margin: 0 0 15px 0;">
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>SPP Tetap</span>
                <strong>Rp 1.900.000</strong></li>
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>Biaya SPP Variabel/SKS</span>
                <strong>Rp 185.000</strong></li>
            </ul>
          </div>

          <!-- D3 Manajemen Card -->
          <div
            style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid var(--orange-500);">
            <h3 style="color: var(--orange-500); font-size: 1.4rem; margin-bottom: 20px; text-align: center;">D3
              Manajemen</h3>

            <h4
              style="font-size: 1.1rem; color: #333; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
              Biaya Kuliah</h4>
            <ul style="list-style: none; padding: 0; margin: 0 0 15px 0;">
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>SPP Tetap</span>
                <strong>Rp 1.400.000</strong></li>
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>Biaya SPP Variabel/SKS</span>
                <strong>Rp 155.000</strong></li>
            </ul>
          </div>

          <!-- S1 Bisnis Digital Card -->
          <div
            style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
            <h3 style="color: #10b981; font-size: 1.4rem; margin-bottom: 20px; text-align: center;">S1 Bisnis Digital
            </h3>

            <h4
              style="font-size: 1.1rem; color: #333; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
              Biaya Kuliah</h4>
            <ul style="list-style: none; padding: 0; margin: 0 0 15px 0;">
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>SPP Tetap</span>
                <strong>Rp 1.900.000</strong></li>
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px;"><span>Biaya SPP Variabel/SKS</span>
                <strong>Rp 185.000</strong></li>
            </ul>
          </div>

        </div>

        <!-- Special Offer Banner -->
        <div
          style="background: linear-gradient(135deg, var(--blue-500), var(--navy-800)); border-radius: 12px; padding: 30px; color: white; text-align: center; box-shadow: 0 10px 25px rgba(10, 37, 88, 0.2);">
          <a href="/pendaftaran-pmb" class="btn btn-primary"
            style="background: var(--orange-500); border: none; padding: 12px 30px; font-size: 1.1rem; border-radius: 8px; text-decoration: none; color: white; font-weight: 600; display: inline-block; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(239, 124, 0, 0.3);">Daftar
            Sekarang</a>
        </div>

      </div>
    </article>

  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/biaya-kuliah.blade.php ENDPATH**/ ?>