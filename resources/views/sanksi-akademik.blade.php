<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sanksi Akademik - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

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
      content: '';
      position: absolute;
      left: 20px;
      top: 26px;
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23f18721' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='9 18 15 12 9 6'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
    }

    .target-list li h4 {
      font-size: 18px;
      color: var(--navy-900);
      margin-bottom: 8px;
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
      <h1 class="page-title animate-on-scroll">Sanksi Akademik</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Ketentuan dan aturan kedisiplinan yang wajib dipatuhi oleh seluruh mahasiswa.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Program Pendidikan</div>
        <ul class="sidebar-menu">
          <li><a href="/sasaran-pendidikan.html">Sasaran Pendidikan</a></li>
          <li><a href="/cara-mencapai-sasaran.html">Cara Mencapai Sasaran</a></li>
          <li><a href="/beban-studi.html">Beban Studi</a></li>
          <li><a href="/sks.html">Sistem Kredit Semester (SKS)</a></li>
          <li><a href="/jenjang-studi.html">Jenjang Studi Dan Masa Studi</a></li>
          <li><a href="/kegiatan-akademik.html">Kegiatan Akademik</a></li>
          <li><a href="/dosen-pembimbing.html">Dosen Pembimbing</a></li>
          <li><a href="/sanksi-akademik.html" class="active">Sanksi Akademik</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Sanksi dan Pelanggaran Akademik</h2>
        </div>
        <div class="article-body">
          <p>Dalam rangka menjaga standar integritas, kejujuran, dan mutu pendidikan tinggi, STIM YKPN Yogyakarta memberlakukan peraturan disiplin akademik secara tegas.</p>
          
          <ul class="target-list">
            <li>
              <h4>Pelanggaran Ringan</h4>
              Berupa keterlambatan administrasi, ketidakhadiran melebihi batas (bolos lebih dari 25%), atau ketidaktertiban di dalam kelas. Sanksi berupa teguran lisan, peringatan tertulis, hingga pembatalan nilai mata kuliah terkait.
            </li>
            <li>
              <h4>Pelanggaran Berat (Kecurangan Akademik)</h4>
              Kecurangan seperti mencontek saat ujian, perjokian, pemalsuan dokumen akademik, atau plagiarisme (terutama dalam Skripsi/Tugas Akhir). Sanksi berat meliputi pembatalan nilai, skorsing, hingga *Drop Out* (diberhentikan).
            </li>
            <li>
              <h4>Batas Waktu Studi</h4>
              Mahasiswa yang tidak mampu menyelesaikan studinya melewati batas maksimal waktu studi tanpa keterangan sah akan diberikan sanksi Putus Studi (*Drop Out*).
            </li>
            <li>
              <h4>Pencabutan Gelar</h4>
              Bila terbukti di kemudian hari bahwa lulusan memperoleh gelar sarjana/diploma dengan cara yang melanggar hukum atau plagiarisme karya akhir, kampus berhak mencabut ijazah dan gelar yang telah diberikan.
            </li>
          </ul>
        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>




