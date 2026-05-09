<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logo & Lambang - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    body { background-color: #f8fafc; }

    .page-header {
      background: var(--navy-900);
      padding: 100px 0 80px;
      text-align: center;
      position: relative;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-image: 
        linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
      background-size: 30px 30px;
    }

    .logo-section {
      padding: 100px 0;
    }

    .logo-container {
      max-width: 1000px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.04);
      overflow: hidden;
      border: 1px solid #e2e8f0;
      margin-bottom: 60px;
    }

    .logo-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .logo-display {
      background: #f1f5f9;
      padding: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-img-box {
      width: 250px;
      height: 250px;
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #cbd5e1;
      padding: 20px;
    }

    .logo-img-box img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .logo-content {
      padding: 50px;
    }

    .logo-content h2 {
      font-size: 28px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 24px;
    }

    .makna-list {
      list-style: none;
    }

    .makna-list li {
      position: relative;
      padding-left: 30px;
      margin-bottom: 16px;
      font-size: 15px;
      color: #475569;
      line-height: 1.6;
    }

    .makna-list li::before {
      content: '✓';
      position: absolute;
      left: 0; top: 2px;
      color: var(--orange-500);
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .logo-grid { grid-template-columns: 1fr; }
      .logo-display { padding: 40px; }
      .logo-content { padding: 30px; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Logo & Lambang</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Identitas visual STIM YKPN yang mencerminkan komitmen, inovasi, dan profesionalisme.
      </p>
    </div>
  </header>

  <section class="logo-section">
    <div class="container">
      
      <!-- LAMBANG -->
      <div class="logo-container animate-on-scroll">
        <div class="logo-grid">
          <div class="logo-display">
            <div class="logo-img-box">
              <img src="/images/img/logo/LOGO STIM YPKN.png" alt="Lambang STIM YKPN">
            </div>
          </div>
          <div class="logo-content">
            <h2>Makna Lambang</h2>
            <ul class="makna-list">
              <li><strong>Lima daun teratai:</strong> Menggambarkan lima sila Pancasila.</li>
              <li><strong>Bulatan teks:</strong> Tulisan "Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta" menggambarkan kebulatan tekad.</li>
              <li><strong>Dewa Mercurius:</strong> Menggambarkan lingkup pengembangan manajemen dalam bidang perdagangan.</li>
              <li><strong>Pelita:</strong> Menggambarkan ilmu manajemen sebagai pelita kehidupan.</li>
              <li><strong>Sayap lima helai:</strong> Mencerminkan Panca Asas STIM YKPN.</li>
              <li><strong>Warna Hitam:</strong> Menunjukkan ketegasan.</li>
              <li><strong>Warna Kuning:</strong> Menunjukkan keagungan jiwa pahlawan.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- LOGO -->
      <div class="logo-container animate-on-scroll">
        <div class="logo-grid">
          <div class="logo-content" style="order: 2;">
            <h2>Makna Logo Baru</h2>
            <ul class="makna-list">
              <li><strong>3 Kelopak Bunga:</strong> Menggambarkan Tri Dharma perguruan tinggi: Penelitian, Pengajaran, Pengabdian.</li>
              <li><strong>Garis Lengkung:</strong> Simbolisasi payung pelindung sekaligus manifestasi kesegaran berinovasi ("kreativitas yang bertanggungjawab").</li>
              <li><strong>Marka "STIM":</strong> Didesain tegas menyiratkan citra unik dan modern.</li>
              <li><strong>Warna Biru:</strong> Menampilkan citra STIM yang stabil, kuat dan profesional.</li>
              <li><strong>Warna Kuning Keemasan:</strong> Menggambarkan matahari terbit, citra yang segar, penuh energi dan percaya diri.</li>
            </ul>
          </div>
          <div class="logo-display" style="order: 1; background: #fff8f1;">
            <div class="logo-img-box" style="border-color: var(--orange-500);">
              <img src="/images/img/logo/logo-stim-new.png" alt="Logo Baru STIM YKPN">
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
