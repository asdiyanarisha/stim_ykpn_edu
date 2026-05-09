<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Reguler - STIM YKPN Yogyakarta</title>

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

    .page-header {
      background: var(--navy-900);
      padding: 100px 0 80px;
      text-align: center;
      position: relative;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image:
        linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
      background-size: 30px 30px;
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
      <h1 class="page-title animate-on-scroll">Program Reguler</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Informasi
        jalur penerimaan untuk kelas reguler (pagi-sore) program S1 dan D3.</p>
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
          <li><a href="/beasiswa.html">Beasiswa</a></li>
          <li><a href="/program-reguler.html" class="active">Program Reguler</a></li>
          <li><a href="/program-ekstensi.html">Program Ekstensi</a></li>
          <li><a href="/pengumuman-diterima.html">Pengumuman Diterima</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Pendaftaran Program Reguler</h2>
        </div>
        <div class="article-body">

          <p style="margin-bottom: 20px;">Program reguler diperuntukkan bagi lulusan SMA/MA/SMK yang ingin melanjutkan
            studi dengan jadwal perkuliahan pagi-sore.</p>

          <h3 style="margin-top: 30px; margin-bottom: 15px; color: var(--primary-blue);">Program Studi Tersedia:</h3>
          <ul class="target-list" style="margin-bottom: 30px;">
            <li>Sarjana (S1) Bisnis Digital</li>
            <li>Diploma Tiga (D3) Manajemen</li>
            <li>Sarjana (S1) Manajemen</li>
          </ul>

          <h3 style="margin-top: 30px; margin-bottom: 15px; color: var(--primary-blue);">Jalur Pendaftaran:</h3>

          <div style="background: #f8f9fa; border-radius: 12px; padding: 25px; margin-bottom: 20px;">
            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 10px;">1. Jalur Reguler</h4>
            <ul style="padding-left: 20px; color: #555; margin-bottom: 0;">
              <li style="margin-bottom: 5px;">Mengisi data lengkap di portal PMB online.</li>
              <li style="margin-bottom: 5px;">Fotocopy Raport semester 1-4 atau 6 dengan nilai rata-rata minimal 80,00;
                atau rekomendasi dari BK.</li>
            </ul>
          </div>

          <div style="background: #f8f9fa; border-radius: 12px; padding: 25px; margin-bottom: 20px;">
            <h4 style="font-size: 1.1rem; color: #333; margin-bottom: 10px;">2. Jalur Prestasi</h4>
            <ul style="padding-left: 20px; color: #555; margin-bottom: 0;">
              <li style="margin-bottom: 5px;">Memiliki piagam penghargaan akademik/non-akademik minimal tingkat
                Kabupaten.</li>
              <li style="margin-bottom: 5px;">Atau memiliki surat rekomendasi dari Guru BK.</li>
            </ul>
          </div>

          <a href="/pmb.html" class="btn btn-orange" style="margin-top: 20px; display: inline-block;">Daftar Sekarang</a>

        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>

</body>

</html>
