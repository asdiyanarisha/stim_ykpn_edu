<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Dosen — STIM YKPN Yogyakarta</title>
  <meta name="description" content="Kenali para pakar dan akademisi kami yang berdedikasi di STIM YKPN Yogyakarta.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css?v=2.3">
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

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
      <!-- Filter -->
      <div class="faculty-filter animate-on-scroll animate-delay-2">
        <button class="filter-btn active" data-filter="all">Semua</button>
        <button class="filter-btn" data-filter="keuangan">Keuangan</button>
        <button class="filter-btn" data-filter="pemasaran">Pemasaran</button>
        <button class="filter-btn" data-filter="sdm">SDM</button>
        <button class="filter-btn" data-filter="operasional">Operasional</button>
      </div>

      <!-- Grid -->
      <div class="faculty-grid">
        <!-- Dosen 1 -->
        <div class="faculty-card animate-on-scroll" data-category="keuangan">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80" alt="Dosen Keuangan">
            <div class="faculty-overlay">
              <a href="#" class="btn-white-outline" style="text-align: center;">Lihat Profil Lengkap</a>
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                <a href="#" class="faculty-social-link" title="Google Scholar"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 24a7 7 0 1 1 0-14 7 7 0 0 1 0 14zm1.626-9.456l-3.321 2.324-.954-2.887 3.361-2.313 1.346.541-.432 2.335zM5.445 12.35L12 7.6l6.555 4.75V15h-2v-1.3l-4.555-3.3-4.555 3.3V15h-2v-2.65zM12 0L0 8.5l2.222 1.611V16h2v-4.444L12 17l7.778-5.444V16h2v-5.889L24 8.5 12 0z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Dr. Budi Santoso, M.M.</h3>
            <p class="faculty-role">Ketua Program Studi Manajemen</p>
            <span class="faculty-expertise">Manajemen Keuangan</span>
          </div>
        </div>

        <!-- Dosen 2 -->
        <div class="faculty-card animate-on-scroll" data-category="pemasaran">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80" alt="Dosen Pemasaran">
            <div class="faculty-overlay">
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Prof. Dr. Rina Astuti, M.Si.</h3>
            <p class="faculty-role">Guru Besar</p>
            <span class="faculty-expertise">Manajemen Pemasaran</span>
          </div>
        </div>

        <!-- Dosen 3 -->
        <div class="faculty-card animate-on-scroll" data-category="sdm">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&q=80" alt="Dosen SDM">
            <div class="faculty-overlay">
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Dr. Hendra Wijaya, S.E., M.M.</h3>
            <p class="faculty-role">Dosen Senior</p>
            <span class="faculty-expertise">Manajemen SDM</span>
          </div>
        </div>

        <!-- Dosen 4 -->
        <div class="faculty-card animate-on-scroll" data-category="operasional">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&q=80" alt="Dosen Operasional">
            <div class="faculty-overlay">
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Anita Rahayu, S.M., M.Sc.</h3>
            <p class="faculty-role">Dosen Pengajar</p>
            <span class="faculty-expertise">Manajemen Operasional</span>
          </div>
        </div>

        <!-- Dosen 5 -->
        <div class="faculty-card animate-on-scroll" data-category="pemasaran">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&q=80" alt="Dosen Pemasaran">
            <div class="faculty-overlay">
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Dr. Aditya Pratama, M.B.A.</h3>
            <p class="faculty-role">Dosen Senior</p>
            <span class="faculty-expertise">Digital Marketing</span>
          </div>
        </div>

        <!-- Dosen 6 -->
        <div class="faculty-card animate-on-scroll" data-category="keuangan">
          <div class="faculty-img-wrap">
            <img src="https://images.unsplash.com/photo-1598550874175-4d0ef43ce5bb?w=600&q=80" alt="Dosen Keuangan">
            <div class="faculty-overlay">
              <div class="faculty-socials">
                <a href="#" class="faculty-social-link" title="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
              </div>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">Siti Aminah, S.E., M.Ak., CPA.</h3>
            <p class="faculty-role">Dosen Pengajar</p>
            <span class="faculty-expertise">Akuntansi Keuangan</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
