<?php $__env->startSection('seo'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Pimpinan STIM YKPN Yogyakarta','description' => 'Profil para pimpinan dan struktural STIM YKPN Yogyakarta yang berpengalaman dalam memimpin institusi pendidikan tinggi manajemen.','canonicalUrl' => url('/pimpinan')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pimpinan STIM YKPN Yogyakarta','description' => 'Profil para pimpinan dan struktural STIM YKPN Yogyakarta yang berpengalaman dalam memimpin institusi pendidikan tinggi manajemen.','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/pimpinan'))]); ?>
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
    /* Executive Academic Styles */
    body { background-color: #ffffff; }
    .pimpinan-section {
      padding: 100px 0 120px;
      background: #ffffff;
    }
    .pimpinan-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 20px;
    }
    .pimpinan-ketua-wrapper {
      margin-bottom: 80px;
    }
    .card-ketua {
      display: flex;
      align-items: stretch;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      width: 100%;
      transition: all 0.4s ease;
      border-radius: 8px;
      overflow: hidden;
    }
    .card-ketua:hover {
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }
    .ketua-photo {
      width: 45%;
      min-height: 400px;
      background-color: #e2e8f0;
      position: relative;
      overflow: hidden;
    }
    .ketua-photo img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center 62%; /* Fokus awal pada wajah Dr. Suparmono */
      transition: object-position 0.5s ease; /* Efek transisi scrolling yang mulus */
    }
    .card-ketua:hover .ketua-photo img {
      object-position: center 88%; /* Scrolling/shifting ke atas (menampilkan tubuh/jas lebih banyak) saat hover */
    }
    .ketua-info {
      width: 55%;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }
    .ketua-info::before {
      content: '';
      position: absolute;
      top: 65px;
      left: 0;
      width: 4px;
      height: 60px;
      background: var(--orange-500);
    }
    .pimpinan-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 40px;
    }
    .card-wakil {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      transition: all 0.4s ease;
      display: flex;
      flex-direction: column;
      border-radius: 8px;
      overflow: hidden;
    }
    .card-wakil:hover {
      box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.08);
      transform: translateY(-5px);
    }
    .wakil-photo {
      width: 100%;
      aspect-ratio: 3/4;
      background-color: #f1f5f9;
      position: relative;
      overflow: hidden;
    }
    .wakil-photo img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top center;
      transition: transform 0.6s ease;
    }
    .card-wakil:hover .wakil-photo img {
      transform: scale(1.03);
    }
    .wakil-info {
      padding: 35px 30px;
      text-align: left;
      flex-grow: 1;
      border-top: 4px solid var(--orange-500);
      background: #f8fafc;
    }
    /* TEXT STYLES */
    .info-jabatan {
      font-size: 13px;
      font-weight: 700;
      color: var(--orange-500);
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-bottom: 12px;
      display: block;
    }
    .info-name {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 15px;
      line-height: 1.2;
      letter-spacing: -0.5px;
    }
    .wakil-info .info-name {
      font-size: 22px;
      margin-bottom: 12px;
    }
    .info-desc {
      color: #475569;
      font-size: 16px;
      line-height: 1.7;
    }
    .wakil-info .info-desc {
      font-size: 15px;
    }
    @media (max-width: 992px) {
      .card-ketua {
        flex-direction: column;
      }
      .ketua-photo {
        width: 100%;
        min-height: 450px;
      }
      .ketua-info {
        width: 100%;
        padding: 50px 30px;
      }
      .ketua-info::before {
        top: 0; left: 40px;
        width: 60px; height: 4px;
      }
      .pimpinan-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 768px) {
      .pimpinan-grid {
        grid-template-columns: 1fr;
        gap: 30px;
      }
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Pimpinan STIM YKPN</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Jajaran pimpinan yang mendedikasikan diri untuk memajukan pendidikan tinggi manajemen di Indonesia.
      </p>
    </div>
  </header>

  <section class="pimpinan-section">
    <div class="pimpinan-container">
      <!-- Ketua -->
      <div class="pimpinan-ketua-wrapper">
        <div class="card-ketua animate-on-scroll">
          <div class="ketua-photo">
            <img loading="lazy" src="/images/dosen/pimpinan_dr_suparmono_msi.jpg" alt="Dr. Suparmono, M.Si.">
          </div>
          <div class="ketua-info">
            <span class="info-jabatan">Ketua</span>
            <h3 class="info-name">Dr. Suparmono, M.Si.</h3>
            <p class="info-desc">Memimpin dengan visi inovasi dan keunggulan akademik untuk mencetak lulusan profesional yang siap menghadapi tantangan bisnis global, serta terus mendorong transformasi STIM YKPN menuju standar internasional.</p>
          </div>
        </div>
      </div>

      <!-- Wakil Ketua Grid (3 Columns) -->
      <div class="pimpinan-grid">
        <!-- Wakil Ketua I -->
        <div class="card-wakil animate-on-scroll animate-delay-1">
          <div class="wakil-photo">
            <img loading="lazy" src="/images/dosen/pimpinan_siti_resmi.JPG" alt="Siti Resmi, Dra., M.M., Ak., CA.">
          </div>
          <div class="wakil-info">
            <span class="info-jabatan">Wakil Ketua I</span>
            <h3 class="info-name">Siti Resmi, Dra., M.M., Ak., CA.</h3>
            <p class="info-desc">Bidang Akademik, merumuskan kebijakan pendidikan dan menjamin mutu pembelajaran.</p>
          </div>
        </div>

        <!-- Wakil Ketua II -->
        <div class="card-wakil animate-on-scroll animate-delay-2">
          <div class="wakil-photo">
            <img loading="lazy" src="/images/dosen/WhatsApp Image 2026-05-26 at 11.14.42 AM.jpeg" alt="Dr. Anna Partina, M.Si.">
          </div>
          <div class="wakil-info">
            <span class="info-jabatan">Wakil Ketua II</span>
            <h3 class="info-name">Dr. Anna Partina, M.Si.</h3>
            <p class="info-desc">Bidang Keuangan & SDM, mengelola sumber daya dan operasional institusi secara efektif.</p>
          </div>
        </div>

        <!-- Wakil Ketua III -->
        <div class="card-wakil animate-on-scroll animate-delay-3">
          <div class="wakil-photo">
            <img loading="lazy" src="/images/dosen/pimpinan_ralina.JPG" alt="Ralina Transistari, Dra., M.Si">
          </div>
          <div class="wakil-info">
            <span class="info-jabatan">Wakil Ketua III</span>
            <h3 class="info-name">Ralina Transistari, Dra., M.Si</h3>
            <p class="info-desc">Bidang Kemahasiswaan & Alumni, membina prestasi dan jaringan strategis kampus.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/pimpinan.blade.php ENDPATH**/ ?>