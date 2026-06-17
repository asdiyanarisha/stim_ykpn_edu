<?php $__env->startSection('seo'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Profil Dosen — STIM YKPN Yogyakarta','description' => 'Kenali para akademisi dan pakar berpengalaman di STIM YKPN Yogyakarta. Seluruh dosen bergelar S2 dan S3 dari universitas terkemuka.','canonicalUrl' => url('/dosen')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Dosen — STIM YKPN Yogyakarta','description' => 'Kenali para akademisi dan pakar berpengalaman di STIM YKPN Yogyakarta. Seluruh dosen bergelar S2 dan S3 dari universitas terkemuka.','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/dosen'))]); ?>
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

<?php $__env->startSection('content'); ?>
<!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container">
      <h1 class="page-title animate-on-scroll">Profil Dosen</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1">
        Kenali para pakar dan akademisi STIM YKPN yang berdedikasi tinggi dalam membentuk pemimpin bisnis masa depan.
      </p>
    </div>
  </header>

  <!-- ============================================
       FACULTY SECTION
       ============================================ -->
  <section class="faculty-section">
    <div class="container">
      <!-- Filter & Search -->
      <div class="faculty-filter animate-on-scroll animate-delay-2">
        <div class="filter-group">
          <a href="/dosen?category=all" class="filter-btn <?php echo e(request('category', 'all') == 'all' ? 'active' : ''); ?>">Semua</a>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="/dosen?category=<?php echo e($cat->slug); ?>" class="filter-btn <?php echo e(request('category') == $cat->slug ? 'active' : ''); ?>"><?php echo e($cat->title); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="search-group">
          <form action="/dosen" method="GET" class="search-form">
            <?php if(request('category')): ?>
              <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
            <?php endif; ?>
            <div class="search-input-group" style="position: relative;">
              <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau keahlian dosen..." class="search-input">
            </div>
          </form>
        </div>
      </div>

      <!-- Grid -->
      <div class="faculty-grid">
        <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="faculty-card animate-on-scroll">
          <div class="faculty-img-wrap">
            <img src="<?php echo e($teacher->image_url ?: '/images/default-user.png'); ?>" alt="<?php echo e($teacher->full_name); ?>" onerror="this.onerror=null;this.src='/images/default-user.png';">
            <div class="faculty-overlay">
              <a href="/dosen/<?php echo e($teacher->id); ?>" class="btn-white-outline" style="text-align: center;">Lihat Profil Lengkap</a>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name"><?php echo e(($teacher->front_title ? $teacher->front_title . ' ' : '') . $teacher->full_name . ($teacher->back_title ? ', ' . $teacher->back_title : '')); ?></h3>
            <p class="faculty-role"><?php echo e($teacher->category->title ?? ''); ?></p>
            <span class="faculty-expertise"><?php echo e($teacher->jobTitle->title ?? 'Dosen'); ?></span>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 50px;">
          <p>Belum ada data dosen untuk kategori ini.</p>
        </div>
        <?php endif; ?>
      </div>

      <!-- Pagination -->
      <div class="pagination-container">
        <?php echo e($teachers->appends(request()->query())->links('pagination::bootstrap-4')); ?>

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/dosen.blade.php ENDPATH**/ ?>