<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Ekstensi - STIM YKPN Yogyakarta</title>

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
      <h1 class="page-title animate-on-scroll">Program Ekstensi</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Informasi
        kelas karyawan (sore-malam) khusus untuk program S1 Manajemen.</p>
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
          <li><a href="/program-reguler.html">Program Reguler</a></li>
          <li><a href="/program-ekstensi.html" class="active">Program Ekstensi</a></li>
          <li><a href="/pengumuman-diterima.html">Pengumuman Diterima</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Pendaftaran Program Ekstensi (Kelas Karyawan)</h2>
        </div>
        <div class="article-body">

          <p style="margin-bottom: 20px; line-height: 1.6;">Program Ekstensi atau Kelas Karyawan adalah program khusus
            untuk program Sarjana (S1) Manajemen yang diselenggarakan pada sore-malam hari. Cocok untuk calon mahasiswa
            yang sedang bekerja atau memiliki kesibukan di pagi-sore hari.</p>

          <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div style="background: white; border: 1px solid #eee; border-radius: 8px; padding: 20px; text-align: center;">
              <h4 style="color: var(--accent-orange); margin-bottom: 10px;">Sistem Perkuliahan</h4>
              <p style="font-weight: bold; color: #333;">Hibrid (Daring & Luring)</p>
            </div>
            <div style="background: white; border: 1px solid #eee; border-radius: 8px; padding: 20px; text-align: center;">
              <h4 style="color: var(--accent-orange); margin-bottom: 10px;">Jadwal Perkuliahan</h4>
              <p style="font-weight: bold; color: #333;">Selasa - Jumat<br>16.00 - 21.00 WIB</p>
            </div>
          </div>

          <h3 style="margin-top: 30px; margin-bottom: 15px; color: var(--primary-blue);">Jalur Rekognisi Pembelajaran
            Lampau (RPL)</h3>
          <p style="margin-bottom: 15px; line-height: 1.6;">Bagi calon mahasiswa dengan pengalaman kerja, dapat mendaftar
            melalui jalur RPL yang terdiri dari:</p>
          <ul class="target-list" style="margin-bottom: 30px;">
            <li><strong>RPL Transfer SKS:</strong> Bagi lulusan D3 atau pindahan dari Perguruan Tinggi lain.</li>
            <li><strong>RPL Perolehan SKS:</strong> Bagi lulusan SMA/SMK yang memiliki pengalaman kerja untuk diakui
              sebagai SKS.</li>
          </ul>

          <h3 style="margin-top: 30px; margin-bottom: 15px; color: var(--primary-blue);">Biaya Khusus</h3>
          <div style="background: #eef5ff; border-radius: 8px; padding: 20px; border-left: 4px solid var(--primary-blue);">
            <p style="margin: 0; color: #333;"><strong>SPA Rp 5.000.000</strong> - Dapat dibayarkan secara bertahap selama
              dua semester.</p>
          </div>

          <a href="/pmb.html" class="btn btn-orange" style="margin-top: 30px; display: inline-block;">Daftar Sekarang</a>

        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>

</body>

</html>

