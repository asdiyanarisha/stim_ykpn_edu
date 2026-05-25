<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beasiswa - STIM YKPN Yogyakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    body {
      background-color: #f8fafc;
    }

    .academic-content-section {
      padding: 80px 0;
    }

    .academic-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 40px;
      align-items: start;
    }

    /* Sidebar Navigation */
    .academic-sidebar {
      background: #ffffff;
      border-radius: 16px;
      padding: 20px 0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
      border: 1px solid #e2e8f0;
      position: sticky;
      top: 100px;
    }

    .sidebar-title {
      font-size: 14px;
      font-weight: 800;
      color: var(--gray-400);
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 0 24px 12px;
      border-bottom: 1px solid #e2e8f0;
      margin-bottom: 12px;
    }

    .sidebar-menu {
      list-style: none;
    }

    .sidebar-menu li a {
      display: block;
      padding: 12px 24px;
      color: var(--navy-900);
      font-weight: 600;
      font-size: 15px;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
    }

    .sidebar-menu li a:hover {
      background: #f8fafc;
      color: var(--orange-500);
    }

    .sidebar-menu li a.active {
      color: var(--orange-500);
      background: rgba(241, 135, 33, 0.05);
      border-left-color: var(--orange-500);
    }

    /* Main Article */
    .academic-article {
      background: #ffffff;
      border-radius: 20px;
      padding: 50px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      border: 1px solid #e2e8f0;
    }

    .article-header {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px dashed #cbd5e1;
    }

    .article-header h2 {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy-900);
    }

    .article-body {
      color: #475569;
      font-size: 16px;
      line-height: 1.8;
    }

    .article-body p {
      margin-bottom: 20px;
    }

    .target-list {
      list-style: none;
      margin-top: 30px;
    }

    .target-list li {
      position: relative;
      padding-left: 40px;
      margin-bottom: 24px;
      background: #f8fafc;
      padding: 24px 24px 24px 60px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
    }

    .target-list li::before {
      content: '🎯';
      position: absolute;
      left: 20px;
      top: 24px;
      font-size: 20px;
    }

    .target-list li h4 {
      font-size: 18px;
      color: var(--navy-900);
      margin-bottom: 8px;
    }

    @media (max-width: 992px) {
      .academic-layout {
        grid-template-columns: 1fr;
      }

      .academic-sidebar {
        position: relative;
        top: 0;
      }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>

<body>

  <!-- NAVBAR -->
  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Beasiswa</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Berbagai
        program beasiswa untuk mendukung pendidikan mahasiswa berprestasi dan kurang mampu.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">

      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">PMB</div>
        <ul class="sidebar-menu">
          <li><a href="/pmb.html">Pendaftaran</a></li>
          <li><a href="/biaya-kuliah.html">Biaya Kuliah</a></li>
          <li><a href="/beasiswa.html" class="active">Beasiswa</a></li>
          <li><a href="/program-reguler.html">Program Reguler</a></li>
          <li><a href="/program-ekstensi.html">Program Ekstensi</a></li>
          <li><a href="/pengumuman-diterima.html">Pengumuman Diterima</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Bantuan Pendidikan & Beasiswa</h2>
        </div>
        <div class="article-body">

          <p style="margin-bottom: 30px;">STIM YKPN berkomitmen untuk terus berkontribusi dalam memajukan pendidikan di
            Indonesia melalui berbagai program beasiswa bagi mahasiswa aktif dan calon mahasiswa baru.</p>

          <div style="display: flex; flex-direction: column; gap: 25px; margin-bottom: 40px;">

            <div
              style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--primary-blue);">
              <h3 style="color: var(--primary-blue); font-size: 1.25rem; margin-bottom: 10px;">1. KIP Kuliah</h3>
              <p style="font-size: 0.95rem; color: #444; line-height: 1.6;">Program Indonesia Pintar (PIP) melalui KIP
                Kuliah menjamin keberlangsungan kuliah dengan memberikan pembebasan biaya pendidikan dan bantuan biaya
                hidup bulanan bagi mahasiswa berprestasi yang memenuhi persyaratan ekonomi.</p>
            </div>

            <div
              style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--accent-orange);">
              <h3 style="color: var(--accent-orange); font-size: 1.25rem; margin-bottom: 10px;">2. Corporate Social
                Responsibility (CSR)</h3>
              <p style="font-size: 0.95rem; color: #444; line-height: 1.6;">Bantuan pendidikan STIM YKPN bagi lulusan
                SMA yang memiliki keterbatasan ekonomi namun memiliki prestasi akademik yang baik.</p>
            </div>

            <div
              style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--primary-blue);">
              <h3 style="color: var(--primary-blue); font-size: 1.25rem; margin-bottom: 10px;">3. Bantuan DIKPORA</h3>
              <p style="font-size: 0.95rem; color: #444; line-height: 1.6;">Bantuan pendidikan dari Dinas Pendidikan,
                Pemuda dan Olahraga dengan tujuan membantu mahasiswa yang mengalami kesulitan biaya pendidikan di
                Pergurusn Tinggi.</p>
            </div>

            <div
              style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--accent-orange);">
              <h3 style="color: var(--accent-orange); font-size: 1.25rem; margin-bottom: 10px;">4. Beasiswa Relasi</h3>
              <p style="font-size: 0.95rem; color: #444; line-height: 1.6;">Bantuan pendidikan satu kali dari mitra
                perusahaan (seperti Bank Jogja, BTN, BRI, BNI, Mandiri, dll) bagi mahasiswa aktif dengan IPK tinggi dan
                aktif berorganisasi.</p>
            </div>

            <div
              style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--primary-blue);">
              <h3 style="color: var(--primary-blue); font-size: 1.25rem; margin-bottom: 10px;">5. Beasiswa Prestasi</h3>
              <p style="font-size: 0.95rem; color: #444; line-height: 1.6;">Diberikan kepada mahasiswa aktif yang
                berprestasi mengharumkan nama STIM YKPN di tingkat daerah, nasional, atau internasional. Berupa
                pembebasan SPP Tetap selama satu semester.</p>
            </div>

          </div>

        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>

</body>

</html>

