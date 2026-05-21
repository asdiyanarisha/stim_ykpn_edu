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
  <link rel="stylesheet" href="/css/style.css?v=2.5">
</head>

<body>

  @include('components.navbar')

  <!-- ============================================
       SECTION 2: HERO
       ============================================ -->
  <section class="hero" id="beranda">
    <div class="hero-slider" id="heroSlider">
      <!-- Slide 1: Static Content -->
      <div class="slide active">
        <img src="/images/hero-bg.png" alt="STIM YKPN Campus 1" loading="eager">
        <div class="hero-overlay"></div>
        <div style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 2; pointer-events: none;">
          <div class="container" style="pointer-events: none;">
            <div class="hero-content" style="pointer-events: auto; margin: 0 auto; text-align: center; display: flex; flex-direction: column; align-items: center;">
              <div class="hero-badge">
                <span class="badge-dot"></span>
                Pendaftaran 2026/2027 Dibuka
              </div>
              <h1 class="hero-title">
                Membangun <span class="highlight">Pemimpin Bisnis</span> Masa Depan
              </h1>
              <p class="hero-subtitle">
                Lebih dari 50 tahun menghasilkan lulusan profesional yang siap bersaing
                di dunia bisnis global dengan sertifikasi kompetensi terakui.
              </p>
              <div class="hero-actions" style="justify-content: center; width: 100%;">
                <a href="/pmb.html" class="btn btn-orange btn-pulse">
                  Daftar PMB
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
                </a>
                <a href="#campus-tour" class="btn btn-secondary">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                  Virtual Tour
                </a>
              </div>
              <div class="hero-stats" style="justify-content: center; width: 100%;">
                <div class="hero-stat"><div class="stat-number" data-count="50">0</div><div class="stat-label">Tahun Berdiri</div></div>
                <div class="hero-stat"><div class="stat-number" data-count="15000" data-suffix="+">0</div><div class="stat-label">Alumni Profesional</div></div>
                <div class="hero-stat"><div class="stat-number" data-count="4" data-suffix="">0</div><div class="stat-label">Sertifikasi Profesi</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2+: Dynamic Content -->
      @foreach ($banners as $index => $banner)
      <div class="slide">
        <img src="{{ $banner->url_image }}" alt="{{ $banner->title }}" loading="lazy">
        <div class="hero-overlay"></div>
        @if($banner->title || $banner->description)
        <div style="position: absolute; inset: 0; display: flex; align-items: center; z-index: 2; pointer-events: none;">
          <div class="container" style="pointer-events: none;">
            <div class="hero-content" style="pointer-events: auto; margin: 0 auto; text-align: center; display: flex; flex-direction: column; align-items: center;">
              @if($banner->title)
              <h1 class="hero-title">{{ $banner->title }}</h1>
              @endif
              @if($banner->description)
              <p class="hero-subtitle">{{ $banner->description }}</p>
              @endif
              @if($banner->button_text && $banner->link)
              <div class="hero-actions" style="justify-content: center; width: 100%;">
                <a href="{{ $banner->link }}" class="btn btn-orange btn-pulse">
                  {{ $banner->button_text }}
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
                </a>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
      </div>
      @endforeach

      @if ($banners->isEmpty())
      <!-- Fallback slides -->
      <div class="slide">
        <img src="/images/students.png" alt="STIM YKPN Campus 2" loading="lazy">
        <div class="hero-overlay"></div>
      </div>
      <div class="slide">
        <img src="/images/hero_bg.png" alt="STIM YKPN Campus 3" loading="lazy">
        <div class="hero-overlay"></div>
      </div>
      @endif

      <div class="slider-dots" id="heroSliderDots" style="bottom: 100px;">
        <button class="dot active" data-index="0" aria-label="Slide 1"></button>
        @foreach ($banners as $index => $banner)
          <button class="dot" data-index="{{ $index + 1 }}" aria-label="Slide {{ $index + 2 }}"></button>
        @endforeach
        
        @if ($banners->isEmpty())
          <button class="dot" data-index="1" aria-label="Slide 2"></button>
          <button class="dot" data-index="2" aria-label="Slide 3"></button>
        @endif
      </div>
    </div>
    <!-- Slider Controls (Absolute top level to prevent ANY overlaps) -->
    <button class="slider-btn prev-btn" id="heroPrevBtn" aria-label="Previous slide" style="z-index: 9999; pointer-events: auto; padding: 0; outline: none; border: none; background: rgba(255, 255, 255, 0.2);">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6" /></svg>
    </button>
    <button class="slider-btn next-btn" id="heroNextBtn" aria-label="Next slide" style="z-index: 9999; pointer-events: auto; padding: 0; outline: none; border: none; background: rgba(255, 255, 255, 0.2);">
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
        <!-- S1 Bisnis Digital -->
        <div class="program-card animate-on-scroll animate-delay-1">
          <div class="program-card-image">
            <img src="/images/students.png" alt="Program S1 Bisnis Digital">
            <span class="badge" style="background: var(--blue-500);">Terakreditasi Baik</span>
          </div>
          <div class="program-card-body">
            <div class="program-icon">💻</div>
            <h3>S1 Bisnis Digital</h3>
            <p>
              Program sarjana 4 tahun yang berfokus pada inovasi teknologi, manajemen e-commerce, startup, dan strategi
              bisnis di era digital.
            </p>
            <a href="/sasaran-pendidikan.html" class="program-link">
              Selengkapnya
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>

        <!-- S1 Manajemen -->
        <div class="program-card animate-on-scroll animate-delay-2">
          <div class="program-card-image">
            <img src="/images/students.png" alt="Program S1 Manajemen">
            <span class="badge">Terakreditasi Baik Sekali</span>
          </div>
          <div class="program-card-body">
            <div class="program-icon">🎓</div>
            <h3>S1 Manajemen</h3>
            <p>
              Program sarjana 4 tahun yang membekali mahasiswa dengan pengetahuan manajemen bisnis,
              keuangan, pemasaran, dan SDM untuk menjadi pemimpin profesional.
            </p>
            <a href="https://stimykpn.ac.id/academic/s1-management" class="program-link">
              Selengkapnya
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>

        <!-- D3 Manajemen -->
        <div class="program-card animate-on-scroll animate-delay-3">
          <div class="program-card-image">
            <img src="/images/hero-bg.png" alt="Program D3 Manajemen">
            <span class="badge">Terakreditasi Baik Sekali</span>
          </div>
          <div class="program-card-body">
            <div class="program-icon">📊</div>
            <h3>D3 Manajemen</h3>
            <p>
              Program diploma 3 tahun yang fokus pada keterampilan praktis manajemen bisnis,
              siap kerja dengan sertifikasi kompetensi profesional.
            </p>
            <a href="https://stimykpn.ac.id/academic/d3-management" class="program-link">
              Selengkapnya
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
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
    <div class="why-us-bg-glow"></div>
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
          <img src="/images/students.png" alt="Mahasiswa STIM YKPN">
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
        <a href="https://stimykpn.ac.id/page/news/news" class="btn btn-outline">Semua Berita</a>
      </div>

      <div class="news-grid">
        @forelse ($latest_news as $news_item)
        <article class="news-card animate-on-scroll animate-delay-{{ $loop->iteration }}">
          <div class="news-card-image">
            <img src="{{ $news_item->url_image ?? '/images/hero-bg.png' }}" alt="{{ $news_item->title }}">
            <span class="date-badge">{{ $news_item->created_at->format('d M Y') }}</span>
          </div>
          <div class="news-card-body">
            <span class="category">Berita</span>
            <h3><a href="/berita/{{ $news_item->id }}">{{ $news_item->title }}</a></h3>
            <a href="/berita/{{ $news_item->id }}" class="read-more">
              Baca Selengkapnya
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </article>
        @empty
        <!-- News 1 -->
        <article class="news-card animate-on-scroll animate-delay-1">
          <div class="news-card-image">
            <img src="/images/hero-bg.png" alt="Halal bi Halal STIM YKPN">
            <span class="date-badge">30 Mar 2026</span>
          </div>
          <div class="news-card-body">
            <span class="category">Kegiatan</span>
            <h3><a href="https://stimykpn.ac.id/page/news/news/a16c11a6-b018-45a9-9ea9-3280f69db114">STIM YKPN
                Yogyakarta menjadi Tuan Rumah Halal bi Halal se-YKPN</a></h3>
            <a href="https://stimykpn.ac.id/page/news/news/a16c11a6-b018-45a9-9ea9-3280f69db114" class="read-more">
              Baca Selengkapnya
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </article>

        <!-- News 2 -->
        <article class="news-card animate-on-scroll animate-delay-2">
          <div class="news-card-image">
            <img src="/images/students.png" alt="Dies Natalis STIM YKPN">
            <span class="date-badge">06 Jan 2026</span>
          </div>
          <div class="news-card-body">
            <span class="category">Dies Natalis</span>
            <h3><a href="https://stimykpn.ac.id/page/news/news/a0c50908-536e-4adb-81bd-9b44a6cd2693">Malam Tasyakuran
                Dies Natalis ke-50 STIM YKPN, Momentum Syukur dan Apresiasi</a></h3>
            <a href="https://stimykpn.ac.id/page/news/news/a0c50908-536e-4adb-81bd-9b44a6cd2693" class="read-more">
              Baca Selengkapnya
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </article>

        <!-- News 3 -->
        <article class="news-card animate-on-scroll animate-delay-3">
          <div class="news-card-image">
            <img src="/images/hero-bg.png" alt="Anugerah Kerja Sama LLDIKTI">
            <span class="date-badge">11 Des 2025</span>
          </div>
          <div class="news-card-body">
            <span class="category">Prestasi</span>
            <h3><a href="https://stimykpn.ac.id/page/news/news/a0905bed-e3d1-4b8a-8113-0c5969931e0b">STIM YKPN Raih
                Terbaik I Anugerah Kerja Sama Joint Resources Program 2025</a></h3>
            <a href="https://stimykpn.ac.id/page/news/news/a0905bed-e3d1-4b8a-8113-0c5969931e0b" class="read-more">
              Baca Selengkapnya
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </a>
          </div>
        </article>
        @endforelse
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
          <div class="quote-icon">❝</div>
          <p class="quote-text" id="quoteText">
            Kuliah di STIM YKPN memberi saya banyak pengalaman berharga. Dengan dukungan dosen dan bekal ilmu manajemen
            yang kuat, saya dapat menerapkannya langsung dalam pekerjaan saya sebagai Regional Manager ERIGO.
          </p>
          <div class="alumni-info">
            <div class="alumni-avatar" id="alumniAvatar">AY</div>
            <div class="alumni-name" id="alumniName">Agil Yudha Aryakusuma, S.M.</div>
            <div class="alumni-role" id="alumniRole">Regional Manager</div>
            <div class="alumni-company" id="alumniCompany">PT Idea Solusi Indonesia (ERIGO)</div>
          </div>
        </div>

        <div class="testimonial-dots" id="testimonialDots">
          <button class="dot active" data-index="0" aria-label="Testimoni 1"></button>
          <button class="dot" data-index="1" aria-label="Testimoni 2"></button>
          <button class="dot" data-index="2" aria-label="Testimoni 3"></button>
          <button class="dot" data-index="3" aria-label="Testimoni 4"></button>
          <button class="dot" data-index="4" aria-label="Testimoni 5"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       SECTION 8: CAMPUS TOUR VIDEO
       ============================================ -->
  <section class="campus-tour" id="campus-tour">
    <div class="campus-tour-bg">
      <img src="/images/hero-bg.png" alt="STIM YKPN Campus Aerial View">
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

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>

</html>
