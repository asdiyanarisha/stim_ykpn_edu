<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengumuman - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.5">

  <style>
    body { background-color: #f8fafc; }

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
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
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
      box-shadow: 0 10px 30px rgba(0,0,0,0.04);
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

    /* Search Bar Styling */
    .search-container {
      position: relative;
      margin-bottom: 40px;
      max-width: 600px;
    }

    .search-input {
      width: 100%;
      padding: 16px 20px 16px 50px;
      font-size: 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      border: 2px solid #e2e8f0;
      border-radius: 16px;
      outline: none;
      transition: all 0.3s ease;
      background: #f8fafc;
      color: var(--navy-900);
    }

    .search-input:focus {
      border-color: var(--orange-500);
      background: #ffffff;
      box-shadow: 0 4px 20px rgba(241, 135, 33, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      pointer-events: none;
      transition: color 0.3s ease;
    }

    .search-input:focus ~ .search-icon {
      color: var(--orange-500);
    }

    .activity-card {
      transition: all 0.3s ease;
      border: 1px solid #e2e8f0;
    }

    .activity-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
      border-color: var(--orange-500);
    }

    .activity-card img {
      transition: transform 0.5s ease;
    }

    .activity-card:hover img {
      transform: scale(1.05);
    }

    @media (max-width: 992px) {
      .academic-layout { grid-template-columns: 1fr; }
      .academic-sidebar { position: relative; top: 0; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Pengumuman</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 800px; margin: 0 auto;">Informasi dan pengumuman terbaru seputar kegiatan kemahasiswaan STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Kemahasiswaan</div>
        <ul class="sidebar-menu">
          <li><a href="/kegiatan-mahasiswa.html">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm.html">UKM</a></li>
          <li><a href="/ppkpt.html">PPKPT</a></li>
          <li><a href="/pengumuman.html" class="active">Pengumuman</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Daftar Pengumuman</h2>
        </div>
        <div class="article-body">
          <div class="search-container">
            <input type="text" class="search-input" placeholder="Cari pengumuman..." data-search-target="#activityGrid" data-search-items=".activity-card">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          </div>
          <div id="activityGrid" style="display: flex; flex-direction: column; gap: 30px;">
            <div class="activity-card" style="display: grid; grid-template-columns: 200px 1fr; gap: 25px; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
              <div style="background: #eee; height: 100%; min-height: 150px;">
                 <img src="/images/img/berita/pkkmb-2025.jpg" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
              </div>
              <div style="padding: 20px;">
                <span style="font-size: 0.8rem; color: var(--orange-500); font-weight: bold; text-transform: uppercase;">PENGUMUMAN</span>
                <h3 style="margin: 10px 0; color: var(--navy-900);">Pengumuman Lolos Seleksi Panitia Mahasiswa PKKMB 2025</h3>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;">Selamat kepada mahasiswa yang terpilih menjadi bagian dari panitia Pengenalan Kehidupan Kampus bagi Mahasiswa Baru (PKKMB) STIM YKPN 2025.</p>
                <a href="#" style="color: var(--blue-500); font-weight: bold; font-size: 0.9rem;">Selengkapnya →</a>
              </div>
            </div>
          </div>
        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.5"></script>
</body>
</html>


