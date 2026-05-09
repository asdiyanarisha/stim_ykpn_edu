<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visi & Misi - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Visi dan Misi STIM YKPN Yogyakarta, termasuk Program Studi D3 dan S1 Manajemen.">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
    rel="stylesheet">

  <!-- Base Styles -->
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    /* ==============================================
       PREMIUM DYNAMIC LAYOUT - VISI & MISI
       ============================================== */
    :root {
      --vm-primary: #0f172a;
      --vm-accent: #f97316;
      --vm-accent-glow: rgba(249, 115, 22, 0.4);
      --vm-glass-bg: rgba(255, 255, 255, 0.05);
      --vm-glass-border: rgba(255, 255, 255, 0.1);
      --vm-text-muted: #94a3b8;
    }

    body {
      background-color: #f8fafc;
      overflow-x: hidden;
    }

    /* Restore normal navbar */
    .navbar {
      background: #ffffff;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    /* ==============================================
       HERO SECTION WITH ANIMATED GRADIENT
       ============================================== */
    .vm-hero {
      position: relative;
      background: linear-gradient(135deg, var(--vm-primary) 0%, #1e293b 100%);
      padding: 160px 0 220px;
      text-align: center;
      color: #fff;
      overflow: hidden;
    }

    /* Abstract Glow Shapes */
    .vm-hero::before,
    .vm-hero::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      z-index: 1;
      animation: float 10s infinite alternate ease-in-out;
    }

    .vm-hero::before {
      width: 400px;
      height: 400px;
      background: rgba(249, 115, 22, 0.2);
      top: -100px;
      left: -100px;
    }

    .vm-hero::after {
      width: 500px;
      height: 500px;
      background: rgba(56, 189, 248, 0.15);
      bottom: -150px;
      right: -100px;
      animation-delay: -5s;
    }

    @keyframes float {
      0% {
        transform: translate(0, 0) scale(1);
      }

      100% {
        transform: translate(50px, 50px) scale(1.1);
      }
    }

    /* Subtle grid texture */
    .vm-hero .grid-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image:
        linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
      background-size: 40px 40px;
      z-index: 1;
    }

    .vm-hero-content {
      position: relative;
      z-index: 2;
    }

    .vm-hero h1 {
      font-size: 56px;
      font-weight: 800;
      margin-bottom: 24px;
      letter-spacing: -1.5px;
      background: linear-gradient(to right, #ffffff, #cbd5e1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: slideUpFade 1s ease-out;
    }

    .vm-hero p {
      font-size: 20px;
      color: #cbd5e1;
      max-width: 650px;
      margin: 0 auto;
      line-height: 1.7;
      animation: slideUpFade 1s ease-out 0.2s backwards;
    }

    @keyframes slideUpFade {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ==============================================
       CONTENT WRAPPER
       ============================================== */
    .vm-content-wrapper {
      max-width: 1200px;
      margin: -140px auto 0;
      position: relative;
      z-index: 10;
      padding: 0 24px;
    }

    /* ==============================================
       VISI BOX - PREMIUM GLASSMORPHISM
       ============================================== */
    .visi-box {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.5);
      border-radius: 24px;
      box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.08),
        0 0 0 1px rgba(255, 255, 255, 0.8) inset;
      padding: 80px 60px;
      text-align: center;
      margin-bottom: 100px;
      position: relative;
      overflow: hidden;
      transform-origin: center bottom;
      animation: scaleUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s backwards;
    }

    @keyframes scaleUp {
      0% {
        opacity: 0;
        transform: scale(0.95) translateY(20px);
      }

      100% {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    /* Top Accent Line */
    .visi-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, var(--vm-accent), #fb923c, #fcd34d);
    }

    .visi-label {
      display: inline-block;
      font-size: 15px;
      font-weight: 800;
      color: var(--vm-accent);
      text-transform: uppercase;
      letter-spacing: 5px;
      margin-bottom: 30px;
      position: relative;
    }

    .visi-label::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 40px;
      height: 3px;
      background: var(--vm-accent);
      border-radius: 2px;
    }

    .visi-text {
      font-size: 40px;
      font-weight: 700;
      color: var(--vm-primary);
      line-height: 1.4;
      font-family: "Georgia", serif;
      max-width: 900px;
      margin: 0 auto;
      text-wrap: balance;
    }

    .visi-quote-icon {
      font-size: 80px;
      color: rgba(249, 115, 22, 0.1);
      position: absolute;
      top: 40px;
      left: 40px;
      font-family: serif;
      line-height: 1;
      pointer-events: none;
    }

    .visi-quote-icon.right {
      top: auto;
      left: auto;
      bottom: 0px;
      right: 40px;
    }

    /* ==============================================
       MISI SECTION - DYNAMIC GRID
       ============================================== */
    .misi-section {
      margin-bottom: 120px;
    }

    .section-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-header h2 {
      font-size: 36px;
      font-weight: 800;
      color: var(--vm-primary);
      position: relative;
      display: inline-block;
      padding-bottom: 16px;
    }

    .section-header h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: var(--vm-accent);
      border-radius: 2px;
    }

    .misi-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 32px;
    }

    .misi-item {
      background: #ffffff;
      padding: 40px;
      border-radius: 20px;
      display: flex;
      gap: 24px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      border: 1px solid rgba(0, 0, 0, 0.04);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
      align-items: flex-start;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .misi-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(249, 115, 22, 0.03) 0%, transparent 100%);
      z-index: -1;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .misi-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
      border-color: rgba(249, 115, 22, 0.2);
    }

    .misi-item:hover::before {
      opacity: 1;
    }

    .misi-number {
      flex-shrink: 0;
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--vm-primary), #1e293b);
      color: #fff;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: 800;
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
      position: relative;
      transition: transform 0.4s ease;
    }

    .misi-item:hover .misi-number {
      transform: scale(1.05) rotate(-5deg);
      background: linear-gradient(135deg, var(--vm-accent), #fb923c);
      box-shadow: 0 8px 20px var(--vm-accent-glow);
    }

    .misi-desc {
      font-size: 17px;
      line-height: 1.7;
      color: #475569;
      padding-top: 6px;
    }

    /* ==============================================
       PROGRAM STUDI SECTION
       ============================================== */
    .prodi-section {
      background: #ffffff;
      padding: 120px 0;
      position: relative;
    }

    /* Background pattern */
    .prodi-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.05), transparent);
    }

    .prodi-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 48px;
      padding: 0 24px;
    }

    .prodi-card {
      background: #f8fafc;
      padding: 56px;
      border-radius: 24px;
      border: 1px solid rgba(0, 0, 0, 0.04);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .prodi-card:hover {
      background: #ffffff;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.06);
      transform: translateY(-5px);
    }

    .prodi-card::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--vm-primary);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .prodi-card.s1::after {
      background: var(--vm-accent);
    }

    .prodi-card:hover::after {
      transform: scaleX(1);
    }

    .prodi-title {
      font-size: 28px;
      font-weight: 800;
      color: var(--vm-primary);
      margin-bottom: 40px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .prodi-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 24px;
    }

    .prodi-card.d3 .prodi-icon {
      background: var(--vm-primary);
    }

    .prodi-card.s1 .prodi-icon {
      background: var(--vm-accent);
    }

    .pv-label,
    .pm-label {
      font-size: 13px;
      font-weight: 800;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-bottom: 16px;
    }

    .pv-text {
      font-size: 18px;
      color: var(--vm-primary);
      line-height: 1.6;
      margin-bottom: 48px;
      font-weight: 600;
      padding-left: 20px;
      border-left: 3px solid var(--vm-primary);
    }

    .prodi-card.s1 .pv-text {
      border-left-color: var(--vm-accent);
    }

    .pm-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .pm-list li {
      position: relative;
      padding-left: 32px;
      margin-bottom: 20px;
      font-size: 16px;
      color: #475569;
      line-height: 1.7;
    }

    .pm-list li::before {
      content: '';
      position: absolute;
      left: 0;
      top: 8px;
      width: 16px;
      height: 16px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230f172a' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
    }

    .prodi-card.s1 .pm-list li::before {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23f97316' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
    }

    /* ==============================================
       RESPONSIVE DESIGN
       ============================================== */
    @media (max-width: 1024px) {
      .vm-hero h1 {
        font-size: 48px;
      }

      .visi-text {
        font-size: 32px;
      }

      .misi-grid,
      .prodi-container {
        grid-template-columns: 1fr;
      }

      .visi-box {
        padding: 60px 40px;
      }
    }

    @media (max-width: 768px) {
      .vm-hero {
        padding: 120px 0 180px;
      }

      .vm-hero h1 {
        font-size: 36px;
      }

      .vm-hero p {
        font-size: 18px;
      }

      .visi-box {
        padding: 50px 24px;
        margin-bottom: 80px;
        border-radius: 16px;
      }

      .visi-text {
        font-size: 26px;
      }

      .misi-item {
        flex-direction: column;
        gap: 20px;
        padding: 32px 24px;
      }

      .prodi-card {
        padding: 40px 24px;
      }

      .prodi-title {
        font-size: 24px;
      }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>

<body>

  @include('components.navbar')

  <!-- ============================================
       HERO BACKGROUND
       ============================================ -->
  <div class="vm-hero">
    <div class="grid-overlay"></div>
    <div class="container vm-hero-content animate-on-scroll">
      <h1>Visi & Misi</h1>
      <p>Arah kebijakan dan komitmen teguh STIM YKPN Yogyakarta dalam mencetak generasi unggul di bidang manajemen
        bisnis.</p>
    </div>
  </div>

  <!-- ============================================
       MAIN CONTENT WRAPPER
       ============================================ -->
  <main class="vm-content-wrapper">

    <!-- Visi Box -->
    <div class="visi-box animate-on-scroll">
      <div class="visi-quote-icon">"</div>
      <span class="visi-label">Visi Kami</span>
      <div class="visi-text">
        Menjadi Sekolah Tinggi Ilmu Manajemen yang unggul di tingkat nasional pada tahun 2030.
      </div>
      <div class="visi-quote-icon right">"</div>
    </div>

    <!-- Misi Box -->
    <div class="misi-section">
      <div class="section-header animate-on-scroll">
        <h2>Misi Kami</h2>
      </div>

      <div class="misi-grid">
        <div class="misi-item animate-on-scroll">
          <div class="misi-number">1</div>
          <div class="misi-desc">Menyelenggarakan proses pendidikan dan pengajaran di bidang manajemen dengan dukungan
            sumberdaya manusia yang profesional, sarana dan prasarana yang memadai, dan lingkungan yang kondusif untuk
            menghasilkan lulusan yang berkualitas.</div>
        </div>
        <div class="misi-item animate-on-scroll animate-delay-1">
          <div class="misi-number">2</div>
          <div class="misi-desc">Menyelenggarakan kegiatan penelitian guna pengembangan ilmu manajemen dan memberi
            manfaat bagi dunia bisnis.</div>
        </div>
        <div class="misi-item animate-on-scroll">
          <div class="misi-number">3</div>
          <div class="misi-desc">Menyelenggarakan kegiatan pengabdian kepada masyarakat untuk memberi kontribusi kepada
            pemangku kepentingan.</div>
        </div>
        <div class="misi-item animate-on-scroll animate-delay-1">
          <div class="misi-number">4</div>
          <div class="misi-desc">Mengembangkan Sekolah Tinggi menjadi organisasi yang sehat dengan sistem tata kelola
            yang baik.</div>
        </div>
      </div>
    </div>

  </main>

  <!-- ============================================
       PROGRAM STUDI SECTION
       ============================================ -->
  <section class="prodi-section">
    <div class="section-header animate-on-scroll">
      <h2>Program Studi</h2>
    </div>

    <div class="prodi-container">

      <!-- Prodi D3 -->
      <div class="prodi-card d3 animate-on-scroll">
        <h3 class="prodi-title">
          <div class="prodi-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
              <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
          </div>
          Manajemen Diploma III
        </h3>

        <div class="pv-label">Visi Program Studi</div>
        <div class="pv-text">
          Menjadi program studi Manajemen Diploma III yang unggul di bidang pemasaran dan keuangan di tingkat nasional
          pada tahun 2030.
        </div>

        <div class="pm-label">Misi Program Studi</div>
        <ul class="pm-list">
          <li>Meyelenggarakan proses pendidikan dan pengajaran yang berkualitas dengan dukungan sarana dan prasarana
            yang memadai serta sumberdaya manusia yang profesional.</li>
          <li>Menyelenggarakan kegiatan penelitian bagi dosen guna pengembangan dan penerapan ilmu manajemen yang
            aplikatif.</li>
          <li>Menyelenggarakan kegiatan pengabdian kepada masyarakat yang dapat memberikan kontribusi kepada pemangku
            kepentingan.</li>
          <li>Mengembangkan program studi manajemen D III menjadi organisasi yang sehat dengan tata kelola yang baik.
          </li>
        </ul>
      </div>

      <!-- Prodi S1 -->
      <div class="prodi-card s1 animate-on-scroll animate-delay-1">
        <h3 class="prodi-title">
          <div class="prodi-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
            </svg>
          </div>
          Manajemen Jenjang S1
        </h3>

        <div class="pv-label">Visi Program Studi</div>
        <div class="pv-text">
          Menjadi Program Studi Manajemen yang unggul di tingkat Nasional pada tahun 2030.
        </div>

        <div class="pm-label">Misi Program Studi</div>
        <ul class="pm-list">
          <li>Menyelenggarakan pendidikan dan pengajaran yang berkualitas dengan didukung sarana dan prasarana yang
            memadai serta sumber daya manusia yang profesional.</li>
          <li>Menyelenggarakan kegiatan penelitian bagi dosen dan mahasiswa guna pengembangan ilmu manajemen.</li>
          <li>Menyelenggarakan kegiatan pengabdian kepada masyarakat yang dapat memberikan kontribusi kepada pemangku
            kepentingan.</li>
          <li>Mengembangkan program studi manajemen (S1) menjadi organisasi yang sehat di tata kelola yang baik.</li>
        </ul>
      </div>

    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>

</html>
