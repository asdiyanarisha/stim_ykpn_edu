<?php
$source_dir = '/home/xau/rasabaik/beban-studi/assets';
$dest_dir = '/home/xau/rasabaik/stim_ykpn_edu/public/images';

if (file_exists($source_dir) && (!file_exists($dest_dir) || !file_exists($dest_dir . '/hero-bg.png'))) {
    function copy_folder_recursive($src, $dst) {
        if (!is_dir($dst)) {
            @mkdir($dst, 0755, true);
        }
        $dir = @opendir($src);
        if ($dir) {
            while (false !== ($file = readdir($dir))) {
                if ($file !== '.' && $file !== '..') {
                    if (is_dir($src . '/' . $file)) {
                        copy_folder_recursive($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        @copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        }
    }
    copy_folder_recursive($source_dir, $dest_dir);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STIM YKPN — School of Management Yogyakarta</title>
  <meta name="description"
    content="STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="STIM YKPN — School of Management Yogyakarta">
  <meta property="og:description"
    content="Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta — 50+ tahun menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali.">
  <meta property="og:image" content="/images/img/logo/LOGO STIM YPKN.png">
  <meta property="og:url" content="https://stimykpn.ac.id">
  <meta property="og:site_name" content="STIM YKPN Yogyakarta">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="STIM YKPN — School of Management Yogyakarta">
  <meta name="twitter:description"
    content="Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta — 50+ tahun menghasilkan 15.000+ alumni profesional.">
  <meta name="twitter:image" content="/images/img/logo/LOGO STIM YPKN.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
    rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css?v=3.0">
  
  <style>
    /* Visual Improvements from Index 3 */
    @media (max-width: 768px) {
      .hero .container {
        top: 0 !important;
        height: 100% !important;
      }
    }

    .hero-overlay {
      display: none !important;
      /* Remove dark overlay */
    }

    .slider-btn {
      background: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      backdrop-filter: blur(10px);
      width: 60px !important;
      height: 60px !important;
      opacity: 0;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .hero-slider:hover .slider-btn {
      opacity: 1;
    }

    .slider-btn:hover {
      background: rgba(255, 255, 255, 0.3) !important;
      transform: translateY(-50%) scale(1.1) !important;
    }

    .slider-dots,
    .scroll-indicator {
      position: absolute !important;
      left: 0 !important;
      right: 0 !important;
      margin: 0 auto !important;
      width: max-content !important;
      transform: none !important;
      z-index: 10;
    }

    .slider-dots {
      bottom: 110px !important;
      background: rgba(0, 0, 0, 0.2);
      padding: 12px 24px;
      border-radius: 50px;
      backdrop-filter: blur(10px);
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
    }

    .slider-dots .dot {
      width: 10px !important;
      height: 10px !important;
      margin: 0 8px !important;
      border-radius: 50% !important;
      background: rgba(255, 255, 255, 0.4) !important;
      transition: all 0.3s ease !important;
    }

    .slider-dots .dot.active {
      background: #ffffff !important;
      transform: scale(1.3) !important;
    }

    .hero-slider::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      box-shadow: none;
      /* Removed vignette */
      pointer-events: none;
      z-index: 2;
    }

    .slide img {
      filter: brightness(1.05) contrast(1.05) saturate(1.1);
      transform: scale(1.01);
      transition: transform 8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      transform-origin: 50% 50%;
    }

    .slide.active img {
      transform: scale(1.08);
      /* Slow Cinematic Ken Burns Zoom */
    }

    .hero-decor {
      animation: floatOrbs 12s ease-in-out infinite alternate !important;
      opacity: 0.6 !important;
      filter: blur(60px) !important;
    }

    @keyframes floatOrbs {
      0% {
        transform: translate(0, 0) scale(1);
      }

      100% {
        transform: translate(40px, -40px) scale(1.3);
      }
    }

    .hero-content {
      z-index: 5;
      text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
      /* Universal shadow for readability on any photo */
    }

    /* Specific readability fix ONLY for Slide 1 removed per user request */

    .hero-title .highlight {
      background: rgba(255, 255, 255, 0.1) !important;
      padding: 4px 16px;
      border-radius: 16px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      display: inline-block;
      margin: 8px 0;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .hero-title .highlight .blue {
      color: #3b82f6 !important;
    }

    .hero-title .highlight .orange {
      color: #fbb03b !important;
    }

    @media (max-width: 768px) {
      .slider-dots {
        bottom: 10px !important;
        padding: 4px 12px !important;
      }
    }
  </style>
</head>

<body>

  <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- ============================================
       SECTION 2: HERO
       ============================================ -->
  <section class="hero" id="beranda">
    <div class="hero-slider" id="heroSlider">
      <!-- Slide 1: Static Content -->
      <div class="slide active">
        <img src="/images/banner_slide_1.jpeg" alt="STIM YKPN Campus 1" loading="eager">
        <div class="hero-overlay"></div>
        <div style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 2; pointer-events: none;">
          <div class="container" style="pointer-events: none;">
            <div class="hero-content" style="pointer-events: auto;">
              <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 8px;">
                <span class="badge-dot"></span>
                <span style="display: inline-block; transform: translateY(-1px);">Pendaftaran 2026/2027 Dibuka</span>
              </div>
              <h1 class="hero-title" style="line-height: 1.3;">
                Membangun<br>
                <span style="color: #2563eb; text-shadow: 0 4px 30px rgba(0,0,0,0.8);">Pemimpin</span> <span style="color: #f59e0b; text-shadow: 0 4px 30px rgba(0,0,0,0.8);">Bisnis</span><br>
                Masa Depan
              </h1>
              <p class="hero-subtitle">
                Lebih dari 50 tahun menghasilkan lulusan profesional yang<br>
                siap bersaing di dunia bisnis global dengan sertifikasi<br>
                kompetensi terakui.
              </p>
              <div class="hero-actions" style="width: 100%;">
                <a href="/pmb.html" class="btn btn-orange btn-pulse">
                  DAFTAR PMB
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
                </a>
                <a href="#campus-tour" class="btn btn-secondary">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                  Virtual Tour
                </a>
              </div>
              <div class="hero-stats" style="width: 100%;">
                <div class="hero-stat"><div class="stat-number" data-count="50">0</div><div class="stat-label">Tahun Berdiri</div></div>
                <div class="hero-stat"><div class="stat-number" data-count="15000" data-suffix="+">0</div><div class="stat-label">Alumni Profesional</div></div>
                <div class="hero-stat"><div class="stat-number" data-count="4" data-suffix="">0</div><div class="stat-label">Sertifikasi Profesi</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2+: Dynamic Content -->
      <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="slide">
        <img src="<?php echo e($banner->url_image); ?>" alt="<?php echo e($banner->title); ?>" loading="lazy">
        <div class="hero-overlay"></div>
        <?php if($banner->title || $banner->description): ?>
        <div style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 2; pointer-events: none;">
          <div class="container" style="pointer-events: none;">
            <div class="hero-content" style="pointer-events: auto;">
              <?php if($banner->badge_text): ?>
              <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 8px;">
                <span class="badge-dot"></span>
                <span style="display: inline-block; transform: translateY(-1px);"><?php echo e($banner->badge_text); ?></span>
              </div>
              <?php endif; ?>
              <?php if($banner->title): ?>
              <h1 class="hero-title"><?php echo e($banner->title); ?></h1>
              <?php endif; ?>
              <?php if($banner->description): ?>
              <p class="hero-subtitle"><?php echo e($banner->description); ?></p>
              <?php endif; ?>
              <?php if($banner->button_text && $banner->link): ?>
              <div class="hero-actions" style="width: 100%;">
                <a href="<?php echo e($banner->link); ?>" class="btn btn-orange btn-pulse">
                  <?php echo e($banner->button_text); ?>

                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
                </a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php if($banners->isEmpty()): ?>
      <!-- Fallback slides -->
      <div class="slide">
        <img src="/images/students.png" alt="STIM YKPN Campus 2" loading="lazy">
        <div class="hero-overlay"></div>
      </div>
      <div class="slide">
        <img src="/images/hero_bg.png" alt="STIM YKPN Campus 3" loading="lazy">
        <div class="hero-overlay"></div>
      </div>
      <?php endif; ?>

      <div class="slider-dots" id="heroSliderDots" style="bottom: 100px;">
        <button class="dot active" data-index="0" aria-label="Slide 1"></button>
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button class="dot" data-index="<?php echo e($index + 1); ?>" aria-label="Slide <?php echo e($index + 2); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($banners->isEmpty()): ?>
          <button class="dot" data-index="1" aria-label="Slide 2"></button>
          <button class="dot" data-index="2" aria-label="Slide 3"></button>
        <?php endif; ?>
      </div>
    </div>
    <!-- Slider Controls -->
    <button class="slider-btn prev-btn" id="heroPrevBtn" aria-label="Previous slide">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6" /></svg>
    </button>
    <button class="slider-btn next-btn" id="heroNextBtn" aria-label="Next slide">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
    </button>

    <!-- Decorative circles -->
    <div class="hero-decor hero-decor-1"></div>
    <div class="hero-decor hero-decor-2"></div>
    <div class="hero-decor hero-decor-3"></div>

    <div class="scroll-indicator">
      <div class="mouse"></div>
      Scroll
    </div>
  </section>

  <!-- ============================================
       SECTION 3: PROGRAM STUDI
       ============================================ -->
  <section class="programs" id="program">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <div class="section-label">Program Studi</div>
        <h2 class="section-title">Program Akademik Unggulan</h2>
        <p class="section-subtitle">
          Pilih program studi yang sesuai dengan minat dan cita-citamu. Semua program terakreditasi Baik Sekali.
        </p>
      </div>

      <div class="programs-grid">
          <!-- Program 1 -->
          <div class="program-card animate-on-scroll animate-delay-1">
            <div class="program-card-image">
              <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-300.jpg')); ?>" alt="S1 Bisnis Digital" loading="lazy" style="object-fit: cover;">
              <span class="badge">TERAKREDITASI BAIK</span>
            </div>
            <div class="program-card-body">
              <h3>S1 Bisnis Digital</h3>
              <p>
                Program sarjana 4 tahun yang berfokus pada inovasi teknologi, manajemen e-commerce, startup, dan strategi
                bisnis di era digital.
              </p>
              <a href="/program/s1-bisnis-digital" class="program-link">
                Selengkapnya &rarr;
              </a>
            </div>
          </div>
  
          <!-- Program 2 -->
          <div class="program-card animate-on-scroll animate-delay-2">
            <div class="program-card-image">
              <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-290.jpg')); ?>" alt="S1 Manajemen" loading="lazy" style="object-fit: cover;">
              <span class="badge">TERAKREDITASI BAIK SEKALI</span>
            </div>
            <div class="program-card-body">
              <h3>S1 Manajemen</h3>
              <p>
                Program sarjana 4 tahun yang membekali mahasiswa dengan pengetahuan manajemen bisnis,
                keuangan, pemasaran, dan SDM untuk menjadi pemimpin profesional.
              </p>
              <a href="/program/s1-manajemen" class="program-link">
                Selengkapnya &rarr;
              </a>
            </div>
          </div>
  
          <!-- Program 3 -->
          <div class="program-card animate-on-scroll animate-delay-3">
            <div class="program-card-image">
              <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-378.jpg')); ?>" alt="D3 Manajemen" loading="lazy" style="object-fit: cover;">
              <span class="badge">TERAKREDITASI BAIK SEKALI</span>
            </div>
            <div class="program-card-body">
              <h3>D3 Manajemen</h3>
              <p>
                Program diploma 3 tahun yang fokus pada keterampilan praktis manajemen bisnis,
                siap kerja dengan sertifikasi kompetensi profesional.
              </p>
              <a href="/program/d3-manajemen" class="program-link">
                Selengkapnya
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
              </a>
            </div>
          </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       SECTION 4: KEUNGGULAN / WHY STIM YKPN
       ============================================ -->
  <section class="why-us" id="tentang">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <div class="section-label">Mengapa STIM YKPN</div>
        <h2 class="section-title">Keunggulan yang Membedakan Kami</h2>
        <p class="section-subtitle">
          Berpengalaman lebih dari setengah abad dalam mencetak lulusan profesional di bidang manajemen.
        </p>
      </div>

      <div class="why-grid">
        <div class="why-card animate-on-scroll animate-delay-1">
          <div class="why-card-decor"></div>
          <div class="icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="6" />
              <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11" />
            </svg>
          </div>
          <div class="stat-num" data-count="100" data-suffix="%">0%</div>
          <h4>Dosen Qualified</h4>
          <p>Seluruh dosen bergelar S2 dan S3 dari universitas ternama dengan latar belakang praktisi dan akademisi
            berpengalaman.</p>
        </div>

        <div class="why-card animate-on-scroll animate-delay-2">
          <div class="why-card-decor"></div>
          <div class="icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
              <path d="M14 2v4a2 2 0 0 0 2 2h4" />
              <circle cx="8" cy="16" r="3" />
              <path d="M6 19v2.6a.4.4 0 0 0 .6.3l1.4-1.1 1.4 1.1a.4.4 0 0 0 .6-.3V19" />
            </svg>
          </div>
          <div class="stat-num" data-count="7" data-suffix="">0</div>
          <h4>Sertifikasi Profesi</h4>
          <p>Sertifikasi BNSP, MSDM, Perbankan, Ekspor Impor, dan lainnya untuk mempersiapkan lulusan langsung bekerja.
          </p>
        </div>

        <div class="why-card animate-on-scroll animate-delay-3">
          <div class="why-card-decor"></div>
          <div class="icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <div class="stat-num" data-count="15" data-suffix="K+">0</div>
          <h4>Jaringan Alumni</h4>
          <p>Bergabung dengan 15.000+ alumni yang telah sukses bekerja di berbagai sektor bisnis dan pemerintahan di
            seluruh Indonesia.</p>
        </div>

        <div class="why-card animate-on-scroll animate-delay-4">
          <div class="why-card-decor"></div>
          <div class="icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
          </div>
          <div class="stat-num">BAN-PT</div>
          <h4>Terakreditasi Baik Sekali</h4>
          <p>Mendapatkan pengakuan akreditasi Baik Sekali dari BAN-PT untuk menjamin kualitas standar mutu pendidikan tinggi.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       SECTION 5: PMB / PENDAFTARAN
       ============================================ -->
  <section class="pmb" id="pmb">
    <div class="container">
      <div class="pmb-wrapper">
        <div class="pmb-image animate-on-scroll">
          <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-282.jpg')); ?>" alt="Mahasiswa STIM YKPN">
          <div class="floating-badge">
            <div class="periode-label">Periode</div>
            <div class="periode-year">2026/2027</div>
          </div>
        </div>

        <div class="pmb-content animate-on-scroll animate-delay-2">
          <div class="section-label">Penerimaan Mahasiswa Baru</div>
          <h2 class="section-title">Mulai Perjalanan Akademikmu Sekarang</h2>
          <p class="pmb-description">
            STIM YKPN membuka pendaftaran mahasiswa baru untuk program reguler dan ekstensi.
            Dapatkan beasiswa dan sertifikasi kompetensi profesional selama masa studi.
          </p>

          <div class="pmb-features">
            <div class="pmb-feature">
              <div class="feature-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg></div>
              <span>Program Reguler</span>
            </div>
            <div class="pmb-feature">
              <div class="feature-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg></div>
              <span>Program Kelas Karyawan</span>
            </div>
            <div class="pmb-feature">
              <div class="feature-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg></div>
              <span>Beasiswa Tersedia</span>
            </div>
            <div class="pmb-feature">
              <div class="feature-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg></div>
              <span>Program RPL</span>
            </div>
          </div>

          <div class="pmb-actions">
            <a href="/pmb.html" class="btn btn-orange btn-pulse">
              Daftar PMB
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
            <a href="/biaya-kuliah.html" class="btn btn-outline">
              Lihat Biaya Kuliah
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       SECTION 6: NEWS & EVENTS
       ============================================ -->
  <section class="news" id="berita">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <div>
          <div class="section-label">Berita & Kegiatan</div>
          <h2 class="section-title">Kabar Terbaru Kampus</h2>
        </div>
        <a href="/berita" class="btn btn-outline">Semua Berita</a>
      </div>

      <div class="news-grid">
        <?php $__empty_1 = true; $__currentLoopData = $latest_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="news-card animate-on-scroll animate-delay-<?php echo e($loop->iteration); ?>">
          <div class="news-card-image">
            <img src="<?php echo e($news_item->url_image ?? '/images/hero-bg.png'); ?>" alt="<?php echo e($news_item->title); ?>">
            <span class="date-badge"><?php echo e($news_item->created_at->format('d M Y')); ?></span>
          </div>
          <div class="news-card-body">
            <span class="category">Berita</span>
            <h3><a href="/berita/<?php echo e($news_item->id); ?>"><?php echo e($news_item->title); ?></a></h3>
            <a href="/berita/<?php echo e($news_item->id); ?>" class="read-more">
              Baca Selengkapnya
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: #64748b;">
          <p>Belum ada berita terbaru.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================
       SECTION 7: TESTIMONI ALUMNI
       ============================================ -->
  <section class="testimonials" id="testimoni">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <div class="section-label">Testimoni Alumni</div>
        <h2 class="section-title">Apa Kata Mereka?</h2>
        <p class="section-subtitle">
          Dengarkan cerita sukses para alumni STIM YKPN yang berkarir di berbagai perusahaan ternama.
        </p>
      </div>

      <div class="testimonial-slider animate-on-scroll">
        <div class="testimonial-card" id="testimonialCard">
          <div class="quote-icon">"</div>
          <p class="quote-text" id="quoteText">
            Memuat testimoni...
          </p>
          <div class="alumni-info">
            <div class="alumni-avatar" id="alumniAvatar">...</div>
            <div class="alumni-name" id="alumniName">...</div>
            <div class="alumni-role" id="alumniRole"></div>
            <div class="alumni-company" id="alumniCompany"></div>
          </div>
        </div>

        <div class="testimonial-dots" id="testimonialDots">
          <?php if(isset($alumnis) && $alumnis->count() > 0): ?>
            <?php $__currentLoopData = $alumnis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $alumni): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <button class="dot <?php echo e($index === 0 ? 'active' : ''); ?>" data-index="<?php echo e($index); ?>" aria-label="Testimoni <?php echo e($index + 1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <button class="dot active" data-index="0" aria-label="Testimoni 1"></button>
            <button class="dot" data-index="1" aria-label="Testimoni 2"></button>
            <button class="dot" data-index="2" aria-label="Testimoni 3"></button>
            <button class="dot" data-index="3" aria-label="Testimoni 4"></button>
            <button class="dot" data-index="4" aria-label="Testimoni 5"></button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if(isset($alumnis) && $alumnis->count() > 0): ?>
  <script>
    window.dynamicTestimonials = <?php echo json_encode($alumnis->map(function($a) {
        $words = explode(' ', $a->name);
        $initials = '';
        foreach(array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }
        return [
            'text' => $a->testimony,
            'name' => $a->name,
            'role' => '',
            'company' => '',
            'initials' => $initials,
            'image' => $a->image ? (str_contains($a->image, 'http') ? $a->image : asset('storage/' . $a->image)) : null
        ];
    })); ?>;
  </script>
  <?php endif; ?>

  <!-- ============================================
       SECTION 8: CAMPUS TOUR VIDEO
       ============================================ -->
  <section class="campus-tour" id="campus-tour">
    <div class="campus-tour-bg">
      <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-324.jpg')); ?>" alt="STIM YKPN Campus Aerial View" style="object-fit: cover;">
    </div>
    <div class="container">
      <div class="play-button" id="playButton" role="button" aria-label="Play campus tour video">
        <svg viewBox="0 0 24 24">
          <polygon points="5 3 19 12 5 21 5 3" />
        </svg>
      </div>
      <h2>Campus Tour STIM YKPN</h2>
      <p>Bergabunglah dengan tur kampus kami dan temukan mengapa STIM YKPN menjadi pilihan terbaik</p>
    </div>
  </section>

  <!-- ============================================
       SECTION 9: SERTIFIKASI
       ============================================ -->
  <section class="certifications" id="sertifikasi">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <div class="section-label">Mitra Sertifikasi</div>
        <h2 class="section-title">Sertifikasi Kompetensi Profesional</h2>
      </div>

      <div class="cert-logos animate-on-scroll">
        <div class="cert-logo">
          <img src="/images/img/logo/SERTIFIKASI BNSP.webp" alt="BNSP" class="cert-img">
          <span>Sertifikasi BNSP</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/LSP MSDM- SDM.webp" alt="LSP MSDM" class="cert-img">
          <span>MSDM - SDM</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/LSPP- PERBANKAN.webp" alt="LSPP" class="cert-img">
          <span>Perbankan</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/PPEI- EKSPOR IMPOR.webp" alt="PPEI" class="cert-img">
          <span>Ekspor Impor</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/LSPPI- PROFESI PEMBIAYAAN.webp" alt="LSPPI" class="cert-img">
          <span>Profesi Pembiayaan</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/LSP Digital Marketing - Digital Marketing.webp" alt="DM" class="cert-img">
          <span>Digital Marketing</span>
        </div>
        <div class="cert-logo">
          <img src="/images/img/logo/LSP- PERPAJAKAN.webp" alt="TAX" class="cert-img">
          <span>Perpajakan</span>
        </div>
      </div>
    </div>
  </section>

  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Script -->
  <script src="/js/script.js?v=3.6"></script>
</body>

</html>


<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/index.blade.php ENDPATH**/ ?>