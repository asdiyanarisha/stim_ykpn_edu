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
  <link rel="stylesheet" href="/css/style.css?v=2.3">
</head>

<body>

  <!-- ============================================
       SECTION 1: NAVBAR
       ============================================ -->
  <nav class="navbar" id="navbar">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="/images/img/logo/logo-stim-new.png" alt="STIM YKPN" class="brand-logo">
      </a>

      <ul class="nav-links" id="navLinks">
        <li><a href="/" class="active">Beranda</a></li>
        <li class="dropdown">
          <a href="#">Profil <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg></a>
          <ul class="dropdown-menu">
            <li><a href="/sambutan-ketua.html">Sambutan Ketua</a></li>
            <li><a href="/visi-misi.html">Visi & Misi</a></li>
            <li><a href="/profil.html">Profil STIM YKPN</a></li>
            <li><a href="/logo.html">Logo & Lambang</a></li>
            <li><a href="/dosen.html">Dosen</a></li>
            <li><a href="/pimpinan.html">Pimpinan</a></li>
            <li><a href="/fasilitas.html">Fasilitas</a></li>
            <li><a href="/prestasi.html">Prestasi</a></li>
            <li><a href="/spmi.html">SPMI & Akreditasi</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Akademik <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg></a>
          <ul class="dropdown-menu">
            <li class="dropdown-submenu">
              <a href="#">Program Pendidikan <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg></a>
              <ul class="dropdown-menu">
                <li><a href="/sasaran-pendidikan.html">Sasaran Pendidikan</a></li>
                <li><a href="/cara-mencapai-sasaran.html">Cara Mencapai Sasaran</a></li>
                <li><a href="/beban-studi.html">Beban Studi</a></li>
                <li><a href="/sks.html">Sistem Kredit Semester (SKS)</a></li>
                <li><a href="/jenjang-studi.html">Jenjang Studi Dan Masa Studi</a></li>
                <li><a href="/kegiatan-akademik.html">Kegiatan Akademik</a></li>
                <li><a href="/dosen-pembimbing.html">Dosen Pembimbing</a></li>
                <li><a href="/sanksi-akademik.html">Sanksi Akademik</a></li>
              </ul>
            </li>
            <li><a href="/kalender-akademik.html">Kalender Akademik</a></li>
            <li class="dropdown-submenu">
              <a href="#">Ketentuan Perkuliahan <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg></a>
              <ul class="dropdown-menu">
                <li><a href="/kehadiran-kuliah.html">Kehadiran Kuliah</a></li>
                <li><a href="/tata-tertib-kuliah.html">Tata Tertib Kuliah</a></li>
                <li><a href="/jumlah-kehadiran.html">Jumlah Kehadiran</a></li>
                <li><a href="/seminar-proposal.html">Seminar Proposal Dan Pendadaran</a></li>
              </ul>
            </li>
            <li class="dropdown-submenu">
              <a href="#">Ketentuan Ujian Tulis Dan Kelulusan <svg width="12" height="12" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg></a>
              <ul class="dropdown-menu">
                <li><a href="/ketentuan-ujian.html">Ketentuan Ujian</a></li>
                <li><a href="/tata-tertib-ujian.html">Tata Tertib Ujian</a></li>
                <li><a href="/kelulusan.html">Kelulusan</a></li>
                <li><a href="/yudisium.html">Yudisium</a></li>
              </ul>
            </li>
            <li><a href="https://stimykpn.ecampuz.com/">E-Campuz</a></li>
            <li><a href="/perpustakaan.html">Perpustakaan</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="/pmb.html">PMB <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg></a>
          <ul class="dropdown-menu">
            <li><a href="/pmb.html">Pendaftaran</a></li>
            <li><a href="/biaya-kuliah.html">Biaya Kuliah</a></li>
            <li><a href="/beasiswa.html">Beasiswa</a></li>
            <li><a href="/program-reguler.html">Program Reguler</a></li>
            <li><a href="/program-ekstensi.html">Program Ekstensi</a></li>
            <li><a href="/pengumuman-diterima.html">Pengumuman Diterima</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Penelitian</a>
          <ul class="dropdown-menu">
            <li><a href="https://journal.stimykpn.ac.id/index.php/tb" target="_blank" rel="noopener noreferrer">Jurnal
                Telaah Bisnis</a></li>
            <li><a href="https://journal.stimykpn.ac.id/index.php/cb" target="_blank" rel="noopener noreferrer">Jurnal
                Cakrawangsa Bisnis</a></li>
            <li class="dropdown-submenu">
              <a href="#">Jurnal/Artikel Dosen <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg></a>
              <ul class="dropdown-menu">
                <li><a href="/jurnal-penelitian.html">Penelitian Dosen</a></li>
                <li><a href="/jurnal-pengabdian.html">Pengabdian Dosen</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Kemahasiswaan</a>
          <ul class="dropdown-menu">
            <li><a href="/kegiatan-mahasiswa.html">Kegiatan Mahasiswa</a></li>
            <li><a href="/ukm.html">UKM</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Campus Life</a>
          <ul class="dropdown-menu">
            <li><a href="/video.html">Video</a></li>
            <li><a href="/informasi-tempat-tinggal.html">Informasi Tempat Tinggal</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Informasi</a>
          <ul class="dropdown-menu">
            <li><a href="/brosur.html">Brosur</a></li>
            <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">Portal</a></li>
            <li><a href="/unduh.html">Unduh</a></li>
            <li><a href="/alumni.html">Alumni</a></li>
            <li><a href="/lowongan-kerja.html">Lowongan Kerja</a></li>
          </ul>
        </li>
      </ul>

      <div class="nav-cta">
        <a href="/pmb.html" class="btn btn-orange btn-pulse" id="navCtaBtn">Daftar PMB</a>
        <div class="nav-toggle" id="navToggle">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </nav>

  <!-- ============================================
       SECTION 2: HERO
       ============================================ -->
  <section class="hero" id="beranda">
    <div class="hero-slider" id="heroSlider">
      <div class="slide active">
        <img src="/images/hero-bg.png" alt="STIM YKPN Campus 1" loading="eager">
      </div>
      <div class="slide">
        <img src="/images/students.png" alt="STIM YKPN Campus 2" loading="lazy">
      </div>
      <div class="slide">
        <img src="/images/hero_bg.png" alt="STIM YKPN Campus 3" loading="lazy">
      </div>
      <div class="hero-overlay"></div>

      <!-- Slider Controls -->
      <button class="slider-btn prev-btn" id="heroPrevBtn" aria-label="Previous slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <button class="slider-btn next-btn" id="heroNextBtn" aria-label="Next slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="m9 18 6-6-6-6" />
        </svg>
      </button>

      <div class="slider-dots" id="heroSliderDots">
        <button class="dot active" data-index="0" aria-label="Slide 1"></button>
        <button class="dot" data-index="1" aria-label="Slide 2"></button>
        <button class="dot" data-index="2" aria-label="Slide 3"></button>
      </div>
    </div>

    <!-- Decorative circles -->
    <div class="hero-decor hero-decor-1"></div>
    <div class="hero-decor hero-decor-2"></div>
    <div class="hero-decor hero-decor-3"></div>

    <div class="container">
      <div class="hero-content">
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

        <div class="hero-actions">
          <a href="/pmb.html" class="btn btn-orange btn-pulse">
            Daftar PMB
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg>
          </a>
          <a href="#campus-tour" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polygon points="5 3 19 12 5 21 5 3" />
            </svg>
            Virtual Tour
          </a>
        </div>

        <div class="hero-stats">
          <div class="hero-stat">
            <div class="stat-number" data-count="50">0</div>
            <div class="stat-label">Tahun Berdiri</div>
          </div>
          <div class="hero-stat">
            <div class="stat-number" data-count="15000" data-suffix="+">0</div>
            <div class="stat-label">Alumni Profesional</div>
          </div>
          <div class="hero-stat">
            <div class="stat-number" data-count="4" data-suffix="">0</div>
            <div class="stat-label">Sertifikasi Profesi</div>
          </div>
        </div>
      </div>
    </div>

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

        <div class="why-card animate-on-scroll animate-delay-4">
          <div class="why-card-decor"></div>
          <div class="icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polygon
                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
          </div>
          <div class="stat-num">A</div>
          <h4>Terakreditasi Baik Sekali</h4>
          <p>Mendapatkan pengakuan akreditasi Baik Sekali dari BAN-PT untuk menjamin kualitas standar mutu pendidikan
            tinggi.</p>
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

  <!-- ============================================
       SECTION 10: FOOTER
       ============================================ -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">
            <img src="/images/img/logo/logo-stim-new.png" alt="STIM YKPN" style="height: 50px;">
          </div>
          <p>
            Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta — Berpengalaman lebih dari 50 tahun
            dalam menyelenggarakan pendidikan tinggi di bidang Manajemen.
          </p>
          <div class="address">
            📍 Jl. Palagan Tentara Pelajar Km. 7, Yogyakarta 55581 Indonesia
          </div>
          <div class="contact-info">
            <a href="tel:0274885505">📞 (0274) 885505</a>
            <a href="mailto:info@stimykpn.ac.id">✉️ info@stimykpn.ac.id</a>
            <a href="https://wa.me/6285707010333">💬 0857-0701-0333 (PMB)</a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Our Campus</h4>
          <ul>
            <li><a href="/sambutan-ketua.html">Sambutan Ketua</a></li>
            <li><a href="/profil.html">Profil STIM YKPN</a></li>
            <li><a href="/visi-misi.html">Visi & Misi</a></li>
            <li><a href="/dosen.html">Dosen</a></li>
            <li><a href="/fasilitas.html">Fasilitas</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Pendaftaran</h4>
          <ul>
            <li><a href="/pmb.html">Daftar Online</a></li>
            <li><a href="/biaya-kuliah.html">Biaya Kuliah</a></li>
            <li><a href="/program-reguler.html">Program Reguler</a></li>
            <li><a href="/program-ekstensi.html">Program Ekstensi</a></li>
            <li><a href="/beasiswa.html">Beasiswa</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Akademik</h4>
          <ul>
            <li><a href="/sasaran-pendidikan.html">S1 Manajemen</a></li>
            <li><a href="/sasaran-pendidikan.html">D3 Manajemen</a></li>
            <li><a href="/kalender-akademik.html">Kalender Akademik</a></li>
            <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">E-Campuz Portal</a>
            </li>
            <li><a href="/perpustakaan.html">Perpustakaan</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="copyright">
          © 2026 STIM YKPN Yogyakarta. All rights reserved.
        </div>
        <div class="footer-socials">
          <a href="#" aria-label="Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
            </svg>
          </a>
          <a href="#" aria-label="LinkedIn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- WhatsApp Floating Button -->
  <div class="wa-floating-container">
    <div class="wa-popup" id="waPopup">
      <div class="wa-popup-header">
        <div class="wa-popup-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.06-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
          </svg>
          <strong>Hubungi Kami</strong>
        </div>
        <button class="wa-popup-close" id="waCloseBtn">&times;</button>
      </div>
      <div class="wa-popup-body">
        <p class="wa-greeting">Halo! Ada yang bisa kami bantu? Pilih layanan admin di bawah ini:</p>
        <a href="https://wa.me/6285707010333" class="wa-admin-card" target="_blank" rel="noopener noreferrer">
          <div class="wa-admin-avatar">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </div>
          <div class="wa-admin-info">
            <strong>Admin PMB</strong>
            <span>Informasi Pendaftaran Mahasiswa Baru</span>
          </div>
          <svg class="wa-admin-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </a>
        <a href="https://wa.me/6285707010333" class="wa-admin-card" target="_blank" rel="noopener noreferrer">
          <div class="wa-admin-avatar">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </div>
          <div class="wa-admin-info">
            <strong>Admin PMB 2</strong>
            <span>Informasi Pendaftaran Mahasiswa Baru</span>
          </div>
          <svg class="wa-admin-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Toggle Button -->
    <button class="wa-toggle-btn" id="waToggleBtn">
      <div class="wa-badge">2</div>
      <svg class="wa-icon" width="32" height="32" viewBox="0 0 24 24" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path
          d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.06-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
      </svg>
      <div class="wa-we-are-here">We Are Here!</div>
    </button>
  </div>

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>

</html>
