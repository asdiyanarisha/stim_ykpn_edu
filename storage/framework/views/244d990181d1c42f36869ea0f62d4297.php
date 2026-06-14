<!-- ============================================
     SECTION 1: NAVBAR (Reusable Component)
     ============================================ -->
<nav class="navbar" id="navbar">
  <div class="container">
    <a href="/" class="navbar-brand">
      <img src="/images/img/logo/logo-stim-new.webp" alt="STIM YKPN" class="brand-logo">
    </a>

    <ul class="nav-links" id="navLinks">
      <li><a href="/" class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">Beranda</a></li>
      <li class="dropdown">
        <a href="#">Profil <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="/sambutan-ketua">Sambutan Ketua</a></li>
          <li><a href="/visi-misi">Visi & Misi</a></li>
          <li><a href="/profil">Profil STIM YKPN</a></li>
          <li><a href="/logo">Logo & Lambang</a></li>
          <li><a href="/dosen">Dosen</a></li>
          <li><a href="/pimpinan">Pimpinan</a></li>
          <li><a href="/fasilitas">Fasilitas</a></li>
          <li><a href="/prestasi">Prestasi</a></li>
          <li><a href="/spmi">SPMI & Akreditasi</a></li>
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
              <li><a href="/sasaran-pendidikan">Sasaran Pendidikan</a></li>
              <li><a href="/cara-mencapai-sasaran">Cara Mencapai Sasaran</a></li>
              <li><a href="/beban-studi">Beban Studi</a></li>
              <li><a href="/sks">Sistem Kredit Semester (SKS)</a></li>
              <li><a href="/jenjang-studi">Jenjang Studi Dan Masa Studi</a></li>
              <li><a href="/kegiatan-akademik">Kegiatan Akademik</a></li>
              <li><a href="/dosen-pembimbing">Dosen Pembimbing</a></li>
              <li><a href="/sanksi-akademik">Sanksi Akademik</a></li>
            </ul>
          </li>
          <li><a href="/kalender-akademik" onclick="gtag('event', 'click_kalender_akademik')">Kalender Akademik</a></li>
          <li class="dropdown-submenu">
            <a href="#">Ketentuan Perkuliahan <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg></a>
            <ul class="dropdown-menu">
              <li><a href="/kehadiran-kuliah">Kehadiran Kuliah</a></li>
              <li><a href="/tata-tertib-kuliah">Tata Tertib Kuliah</a></li>
              <li><a href="/jumlah-kehadiran">Jumlah Kehadiran</a></li>
              <li><a href="/seminar-proposal">Seminar Proposal Dan Pendadaran</a></li>
            </ul>
          </li>
          <li class="dropdown-submenu">
            <a href="#">Ketentuan Ujian Tulis Dan Kelulusan <svg width="12" height="12" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg></a>
            <ul class="dropdown-menu">
              <li><a href="/ketentuan-ujian">Ketentuan Ujian</a></li>
              <li><a href="/tata-tertib-ujian">Tata Tertib Ujian</a></li>
              <li><a href="/kelulusan">Kelulusan</a></li>
              <li><a href="/yudisium">Yudisium</a></li>
            </ul>
          </li>
          <li><a href="https://stimykpn.ecampuz.com/">E-Campuz</a></li>
          <li><a href="/perpustakaan">Perpustakaan</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="/pmb">PMB <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="/pmb">Pendaftaran</a></li>
          <li><a href="/biaya-kuliah">Biaya Kuliah</a></li>
          <li><a href="/beasiswa">Beasiswa</a></li>
          <li><a href="/program-reguler">Program Reguler</a></li>
          <li><a href="/program-ekstensi">Program Ekstensi</a></li>
          <li><a href="/pengumuman-diterima">Pengumuman Diterima</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">LMP2M <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
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
              <li><a href="/jurnal-penelitian">Penelitian Dosen</a></li>
              <li><a href="/jurnal-pengabdian">Pengabdian Dosen</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Kemahasiswaan <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="/kegiatan-mahasiswa">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm">UKM</a></li>
          <li><a href="/ppkpt">PPKPT</a></li>
          <li><a href="/pengumuman">Pengumuman</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Campus Life <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="/video">Video</a></li>
          <li><a href="/informasi-tempat-tinggal">Informasi Tempat Tinggal</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Informasi <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="/brosur">Brosur</a></li>
          <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">Portal</a></li>
          <li><a href="/unduh">Unduh</a></li>
          <li><a href="/alumni">Alumni</a></li>
          <li><a href="/lowongan-kerja">Lowongan Kerja</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Kontak <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg></a>
        <ul class="dropdown-menu">
          <li><a href="mailto:info@stimykpn.ac.id">info@stimykpn.ac.id</a></li>
          <li><a href="tel:0274885505">(0274) 885505</a></li>
        </ul>
      </li>
    </ul>

    <div class="nav-cta">
      <!-- Desktop Search Wrapper -->
      <div class="nav-search-wrapper" style="position: relative;">
        <!-- Search Trigger Desktop -->
        <button type="button" aria-label="Search" id="navSearchTrigger" class="search-trigger-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>

        <!-- Popover Search Form -->
        <div class="navbar-search-dropdown" id="navSearchDropdown">
          <form action="/berita" method="GET" class="dropdown-search-form">
            <input type="text" name="search" id="navSearchInput" placeholder="Cari info & berita..." required>
            <button type="submit" aria-label="Cari">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
          </form>
        </div>
      </div>

      <a href="/pmb" class="btn btn-orange btn-pulse" id="navCtaBtn">Daftar PMB</a>
      <div class="nav-toggle" id="navToggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile Menu Fix -->
<style>
  /* Hide WhatsApp & video modal when mobile menu is open */
  body.mobile-menu-open .wa-floating-container,
  body.mobile-menu-open .video-modal {
    display: none !important;
  }
  /* Boost mobile overlay above everything */
  .mobile-overlay {
    z-index: 99999 !important;
  }

  /* Search Trigger Button */
  .search-trigger-btn {
    background: #f1f5f9;
    border: none;
    cursor: pointer;
    color: #64748b;
    padding: 10px;
    border-radius: 50%;
    display: flex;
    margin-right: 16px;
    transition: all 0.3s ease;
  }
  .search-trigger-btn:hover,
  .search-trigger-btn.active {
    background: #f18721;
    color: #ffffff;
  }

  /* Popover Search Box */
  .navbar-search-dropdown {
    position: absolute;
    top: calc(100% + 14px);
    right: 0;
    width: 280px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    padding: 12px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 50;
    border: 1px solid #e2e8f0;
  }
  .navbar-search-dropdown::before {
    content: '';
    position: absolute;
    top: -6px;
    right: 30px;
    width: 10px;
    height: 10px;
    background: #ffffff;
    transform: rotate(45deg);
    border-top: 1px solid #e2e8f0;
    border-left: 1px solid #e2e8f0;
  }
  .navbar-search-dropdown.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }
  .dropdown-search-form {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border-radius: 8px;
    padding: 6px 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
  }
  .dropdown-search-form:focus-within {
    border-color: #3b82f6;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }
  .dropdown-search-form input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    font-size: 14px;
    color: #0f172a;
    padding: 4px 0;
  }
  .dropdown-search-form button {
    background: transparent;
    border: none;
    cursor: pointer;
    color: #64748b;
    display: flex;
    padding: 4px 0 4px 8px;
    transition: color 0.3s;
  }
  .dropdown-search-form button:hover {
    color: #f18721;
  }

  /* Search Form Mobile */
  .mobile-search-form {
    display: flex;
    align-items: center;
    background: #f1f5f9;
    border-radius: 12px;
    padding: 12px 16px;
    margin: 8px 16px 16px 16px;
  }
  .mobile-search-form input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    color: #0f172a;
  }
  .mobile-search-form button {
    background: transparent;
    border: none;
    color: #64748b;
  }
  @media (max-width: 1024px) {
    .nav-search-wrapper {
      display: none !important;
    }
  }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Desktop Dropdown Search
  var navSearchTrigger = document.getElementById('navSearchTrigger');
  var navSearchDropdown = document.getElementById('navSearchDropdown');
  var navSearchInput = document.getElementById('navSearchInput');

  if (navSearchTrigger && navSearchDropdown && navSearchInput) {
    navSearchTrigger.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      navSearchTrigger.classList.toggle('active');
      navSearchDropdown.classList.toggle('active');
      
      if (navSearchDropdown.classList.contains('active')) {
        setTimeout(function() { navSearchInput.focus(); }, 100);
      }
    });

    // Close search on outside click
    document.addEventListener('click', function(e) {
      if (!navSearchDropdown.contains(e.target) && !navSearchTrigger.contains(e.target)) {
        navSearchDropdown.classList.remove('active');
        navSearchTrigger.classList.remove('active');
      }
    });
  }

  // Hide WA button & video modal when mobile menu opens, show when it closes
  var waContainer = document.querySelector('.wa-floating-container');
  var videoModal = document.getElementById('videoModal');
  var mobileOverlay = document.getElementById('mobileOverlay');

  if (mobileOverlay) {
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(m) {
        if (m.attributeName === 'class') {
          if (mobileOverlay.classList.contains('active')) {
            if (waContainer) waContainer.style.display = 'none';
            if (videoModal) videoModal.style.display = 'none';
            document.body.classList.add('mobile-menu-open');
          } else {
            if (waContainer) waContainer.style.display = '';
            if (videoModal) videoModal.style.display = '';
            document.body.classList.remove('mobile-menu-open');
          }
        }
      });
    });
    observer.observe(mobileOverlay, { attributes: true });
  }
});
</script>

<!-- Mobile Menu Overlay -->
<div class="mobile-overlay" id="mobileOverlay">
  <div class="mobile-header">
    <a href="/">
      <img src="/images/img/logo/logo-stim-new.webp" alt="STIM YKPN" class="brand-logo" style="max-height: 40px;">
    </a>
    <button class="close-menu" id="closeMenu" aria-label="Close menu">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>
  <div class="mobile-menu-body">
    <nav class="mobile-nav-list">
      <!-- Prominent CTA for PMB -->
      <a href="/pmb" class="mobile-nav-item primary-cta">
        Daftar PMB
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
      </a>

      <!-- Search Form Mobile -->
      <form action="/berita" method="GET" class="mobile-search-form">
        <input type="text" name="search" placeholder="Cari berita & info..." required>
        <button type="submit" aria-label="Search">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
      </form>

      <a href="/" class="mobile-nav-item">
        Beranda
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
      </a>

      <!-- Profil Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Profil
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/sambutan-ketua">Sambutan Ketua</a>
          <a href="/visi-misi">Visi & Misi</a>
          <a href="/profil">Profil STIM YKPN</a>
          <a href="/logo">Logo & Lambang</a>
          <a href="/dosen">Dosen</a>
          <a href="/pimpinan">Pimpinan</a>
          <a href="/fasilitas">Fasilitas</a>
          <a href="/prestasi">Prestasi</a>
          <a href="/spmi">SPMI & Akreditasi</a>
        </div>
      </div>

      <!-- Akademik Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Akademik
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/sasaran-pendidikan">Sasaran Pendidikan</a>
          <a href="/cara-mencapai-sasaran">Cara Mencapai Sasaran</a>
          <a href="/beban-studi">Beban Studi</a>
          <a href="/sks">SKS</a>
          <a href="/jenjang-studi">Jenjang & Masa Studi</a>
          <a href="/kegiatan-akademik">Kegiatan Akademik</a>
          <a href="/dosen-pembimbing">Dosen Pembimbing</a>
          <a href="/sanksi-akademik">Sanksi Akademik</a>
          <a href="/kalender-akademik" onclick="gtag('event', 'click_kalender_akademik')">Kalender Akademik</a>
          <a href="https://stimykpn.ecampuz.com/">E-Campuz</a>
          <a href="/perpustakaan">Perpustakaan</a>
        </div>
      </div>

      <!-- PMB Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Pendaftaran (PMB)
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/pmb">Informasi Pendaftaran</a>
          <a href="/biaya-kuliah">Biaya Kuliah</a>
          <a href="/beasiswa">Beasiswa</a>
          <a href="/program-reguler">Program Reguler</a>
          <a href="/program-ekstensi">Program Ekstensi</a>
          <a href="/pengumuman-diterima">Pengumuman Diterima</a>
        </div>
      </div>

      <!-- Penelitian Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          LMP2M
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="https://journal.stimykpn.ac.id/index.php/tb" target="_blank">Jurnal Telaah Bisnis</a>
          <a href="https://journal.stimykpn.ac.id/index.php/cb" target="_blank">Jurnal Cakrawangsa Bisnis</a>
          <a href="/jurnal-penelitian">Penelitian Dosen</a>
          <a href="/jurnal-pengabdian">Pengabdian Dosen</a>
        </div>
      </div>

      <!-- Kemahasiswaan Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Kemahasiswaan
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/kegiatan-mahasiswa">Kegiatan Mahasiswa</a>
          <a href="/ukm">UKM</a>
          <a href="/ppkpt">PPKPT</a>
          <a href="/pengumuman">Pengumuman</a>
        </div>
      </div>

      <!-- Campus Life Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Campus Life
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/video">Video</a>
          <a href="/informasi-tempat-tinggal">Informasi Tempat Tinggal</a>
        </div>
      </div>

      <!-- Informasi Accordion -->
      <div class="mobile-nav-group">
        <div class="mobile-nav-item has-submenu">
          Informasi
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
        </div>
        <div class="mobile-submenu">
          <a href="/brosur">Brosur</a>
          <a href="https://stimykpn.ecampuz.com/" target="_blank">Portal</a>
          <a href="/unduh">Unduh</a>
          <a href="/alumni">Alumni</a>
          <a href="/lowongan-kerja">Lowongan Kerja</a>
        </div>
      </div>

    </nav>
  </div>
  <div class="mobile-menu-footer">
    <div class="mobile-contact-title">Hubungi Kami</div>
    <div class="mobile-contact-links">
      <a href="tel:0274885505" class="mobile-contact-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
        </svg>
        (0274) 885505
      </a>
      <a href="mailto:info@stimykpn.ac.id" class="mobile-contact-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="20" height="16" x="2" y="4" rx="2" />
          <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
        </svg>
        info@stimykpn.ac.id
      </a>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/components/navbar.blade.php ENDPATH**/ ?>