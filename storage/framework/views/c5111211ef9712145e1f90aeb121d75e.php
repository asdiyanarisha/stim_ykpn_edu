<?php $__env->startSection('seo'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Kegiatan Mahasiswa — STIM YKPN Yogyakarta','description' => 'Ragam kegiatan kemahasiswaan di STIM YKPN Yogyakarta: organisasi, UKM, kepanitiaan, dan pengembangan soft skill mahasiswa.','canonicalUrl' => url('/kegiatan-mahasiswa')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kegiatan Mahasiswa — STIM YKPN Yogyakarta','description' => 'Ragam kegiatan kemahasiswaan di STIM YKPN Yogyakarta: organisasi, UKM, kepanitiaan, dan pengembangan soft skill mahasiswa.','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/kegiatan-mahasiswa'))]); ?>
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
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 0 24px 12px;
      border-bottom: 1px solid #e2e8f0;
      margin-bottom: 12px;
    }

    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-menu li a {
      display: block;
      padding: 12px 24px;
      color: #0f172a;
      font-weight: 600;
      font-size: 15px;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
      text-decoration: none;
    }

    .sidebar-menu li a:hover {
      background: #f8fafc;
      color: #f97316;
    }

    .sidebar-menu li a.active {
      color: #f97316;
      background: rgba(241, 135, 33, 0.05);
      border-left-color: #f97316;
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
      color: #0f172a;
      margin: 0;
    }

    .article-body {
      color: #475569;
      font-size: 16px;
      line-height: 1.8;
    }

    @media (max-width: 992px) {
      .academic-layout { grid-template-columns: 1fr; }
      .academic-sidebar { position: relative; top: 0; }
    }

    /* Search Bar Styling */
    .search-container {
      position: relative;
      margin-bottom: 40px;
      max-width: 600px;
    }

    .search-input {
      width: 100%;
      padding: 16px 20px 16px 50px;
      font-size: 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      border: 2px solid #e2e8f0;
      border-radius: 16px;
      outline: none;
      transition: all 0.3s ease;
      background: #f8fafc;
      color: #0f172a;
    }

    .search-input:focus {
      border-color: #f97316;
      background: #ffffff;
      box-shadow: 0 4px 20px rgba(241, 135, 33, 0.1);
    }

    .search-icon-local {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      pointer-events: none;
      transition: color 0.3s ease;
    }

    .search-input:focus ~ .search-icon-local {
      color: #f97316;
    }

    /* Activity Card Styling */
    .activity-card-layout {
      display: grid;
      grid-template-columns: 200px 1fr;
      gap: 25px;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    @media (max-width: 768px) {
      .activity-card-layout {
        grid-template-columns: 1fr;
      }
      .activity-card-layout img {
        height: 200px !important;
      }
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Kegiatan Mahasiswa</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Dokumentasi berbagai aktivitas dan acara yang diselenggarakan oleh mahasiswa STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Kemahasiswaan</div>
        <ul class="sidebar-menu">
          <li><a href="/kegiatan-mahasiswa" class="active">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm">UKM</a></li>
          <li><a href="/ppkpt">PPKPT</a></li>
          <li><a href="/pengumuman">Pengumuman</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Berita & Aktivitas Mahasiswa</h2>
        </div>
        <div class="article-body">
          
    <div class="search-container">
      <input type="text" class="search-input" placeholder="Cari kegiatan..." data-search-target="#activityGrid" data-search-items=".activity-card">
      <svg class="search-icon-local" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    </div>
  
          
      <div id="activityGrid" style="display: flex; flex-direction: column; gap: 30px;">
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="activity-card activity-card-layout">
            <div style="background: #eee; height: 100%; min-height: 150px;">
                <img src="<?php echo e(!empty($activity->header_image) ? (str_contains($activity->header_image, 'http') ? $activity->header_image : asset('storage/' . $activity->header_image)) : asset('images/lambang-stim.webp')); ?>" style="width:100%; height:100%; object-fit:cover;" loading="lazy" alt="<?php echo e($activity->title); ?>">
            </div>
            <div style="padding: 20px;">
              <span style="font-size: 0.8rem; color: #f97316; font-weight: bold; text-transform: uppercase;">
                <?php echo e($activity->start_date ? $activity->start_date->format('d M Y') : 'KEGIATAN'); ?>

              </span>
              <h3 style="margin: 10px 0; color: #0f172a; font-size: 1.25rem;"><?php echo e($activity->title); ?></h3>
              <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 15px; line-height: 1.6;"><?php echo e(Str::limit(strip_tags($activity->description), 150)); ?></p>
              <a href="#" style="color: #0f172a; font-weight: bold; font-size: 0.9rem; text-decoration: none;">Selengkapnya &rarr;</a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    
        </div>
      </article>

    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/kegiatan-mahasiswa.blade.php ENDPATH**/ ?>