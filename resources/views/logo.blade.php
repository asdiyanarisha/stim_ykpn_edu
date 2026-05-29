<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logo & Lambang - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.8">

  <style>
    body { background-color: #f8fafc; }

    .logo-section {
      padding: 80px 0;
    }

    .logo-container {
      max-width: 1100px;
      margin: 0 auto 40px auto;
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.03);
      overflow: hidden;
      border: 1px solid #f1f5f9;
    }

    .logo-grid {
      display: grid;
      grid-template-columns: 1fr 1.2fr;
      align-items: center;
    }

    .logo-display {
      padding: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-img-box {
      width: 100%;
      max-width: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-img-box img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .logo-content {
      padding: 60px 60px 60px 20px;
    }

    .logo-content h2 {
      font-size: 24px;
      font-weight: 700;
      color: var(--navy-900);
      margin-bottom: 24px;
    }

    .makna-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .makna-list li {
      position: relative;
      padding-left: 28px;
      margin-bottom: 16px;
      font-size: 14px;
      color: #64748b;
      line-height: 1.6;
    }
    
    .makna-list li strong {
      color: var(--navy-900);
      font-weight: 600;
    }

    .makna-list li::before {
      content: '';
      position: absolute;
      left: 0; top: 3px;
      width: 18px; height: 18px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23f18721' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 13l4 4L19 7'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
    }

    @media (max-width: 768px) {
      .logo-grid { grid-template-columns: 1fr; }
      .logo-display { padding: 40px 20px 20px; }
      .logo-content { padding: 20px 30px 40px; }
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
              <img src="/images/img/logo/lambang-stim.webp" alt="Lambang STIM YKPN" style="width: 80%;">
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

      <!-- LOGO BARU -->
      <div class="logo-container animate-on-scroll">
        <div class="logo-grid">
          <div class="logo-display">
            <div class="logo-img-box">
              <img src="/images/img/logo/logo-stim-baru.webp" alt="Logo Baru STIM YKPN" style="width: 80%;">
            </div>
          </div>
          <div class="logo-content">
            <h2>Makna Logo</h2>
            <ul class="makna-list">
              <li><strong>3 Kelopak Bunga:</strong> Menggambarkan Tri Dharma perguruan tinggi: Penelitian, Pengajaran, Pengabdian.</li>
              <li><strong>Garis Lengkung:</strong> Simbolisasi payung pelindung sekaligus manifestasi kesegaran berinovasi ("kreativitas yang bertanggungjawab").</li>
              <li><strong>Marka "STIM":</strong> Didesain tegas menyiratkan citra unik dan modern.</li>
              <li><strong>Warna Biru:</strong> Menampilkan citra STIM yang stabil, kuat dan profesional.</li>
              <li><strong>Warna Kuning Keemasan:</strong> Menggambarkan matahari terbit, citra yang segar, penuh energi dan percaya diri.</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.8"></script>
</body>
</html>



