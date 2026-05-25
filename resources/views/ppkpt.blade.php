<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPKPT - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.0">

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

    .article-body p {
      margin-bottom: 20px;
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
      <h1 class="page-title animate-on-scroll">PPKPT</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 800px; margin: 0 auto;">Pencegahan dan Penanganan Kekerasan Seksual & Perundungan STIM YKPN.</p>
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
          <li><a href="/ppkpt.html" class="active">PPKPT</a></li>
          <li><a href="/pengumuman.html">Pengumuman</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Layanan Aduan PPKPT</h2>
        </div>
        <div class="article-body" style="text-align: center;">
          <p>PPKPT berkomitmen untuk menciptakan lingkungan kampus yang aman, inklusif dan bebas dari kekerasan seksual serta perundungan (bullying). Jika Anda mengalami atau mengetahui adanya tindakan tersebut di lingkungan kampus, segera laporkan melalui layanan aduan resmi PPKPT di bawah ini.</p>
          <p>Identitas dan laporan Anda akan dijamin kerahasiaannya dan ditindaklanjuti secara profesional oleh tim terkait.</p>
          <div style="margin: 40px 0;">
            <a href="https://bit.ly/Aduan_PPKPT" target="_blank" rel="noopener noreferrer" style="display: inline-block; transition: transform 0.3s ease; text-decoration: none;" class="barcode-link">
              <img src="/images/img/Barcode_PPKPT.jpeg" alt="QR Code Link Aduan PPKPT" style="width: 250px; height: auto; padding: 15px; background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; display: block; margin: 0 auto; transition: transform 0.3s ease;">
              <p style="margin-top: 20px; font-weight: bold; color: var(--navy-900); font-size: 16px;">Scan QR Code atau Klik Gambar untuk Mengisi Form Aduan</p>
            </a>
            <div style="margin-top: 25px;">
              <a href="https://bit.ly/Aduan_PPKPT" target="_blank" rel="noopener noreferrer" class="btn btn-orange btn-pulse" style="padding: 12px 30px; font-weight: 700; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(241, 135, 33, 0.3);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                Isi Formulir Aduan Online
              </a>
            </div>
          </div>
        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>




