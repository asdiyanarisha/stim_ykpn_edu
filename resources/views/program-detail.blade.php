<!DOCTYPE html>
<html lang="id">
<head>
  <x-seo-head
    title="{{ $programTitle }} — STIM YKPN Yogyakarta"
    description="Program Studi {{ $programTitle }} STIM YKPN Yogyakarta terakreditasi Baik Sekali. Siap mencetak pemimpin bisnis dan manajer masa depan."
    :canonicalUrl="url('/program/' . $slug)"
  />
  <link rel="icon" type="image/png" href="/images/img/logo/logo-stim-new.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.8">

  <style>
    body { background-color: #f8fafc; overflow-x: hidden; }

    /* ============================================
       1. HERO SECTION (Dynamic & Premium)
       ============================================ */
    .program-hero {
      position: relative;
      background: var(--navy-900);
      color: white;
      padding: 160px 0 120px;
      overflow: hidden;
    }

    /* Background Image with Parallax & Soft Overlay */
    .program-hero-bg {
      position: absolute;
      top: 0; left: 0; width: 100%; height: 120%;
      background: url('/images/STIMYK/optimized_STIMYK-290.jpg') center/cover;
      opacity: 0.3;
      z-index: 0;
      transform: translateY(0); /* Parallax starting point */
    }

    /* Gradient overlay for text readability */
    .program-hero::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; width: 100%; height: 50%;
      background: linear-gradient(to top, var(--navy-900), transparent);
      z-index: 1;
    }

    .program-hero .container {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .hero-badge {
      display: inline-block;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.2);
      color: var(--orange-400);
      padding: 8px 24px;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 1.5px;
      margin-bottom: 24px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0px); }
    }

    .hero-title {
      font-size: 56px;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 24px;
      background: linear-gradient(135deg, #ffffff 0%, #fcd279 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-transform: uppercase;
    }

    .hero-subtitle {
      font-size: 20px;
      max-width: 750px;
      margin: 0 auto;
      color: var(--gray-300);
      line-height: 1.7;
    }

    /* ============================================
       2. HIGHLIGHT CARDS (Glassmorphism overlap)
       ============================================ */
    .highlights-wrapper {
      position: relative;
      z-index: 10;
      margin-top: -80px;
      margin-bottom: 80px;
    }

    .highlights-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }

    .highlight-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      padding: 35px 30px;
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
      border: 1px solid rgba(255,255,255,1);
      text-align: center;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
    }

    .highlight-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; width: 100%; height: 4px;
      background: linear-gradient(90deg, var(--orange-500), var(--blue-500));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .highlight-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
    }

    .highlight-card:hover::before {
      transform: scaleX(1);
    }

    .hc-icon {
      width: 70px;
      height: 70px;
      margin: 0 auto 20px;
      background: linear-gradient(135deg, rgba(241, 135, 33, 0.1) 0%, rgba(0, 96, 186, 0.05) 100%);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--orange-500);
      transition: transform 0.3s ease;
    }

    .highlight-card:hover .hc-icon {
      transform: scale(1.1) rotate(5deg);
      color: var(--blue-500);
    }

    .highlight-card h4 {
      font-size: 16px;
      color: var(--gray-500);
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
    }

    .highlight-card p {
      color: var(--navy-900);
      font-size: 24px;
      font-weight: 800;
    }

    /* ============================================
       3. MAIN CONTENT (Premium Article Layout)
       ============================================ */
    .content-layout {
      display: grid;
      grid-template-columns: 1fr;
      gap: 60px;
      margin-bottom: 80px;
    }

    .article-block {
      background: white;
      border-radius: 30px;
      padding: 60px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.02);
      border: 1px solid var(--gray-100);
    }

    .section-title {
      font-size: 32px;
      color: var(--navy-900);
      margin-bottom: 30px;
      font-weight: 800;
      position: relative;
      padding-bottom: 20px;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 80px; height: 5px;
      background: linear-gradient(90deg, var(--orange-500), var(--coral-500));
      border-radius: 5px;
    }

    .prose {
      color: var(--gray-600);
      font-size: 18px;
      line-height: 1.8;
    }
    
    .prose p { margin-bottom: 24px; }

    /* ============================================
       4. CONCENTRATION PILLS (Interactive List)
       ============================================ */
    .concentration-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-top: 40px;
    }

    .concentration-item {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      padding: 24px;
      border-radius: 20px;
      display: flex;
      align-items: flex-start;
      gap: 20px;
      transition: all 0.3s ease;
      cursor: default;
    }

    .concentration-item:hover {
      background: white;
      border-color: var(--blue-300);
      box-shadow: 0 10px 20px rgba(0,96,186,0.05);
      transform: translateX(5px);
    }

    .concentration-icon {
      width: 48px; height: 48px;
      background: white;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--blue-500);
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      flex-shrink: 0;
    }

    .concentration-text h4 {
      font-size: 18px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 6px;
    }

    .concentration-text p {
      font-size: 15px;
      color: var(--gray-500);
      line-height: 1.5;
      margin: 0;
    }

    /* ============================================
       5. CAREER PROSPECTS (Colorful Cards)
       ============================================ */
    .career-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      margin-top: 40px;
    }

    .career-card {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 20px 24px;
      background: white;
      border: 1px solid var(--gray-200);
      border-radius: 16px;
      transition: all 0.3s ease;
    }

    .career-card:hover {
      background: var(--navy-900);
      border-color: var(--navy-900);
    }

    .career-card:hover span {
      color: white;
    }

    .career-card:hover svg {
      color: var(--orange-400);
    }

    .career-card svg {
      color: var(--blue-500);
      transition: color 0.3s ease;
      flex-shrink: 0;
    }

    .career-card span {
      font-size: 16px;
      font-weight: 700;
      color: var(--navy-900);
      transition: color 0.3s ease;
    }

    /* ============================================
       6. CTA BANNER (Vibrant bottom)
       ============================================ */
    .cta-banner {
      background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-400) 100%);
      border-radius: 30px;
      padding: 60px;
      text-align: center;
      color: white;
      margin-bottom: 80px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 75, 147, 0.2);
    }

    /* Decorative circles */
    .cta-banner::before, .cta-banner::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
    }
    .cta-banner::before {
      width: 300px; height: 300px;
      top: -100px; left: -100px;
    }
    .cta-banner::after {
      width: 200px; height: 200px;
      bottom: -50px; right: -50px;
    }

    .cta-banner h2 {
      font-size: 36px;
      font-weight: 800;
      margin-bottom: 20px;
      position: relative;
      z-index: 2;
    }

    .cta-banner p {
      font-size: 18px;
      color: rgba(255,255,255,0.9);
      margin-bottom: 40px;
      position: relative;
      z-index: 2;
    }

    .cta-btn {
      display: inline-block;
      background: var(--orange-500);
      color: white;
      padding: 18px 40px;
      border-radius: 50px;
      font-size: 18px;
      font-weight: 800;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 10px 20px rgba(241, 135, 33, 0.3);
      position: relative;
      z-index: 2;
    }

    .cta-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 25px rgba(241, 135, 33, 0.4);
      background: var(--orange-400);
    }

    /* ============================================
       RESPONSIVE ADJUSTMENTS
       ============================================ */
    @media (max-width: 992px) {
      .hero-title { font-size: 48px; line-height: 1.1; }
      .highlights-grid { grid-template-columns: 1fr; gap: 20px; margin-top: -40px; }
      .concentration-grid { grid-template-columns: 1fr; }
      .article-block { padding: 40px 24px; }
      .cta-banner { padding: 40px 24px; }
      .cta-banner h2 { font-size: 28px; }
    }
  </style>
</head>
<body>

  @include('components.navbar')

  <!-- 1. HERO SECTION -->
  <header class="program-hero">
    <div class="program-hero-bg"></div>
    <div class="container">
      <div class="hero-badge">TERAKREDITASI BAIK SEKALI</div>
      <h1 class="hero-title animate-on-scroll">{{ $programTitle }}</h1>
      <p class="hero-subtitle animate-on-scroll animate-delay-1">
        Mencetak generasi pemimpin bisnis masa depan, wirausahawan inovatif, dan manajer profesional yang tangguh di era digital.
      </p>
    </div>
  </header>

  <!-- 2. HIGHLIGHT CARDS -->
  <div class="highlights-wrapper">
    <div class="container">
      <div class="highlights-grid animate-on-scroll animate-delay-2">
        <div class="highlight-card">
          <div class="hc-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <h4>Masa Studi</h4>
          <p>4 Tahun</p>
        </div>
        <div class="highlight-card">
          <div class="hc-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <h4>Gelar Lulusan</h4>
          <p>S.M.</p>
        </div>
        <div class="highlight-card">
          <div class="hc-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          </div>
          <h4>Total SKS</h4>
          <p>144 SKS</p>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. MAIN CONTENT -->
  <div class="container content-layout">
    
    <!-- Deskripsi & Konsentrasi -->
    <article class="article-block animate-on-scroll">
      <h2 class="section-title">Mengapa {{ $programTitle }} STIM YKPN?</h2>
      <div class="prose">
        <p>
          Program Studi Sarjana (S1) Manajemen di STIM YKPN Yogyakarta dirancang secara komprehensif untuk memberikan mahasiswa pemahaman mendalam tentang praktik manajemen modern, strategi bisnis inovatif, analisis keuangan, hingga pengelolaan sumber daya manusia yang adaptif.
        </p>
        <p>
          Kurikulum kami selalu diperbarui mengikuti perkembangan tren global. Melalui kombinasi pembelajaran teori di kelas dan praktik langsung berupa <i>study case</i>, program magang eksklusif, serta inkubasi bisnis, mahasiswa kami tempa untuk menjadi <i>problem solver</i> sejati yang kritis dan kreatif.
        </p>
      </div>

      <h2 class="section-title" style="margin-top: 60px;">Konsentrasi Peminatan</h2>
      <div class="prose">
        <p>Untuk mempertajam keahlian spesifik mahasiswa di semester tingkat atas, kami menawarkan 4 jalur konsentrasi unggulan:</p>
      </div>

      <div class="concentration-grid">
        <div class="concentration-item">
          <div class="concentration-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <div class="concentration-text">
            <h4>Manajemen Keuangan</h4>
            <p>Analisis pasar modal, investasi, perbankan, dan strategi tata kelola keuangan perusahaan.</p>
          </div>
        </div>
        <div class="concentration-item">
          <div class="concentration-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </div>
          <div class="concentration-text">
            <h4>Manajemen Pemasaran</h4>
            <p>Riset perilaku konsumen, strategi branding kreatif, dan optimasi <i>Digital Marketing</i>.</p>
          </div>
        </div>
        <div class="concentration-item">
          <div class="concentration-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5c-1.1 0-2 .9-2 2v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div class="concentration-text">
            <h4>Manajemen SDM</h4>
            <p>Fokus pada kepemimpinan, pengembangan organisasi, rekrutmen, dan tata kompensasi.</p>
          </div>
        </div>
        <div class="concentration-item">
          <div class="concentration-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <div class="concentration-text">
            <h4>Manajemen Operasional</h4>
            <p>Efisiensi lini produksi, rantai pasok (supply chain), dan sistem manajemen mutu terpadu.</p>
          </div>
        </div>
      </div>
    </article>

    <!-- Prospek Karier -->
    <article class="article-block animate-on-scroll">
      <h2 class="section-title">Prospek Karier Cemerlang</h2>
      <div class="prose">
        <p>
          Lulusan {{ $programTitle }} STIM YKPN Yogyakarta memiliki rekam jejak yang sangat baik dan tersebar di berbagai sektor strategis, baik itu di BUMN, perusahaan multinasional, instansi pemerintahan, maupun sukses merintis <i>startup</i> mereka sendiri.
        </p>
      </div>

      <div class="career-grid">
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5c-1.1 0-2 .9-2 2v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          <span>Manajer Profesional</span>
        </div>
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          <span>Konsultan Bisnis</span>
        </div>
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
          <span>Business Analyst</span>
        </div>
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          <span>Analis Keuangan & Bankir</span>
        </div>
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          <span>Pakar Digital Marketing</span>
        </div>
        <div class="career-card">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          <span>Entrepreneur / Founder</span>
        </div>
      </div>
    </article>

    <!-- Call to Action -->
    <div class="cta-banner animate-on-scroll">
      <h2>Siap Menjadi Pemimpin Bisnis Masa Depan?</h2>
      <p>Bergabunglah dengan ribuan alumni sukses STIM YKPN Yogyakarta. Kuota pendaftaran terbatas!</p>
      <a href="/pmb.html" class="cta-btn">Daftar Sekarang (PMB)</a>
    </div>

  </div>

  @include('components.footer')

  <script src="/js/script.js?v=3.8"></script>
</body>
</html>
