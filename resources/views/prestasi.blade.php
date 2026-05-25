<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prestasi - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    body { background-color: #f8fafc; }

    .prestasi-section {
      padding: 100px 0;
    }

    .prestasi-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .prestasi-card {
      background: #ffffff;
      padding: 40px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      border: 1px solid #e2e8f0;
      transition: transform 0.3s ease;
    }

    .prestasi-card:hover {
      transform: translateY(-5px);
      border-color: var(--orange-500);
    }

    .prestasi-icon {
      width: 70px;
      height: 70px;
      background: rgba(241, 135, 33, 0.1);
      color: var(--orange-500);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 32px;
    }

    .prestasi-card h3 {
      font-size: 18px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 12px;
      line-height: 1.4;
    }

    .prestasi-card p {
      font-size: 14px;
      color: #64748b;
    }

    .badge-tahun {
      display: inline-block;
      padding: 4px 12px;
      background: var(--navy-900);
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      border-radius: 20px;
      margin-bottom: 16px;
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Prestasi</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Daftar pencapaian gemilang mahasiswa dan institusi STIM YKPN di kancah nasional maupun internasional.
      </p>
    </div>
  </header>

  <section class="prestasi-section">
    <div class="container">
      <div class="prestasi-grid">
        
        <div class="prestasi-card animate-on-scroll">
          <div class="badge-tahun">2025</div>
          <div class="prestasi-icon">🏆</div>
          <h3>Juara 1 National Business Plan Competition</h3>
          <p>Diraih oleh tim mahasiswa STIM YKPN dalam ajang kompetisi bisnis nasional bergengsi antar perguruan tinggi.</p>
        </div>

        <div class="prestasi-card animate-on-scroll animate-delay-1">
          <div class="badge-tahun">2024</div>
          <div class="prestasi-icon">🥇</div>
          <h3>Medali Emas Lomba Inovasi Mahasiswa</h3>
          <p>Penghargaan atas inovasi di bidang digital marketing and pemberdayaan UMKM lokal.</p>
        </div>

        <div class="prestasi-card animate-on-scroll animate-delay-2">
          <div class="badge-tahun">2023</div>
          <div class="prestasi-icon">🌟</div>
          <h3>Perguruan Tinggi Swasta Unggulan LLDikti</h3>
          <p>Penghargaan institusi atas tata kelola dan penjaminan mutu pendidikan yang berstandar tinggi.</p>
        </div>

        <div class="prestasi-card animate-on-scroll">
          <div class="badge-tahun">2022</div>
          <div class="prestasi-icon">💼</div>
          <h3>Best Export Simulation Project</h3>
          <p>Diraih oleh mahasiswa konsentrasi Ekspor-Impor bekerja sama dengan BB-PPEI Kementerian Perdagangan RI.</p>
        </div>

        <div class="prestasi-card animate-on-scroll animate-delay-1">
          <div class="badge-tahun">2021</div>
          <div class="prestasi-icon">📈</div>
          <h3>Juara 2 Kompetisi Pasar Modal Nasional</h3>
          <p>Diraih oleh perwakilan mahasiswa klub investor STIM YKPN di tingkat nasional.</p>
        </div>

      </div>
    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>

