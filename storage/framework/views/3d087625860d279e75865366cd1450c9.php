

<?php
  $homepageSchema = [
    '@context' => 'https://schema.org',
    '@graph' => [
      [
        '@type' => 'EducationalOrganization',
        '@id' => url('/') . '#organization',
        'name' => 'STIM YKPN Yogyakarta',
        'alternateName' => 'Sekolah Tinggi Ilmu Manajemen YKPN',
        'url' => url('/'),
        'logo' => url('/images/img/logo/logo-stim-new.webp'),
        'description' => 'Sekolah Tinggi Ilmu Manajemen terdepan di Yogyakarta dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali oleh BAN-PT.',
        'foundingDate' => '1976',
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => 'Jl. Palagan Tentara Pelajar No. 73',
          'addressLocality' => 'Sleman',
          'addressRegion' => 'Yogyakarta',
          'addressCountry' => 'ID',
        ],
        'telephone' => '+62274-868141',
        'email' => 'info@stimykpn.ac.id',
        'sameAs' => [
          'https://www.instagram.com/stimykpn',
          'https://www.facebook.com/stimykpn',
          'https://www.youtube.com/@stimykpn',
        ],
        'numberOfStudents' => ['@type' => 'QuantitativeValue', 'value' => 15000],
        'hasCredential' => ['@type' => 'EducationalOccupationalCredential', 'credentialCategory' => 'Terakreditasi Baik Sekali BAN-PT'],
      ],
      [
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => 'STIM YKPN Yogyakarta',
        'description' => 'Website resmi Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta',
        'publisher' => ['@id' => url('/') . '#organization'],
        'inLanguage' => 'id-ID',
        'potentialAction' => [
          '@type' => 'SearchAction',
          'target' => ['@type' => 'EntryPoint', 'urlTemplate' => url('/berita') . '?search={search_term_string}'],
          'query-input' => 'required name=search_term_string',
        ],
      ],
    ],
  ];
?>

<?php $__env->startSection('meta'); ?>
  <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'STIM YKPN — School of Management Yogyakarta','description' => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali oleh BAN-PT.','ogImage' => url('/images/img/logo/logo-stim-new.webp'),'ogType' => 'website','canonicalUrl' => url('/'),'schemaJson' => $homepageSchema]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'STIM YKPN — School of Management Yogyakarta','description' => 'STIM YKPN Yogyakarta — Sekolah Tinggi Ilmu Manajemen terdepan dengan 50+ tahun pengalaman menghasilkan 15.000+ alumni profesional. Terakreditasi Baik Sekali oleh BAN-PT.','ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/images/img/logo/logo-stim-new.webp')),'ogType' => 'website','canonicalUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/')),'schemaJson' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homepageSchema)]); ?>
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
  <section class="hero" id="beranda">
    <div class="hero-slider" id="heroSlider">
      <!-- Slide 1: Static Content -->
      <div class="slide active">
        <img src="/images/Banner1.webp" alt="STIM YKPN Campus 1" loading="eager">
        <div class="hero-overlay"></div>
        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; width: 100%; z-index: 2;">
          <div class="container" style="display: flex; justify-content: center; width: 100%;">
            <div class="hero-content">
              <div class="hero-badge">
                <span class="badge-dot"></span>
                <span>Pendaftaran 2026/2027 Dibuka</span>
              </div>
              <h1 class="hero-title" style="line-height: 1.3;">
                Membangun<br>
                <span><span style="color: #2563eb; text-shadow: 0 4px 30px rgba(0,0,0,0.8); -webkit-text-fill-color: #2563eb;">Pemimpin</span> <span style="color: #f59e0b; text-shadow: 0 4px 30px rgba(0,0,0,0.8); -webkit-text-fill-color: #f59e0b;">Bisnis</span></span><br>
                Masa Depan
              </h1>
              <p class="hero-subtitle">
                Lebih dari 50 tahun menghasilkan lulusan profesional yang<br>
                siap bersaing di dunia bisnis global dengan sertifikasi<br>
                kompetensi terakui.
              </p>
              <div class="hero-actions">
                <a href="/pendaftaran-pmb" class="btn btn-orange btn-pulse" onclick="gtag('event', 'click_pmb')">
                  DAFTAR PMB
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
                </a>
                <a href="#campus-tour" class="btn btn-secondary">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                  Virtual Tour
                </a>
              </div>
              <div class="hero-stats">
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
        <div style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 2;">
          <div class="container">
            <div class="hero-content">
              <?php if($banner->badge_text): ?>
              <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 8px;">
                <span class="badge-dot"></span>
                <span style="display: inline-block; transform: translateY(-1px);"><?php echo e($banner->badge_text); ?></span>
              </div>
              <?php endif; ?>
              <?php if($banner->title): ?>
              
              <h2 class="hero-title" style="font-size: inherit; font-weight: inherit;"><?php echo e($banner->title); ?></h2>
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
        <img src="/images/hero-bg.webp" alt="STIM YKPN Campus 3" loading="lazy">
        <div class="hero-overlay"></div>
      </div>
      <?php endif; ?>

      <div class="slider-dots" id="heroSliderDots">
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
        <span style="font-size: 0.75rem; letter-spacing: 2px;">SCROLL</span>
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

      <?php
        $programImages = [
            's1-bisnis-digital' => 'images/STIMYK/optimized_STIMYK-300.jpg',
            's1-manajemen'      => 'images/STIMYK/optimized_STIMYK-290.jpg',
            'd3-manajemen'      => 'images/STIMYK/optimized_STIMYK-378.jpg'
        ];
      ?>
      <div class="programs-grid">
        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $imagePath = $program->image_banner ?: asset($programImages[$program->slug] ?? 'images/STIMYK/optimized_STIMYK-290.jpg');
          ?>
          <div class="program-card animate-on-scroll animate-delay-<?php echo e($loop->iteration); ?>">
            <div class="program-card-image">
              <img src="<?php echo e($imagePath); ?>" alt="<?php echo e($program->name); ?>" loading="lazy" style="object-fit: cover;">
              <?php if($program->accreditation): ?>
                <span class="badge">TERAKREDITASI <?php echo e(strtoupper($program->accreditation)); ?></span>
              <?php endif; ?>
            </div>
            <div class="program-card-body">
              <h3><?php echo e($program->name); ?></h3>
              <p><?php echo e($program->tagline); ?></p>
              <a href="/program/<?php echo e($program->slug); ?>" class="program-link">
                Selengkapnya
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-left: 4px;"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
              </a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <a href="/pendaftaran-pmb" class="btn btn-orange btn-pulse" onclick="gtag('event', 'click_pmb')">
              Daftar PMB
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
            <a href="/biaya-kuliah" class="btn btn-outline">
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
            <img src="<?php echo e($news_item->url_image ?? '/images/hero-bg.webp'); ?>" alt="<?php echo e($news_item->title); ?>">
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
      <img src="<?php echo e(asset('images/STIMYK/optimized_STIMYK-324.webp')); ?>" alt="STIM YKPN Campus Aerial View" style="object-fit: cover;">
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/index.blade.php ENDPATH**/ ?>