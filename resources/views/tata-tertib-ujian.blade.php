<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tata Tertib Ujian - STIM YKPN Yogyakarta</title>
  
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
      <h1 class="page-title animate-on-scroll">Tata Tertib Ujian</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Tata tertib yang harus dipatuhi selama pelaksanaan UTS dan UAS.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title" style="font-size: 1.1rem; line-height: 1.4; padding-bottom: 15px;">Ketentuan Ujian Tulis & Kelulusan</div>
        <ul class="sidebar-menu">
          <li><a href="/ketentuan-ujian.html">Ketentuan Ujian</a></li>
          <li><a href="/tata-tertib-ujian.html" class="active">Tata Tertib Ujian</a></li>
          <li><a href="/kelulusan.html">Kelulusan</a></li>
          <li><a href="/yudisium.html">Yudisium</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Tata Tertib UTS dan UAS</h2>
        </div>
        <div class="article-body">
          
          <p>Tata tertib ujian tengah semester dan ujian akhir semester untuk mahasiswa yang mengikuti ujian adalah sebagai berikut:</p>
          
          <ol class="target-list" style="list-style-type: decimal; padding-left: 20px; display: flex; flex-direction: column; gap: 10px;">
            <li>Peserta ujian adalah mahasiswa yang mengikuti ujian mata kuliah yang diujikan.</li>
            <li>Peserta ujian wajib membawa identitas dan Kartu Ujian (mata kuliah yang diujikan harus tercantum di dalam kartu ujian). Kartu ujian dapat dicetak sendiri melalui Portal e-Campuz STIM YKPN Yogyakarta (dicetak menggunakan kertas HVS warna putih).</li>
            <li>Peserta ujian wajib berpakaian rapi (tidak boleh memakai kaos oblong), bersepatu, dan berperilaku sopan, dan dilarang merokok.</li>
            <li>Peserta ujian dilarang menggunakan alat komunikasi dengan alasan apapun.</li>
            <li>Peserta ujian wajib duduk sesuai dengan nomor tempat duduk yang telah ditetapkan oleh BAAK.</li>
            <li>Selama ujian berlangsung, tas, buku-buku, dan catatan-catatan diletakkan di depan kelas (dibawah Whiteboard).</li>
            <li>Peserta ujian yang terlambat lebih dari 30 menit tidak diperbolehkan mengikuti ujian.</li>
            <li>Peserta ujian dilarang meninggalkan ruang ujian sebelum 30 menit dengan alasan apapun.</li>
            <li>Peserta ujian dilarang membatalkan ujian apabila telah memasuki ruang ujian.</li>
            <li>Peserta ujian dilarang bekerja sama dengan peserta ujian lain atau melakukan perbuatan curang lainnya.</li>
            <li>Peserta ujian tidak diperkenankan pinjam meminjam alat tulis, kalkulator, buku/catatan, pada saat ujian dilaksanakan.</li>
            <li>Bagi mahasiswa yang tidak tercantum di daftar ujian tidak diperkenankan mengikuti ujian, kecuali mendapatkan izin dari BAAK/Prodi.</li>
          </ol>
        
        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>




