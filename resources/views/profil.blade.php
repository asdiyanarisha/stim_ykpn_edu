<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil & Sejarah - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Profil, Sejarah, Akreditasi, dan Sertifikasi STIM YKPN Yogyakarta.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Base Styles -->
  <link rel="stylesheet" href="/css/style.css?v=3.5">

  <style>
    /* ==============================================
       PROFIL LAYOUT (PREMIUM ACADEMIC)
       ============================================== */
    body {
      background-color: #f8fafc;
    /* Intro Section - Clean & Centered */
    .intro-section {
      padding: 120px 0 80px;
      background: #ffffff;
    }

    .intro-container {
      max-width: 900px;
      margin: 0 auto;
      text-align: center;
    }

    .intro-text {
      font-size: 28px;
      line-height: 1.7;
      color: var(--navy-900);
      font-weight: 700;
      font-family: var(--font-display);
      letter-spacing: -0.01em;
    }

    @media (max-width: 768px) {
      .intro-text { font-size: 22px; }
      .intro-section { padding: 80px 0 60px; }
    }

    /* Section Headers */
    .section-header {
      text-align: center;
      margin-bottom: 60px;
      position: relative;
    }

    .section-header h2 {
      font-size: 36px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 16px;
      font-family: var(--font-display);
    }

    .section-header p {
      font-size: 16px;
      color: #64748b;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* History Timeline */
    .history-section {
      padding: 80px 0 100px;
      background: #ffffff;
    }

    .timeline {
      max-width: 900px;
      margin: 0 auto;
      position: relative;
    }

    .timeline::before {
      content: '';
      position: absolute;
      top: 0; bottom: 0;
      left: 50%;
      width: 4px;
      background: linear-gradient(180deg, var(--navy-900) 0%, rgba(11,27,61,0.1) 100%);
      transform: translateX(-50%);
      border-radius: 4px;
    }

    .timeline-item {
      margin-bottom: 60px;
      position: relative;
      width: 50%;
    }

    .timeline-item:last-child {
      margin-bottom: 0;
    }

    .timeline-item:nth-child(odd) {
      left: 0;
      padding-right: 60px;
      text-align: right;
    }

    .timeline-item:nth-child(even) {
      left: 50%;
      padding-left: 60px;
    }

    .timeline-dot {
      position: absolute;
      top: 0;
      width: 24px; height: 24px;
      background: #ffffff;
      border-radius: 50%;
      border: 6px solid var(--orange-500);
      box-shadow: 0 0 0 4px rgba(241, 135, 33, 0.2);
      z-index: 2;
    }

    .timeline-item:nth-child(odd) .timeline-dot { right: -12px; }
    .timeline-item:nth-child(even) .timeline-dot { left: -12px; }

    .timeline-year {
      font-size: 36px;
      font-weight: 900;
      background: linear-gradient(90deg, var(--navy-900), #1e3a8a);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 12px;
      line-height: 1;
      font-family: var(--font-display);
    }

    .timeline-title {
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 16px;
    }

    .timeline-content {
      background: #f8fafc;
      padding: 30px;
      border-radius: 20px;
      border: 1px solid #f1f5f9;
      font-size: 15px;
      line-height: 1.7;
      color: #475569;
      box-shadow: 0 10px 30px rgba(0,0,0,0.02);
      transition: all 0.3s ease;
    }

    .timeline-content:hover {
      background: #ffffff;
      box-shadow: 0 15px 40px rgba(0,0,0,0.06);
      transform: translateY(-5px);
      border-color: #e2e8f0;
    }

    /* Accreditation Section */
    .accreditation-section {
      background: var(--navy-900);
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }

    .accreditation-section::before {
      content: '';
      position: absolute;
      top: 0; right: 0;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(241, 135, 33, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .accreditation-section .section-header h2 {
      color: #ffffff;
    }

    .accreditation-section .section-header p {
      color: rgba(255, 255, 255, 0.7);
    }

    .acc-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      max-width: 1100px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    .acc-card {
      background: rgba(255, 255, 255, 0.03);
      backdrop-filter: blur(10px);
      padding: 50px 30px;
      border-radius: 24px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.4s ease;
    }

    .acc-card:hover {
      transform: translateY(-10px);
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .acc-grade {
      font-size: 80px;
      font-weight: 900;
      background: linear-gradient(135deg, #f18721 0%, #fbd38d 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      line-height: 1;
      margin-bottom: 24px;
      font-family: var(--font-display);
    }

    .acc-title {
      font-size: 20px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 12px;
    }

    .acc-desc {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.6);
      line-height: 1.6;
    }

    /* Certification Section */
    .cert-section {
      padding: 100px 0;
      background: #f8fafc;
    }

    .cert-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .cert-item {
      display: flex;
      align-items: flex-start;
      gap: 24px;
      padding: 40px;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.03);
      border: 1px solid #f1f5f9;
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .cert-item::after {
      content: '';
      position: absolute;
      top: 0; left: 0; bottom: 0;
      width: 4px;
      background: var(--navy-900);
      transition: width 0.3s ease;
    }

    .cert-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
      border-color: #e2e8f0;
    }

    .cert-item:hover::after {
      width: 6px;
      background: var(--orange-500);
    }

    .cert-icon {
      width: 60px; height: 60px;
      background: linear-gradient(135deg, rgba(11,27,61,0.05) 0%, rgba(11,27,61,0.1) 100%);
      color: var(--navy-900);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .cert-item:hover .cert-icon {
      background: var(--navy-900);
      color: #ffffff;
      transform: rotate(-10deg) scale(1.1);
    }

    .cert-info h4 {
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 12px;
      font-size: 18px;
    }

    .cert-info p {
      font-size: 15px;
      color: #64748b;
      line-height: 1.7;
    }

    @media (max-width: 992px) {
      .cert-grid { grid-template-columns: 1fr; }
      .acc-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
      .intro-card { margin: -60px 20px 0; padding: 40px 20px; }
      .intro-text { font-size: 18px; }
      .timeline::before { left: 24px; }
      .timeline-item { width: 100%; padding-left: 64px !important; left: 0 !important; text-align: left !important; }
      .timeline-dot { left: 12px !important; }
      .acc-grid { grid-template-columns: 1fr; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Profil & Sejarah</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Lebih dari empat dekade mengabdi, mencetak profesional tangguh di bidang manajemen dan bisnis.
      </p>
    </div>
  </header>

  <!-- ============================================
       INTRO OVERVIEW
       ============================================ -->
  <section class="intro-section">
    <div class="container animate-on-scroll">
      <div class="intro-container">
        <div class="intro-text">
          Sekolah Tinggi Ilmu Manajemen YKPN (STIM YKPN) Yogyakarta merupakan lembaga pendidikan tinggi bereputasi yang didirikan oleh para pakar manajemen untuk memenuhi kebutuhan tenaga profesional di Indonesia.
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       HISTORY TIMELINE
       ============================================ -->
  <section class="history-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2>Sejarah Perjalanan</h2>
        <p>Evolusi institusi dari Akademi Manajemen Perusahaan hingga menjadi Sekolah Tinggi Ilmu Manajemen.</p>
      </div>

      <div class="timeline">
        
        <!-- Timeline Item 1 -->
        <div class="timeline-item animate-on-scroll">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1976</div>
          <div class="timeline-title">Pendirian AMP YKPN</div>
          <div class="timeline-content">
            Akademi Manajemen Perusahaan YKPN (AMP YKPN) didirikan pada 1 Januari 1976 oleh Drs. Noegroho Boedijoewono, Drs. Gunawan Adisaputro, MBA., dan Drs. Heidjrachman Ranupandojo. Program awal adalah Sarjana Muda Manajemen Perusahaan.
          </div>
        </div>

        <!-- Timeline Item 2 -->
        <div class="timeline-item animate-on-scroll">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1977 - 1991</div>
          <div class="timeline-title">Perkembangan Status Akademik</div>
          <div class="timeline-content">
            Kegiatan perkuliahan pindah ke kampus Balapan (1977). Program Diploma III Manajemen Perusahaan secara bertahap memperoleh Status Terdaftar (1978), Status Diakui (1985), hingga Status Disamakan oleh Mendikbud pada tahun 1991.
          </div>
        </div>

        <!-- Timeline Item 3 -->
        <div class="timeline-item animate-on-scroll">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1996</div>
          <div class="timeline-title">Kampus Terpadu Palagan</div>
          <div class="timeline-content">
            Kapasitas Kampus Balapan yang tidak lagi memadai mendorong pembangunan Kampus Terpadu di Jl. Palagan Tentara Pelajar. Perpindahan resmi ditandai dengan penandatanganan prasasti oleh Sri Sultan Hamengku Buwono X pada tahun 1996.
          </div>
        </div>

        <!-- Timeline Item 4 -->
        <div class="timeline-item animate-on-scroll">
          <div class="timeline-dot"></div>
          <div class="timeline-year">2006 - Sekarang</div>
          <div class="timeline-title">Menjadi STIM YKPN</div>
          <div class="timeline-content">
            Tepat di usia 30 tahun (1 Januari 2006), AMP YKPN resmi berkembang menjadi Sekolah Tinggi Ilmu Manajemen YKPN (STIM YKPN), membuka program Strata 1 (S1) Manajemen bersama dengan D3 Manajemen, menyelenggarakan kelas reguler maupun ekstensi.
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ============================================
       ACCREDITATION
       ============================================ -->
  <section class="accreditation-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2>Akreditasi BAN-PT</h2>
        <p>Komitmen pada mutu pendidikan dibuktikan melalui pengakuan resmi dari Badan Akreditasi Nasional Perguruan Tinggi.</p>
      </div>

      <div class="acc-grid">
        <div class="acc-card animate-on-scroll">
          <div class="acc-grade"><span>B</span></div>
          <div class="acc-title">Institusi STIM YKPN</div>
          <div class="acc-desc">Terakreditasi "Baik Sekali"<br>SK No. 167/SK/BAN-PT/Ak.Ppj/PT/III/2023</div>
        </div>
        
        <div class="acc-card animate-on-scroll animate-delay-1">
          <div class="acc-grade"><span>B</span></div>
          <div class="acc-title">S1 Manajemen</div>
          <div class="acc-desc">Program Sarjana Manajemen<br>SK No. 430/SK/BAN-PT/Ak-PPK/S/I/2021</div>
        </div>

        <div class="acc-card animate-on-scroll animate-delay-2">
          <div class="acc-grade"><span>B</span></div>
          <div class="acc-title">D3 Manajemen</div>
          <div class="acc-desc">Program Diploma III Manajemen<br>SK No. 6691/SK/BAN-PT/Ak-PNB/Dipl-III/X/2020</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       CERTIFICATION PARTNERSHIP
       ============================================ -->
  <section class="cert-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2>Kerjasama Sertifikasi Profesi</h2>
        <p>Membekali lulusan dengan kompetensi siap kerja melalui sertifikasi profesi berlisensi BNSP.</p>
      </div>

      <div class="cert-grid">
        
        <div class="cert-item animate-on-scroll">
          <div class="cert-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <div class="cert-info">
            <h4>Ekspor - Impor (BB-PPEI & LSP)</h4>
            <p>Pelatihan prosedur ekspor dan ujian sertifikasi kompetensi Pelaksana Ekspor bersama Kementerian Perdagangan RI dan LSP Ekspor Impor.</p>
          </div>
        </div>

        <div class="cert-item animate-on-scroll animate-delay-1">
          <div class="cert-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div class="cert-info">
            <h4>Pialang Pasar Modal (TICMI)</h4>
            <p>Pelatihan dan sertifikasi online The Indonesia Capital Market Institute untuk mencetak ahli pialang pasar modal Indonesia.</p>
          </div>
        </div>

        <div class="cert-item animate-on-scroll">
          <div class="cert-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <div class="cert-info">
            <h4>Perbankan & Pembiayaan</h4>
            <p>Sertifikasi profesi Teller, Customer Services, dan Manajerial Dasar Pembiayaan bekerja sama dengan LSP Perbankan & LSP Pembiayaan.</p>
          </div>
        </div>

        <div class="cert-item animate-on-scroll animate-delay-1">
          <div class="cert-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          </div>
          <div class="cert-info">
            <h4>Perpajakan & SDM</h4>
            <p>Sertifikasi Brevet A dan B bidang perpajakan, serta sertifikasi profesi Manajer HRD melalui LSP Manajemen Sumber Daya Manusia.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=3.6"></script>
</body>
</html>






