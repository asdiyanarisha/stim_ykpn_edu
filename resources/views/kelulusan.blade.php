<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelulusan - STIM YKPN Yogyakarta</title>
  
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
      <h1 class="page-title animate-on-scroll">Kelulusan</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Persyaratan kelulusan untuk jenjang studi S1 dan DIII.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title" style="font-size: 1.1rem; line-height: 1.4; padding-bottom: 15px;">Ketentuan Ujian Tulis & Kelulusan</div>
        <ul class="sidebar-menu">
          <li><a href="/ketentuan-ujian.html">Ketentuan Ujian</a></li>
          <li><a href="/tata-tertib-ujian.html">Tata Tertib Ujian</a></li>
          <li><a href="/kelulusan.html" class="active">Kelulusan</a></li>
          <li><a href="/yudisium.html">Yudisium</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Persyaratan Kelulusan</h2>
        </div>
        <div class="article-body">
          
          <h3 style="color: var(--primary-blue); margin-bottom: 15px; font-size: 1.5rem;">Jenjang Studi S1</h3>
          <p>Mahasiswa program studi Manajemen jenjang S1 dinyatakan lulus dari STIM YKPN apabila yang bersangkutan telah memenuhi persyaratan kelulusan sebagai berikut:</p>
          
          <ul class="target-list" style="margin-bottom: 30px;">
            <li>
              <h4>SKS Kelulusan</h4>
              Telah menempuh seluruh mata kuliah (149 SKS) yang terdiri atas 143 SKS mata kuliah wajib dan 6 SKS mata kuliah pilihan.
            </li>
            <li>
              <h4>IPK Minimum</h4>
              Memiliki Indeks Prestasi Kumulatif minimal 2,00.
            </li>
            <li>
              <h4>Bebas Nilai E</h4>
              Tidak memiliki nilai E.
            </li>
            <li>
              <h4>Batas Nilai D</h4>
              Tidak memiliki nilai D lebih dari 26 SKS.
            </li>
            <li>
              <h4>Nilai Mata Kuliah Utama</h4>
              Memiliki nilai minimum C untuk 23 mata kuliah utama yang telah ditetapkan (Agama, Bahasa Indonesia, Pendidikan Kewarganegaraan, dsb.).
            </li>
          </ul>

          <h3 style="color: var(--primary-blue); margin-bottom: 15px; font-size: 1.5rem; margin-top: 40px;">Jenjang Studi D III</h3>
          <p>Mahasiswa program studi Manajemen Perusahaan jenjang D III dinyatakan lulus dari STIM YKPN apabila yang bersangkutan telah memenuhi persyaratan kelulusan sebagai berikut:</p>
          
          <ul class="target-list">
            <li>
              <h4>SKS Kelulusan</h4>
              Telah menempuh seluruh mata kuliah (112 SKS), terdiri atas 106 mata kuliah wajib dan 6 SKS mata kuliah pilihan.
            </li>
            <li>
              <h4>IPK Minimum</h4>
              Memiliki Indeks Prestasi Kumulatif minimum 2,00.
            </li>
            <li>
              <h4>Bebas Nilai E</h4>
              Tidak memiliki nilai E.
            </li>
            <li>
              <h4>Batas Nilai D</h4>
              Tidak memiliki nilai D lebih dari 20 SKS.
            </li>
            <li>
              <h4>Sertifikat Kompetensi</h4>
              Memiliki minimal 5 sertifikat dari 13 mata kuliah bersertifikat, ditambah mata kuliah spesifik berdasarkan peminatan (Keuangan & Perbankan / Komunikasi Pemasaran).
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

