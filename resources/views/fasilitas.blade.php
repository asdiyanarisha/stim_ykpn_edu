<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fasilitas - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Fasilitas Kampus STIM YKPN Yogyakarta.">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    body { background-color: #ffffff; }

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

    .fasilitas-section {
      padding: 100px 0;
    }

    .fasilitas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .fasilitas-card {
      border-radius: 20px;
      overflow: hidden;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
    }

    .fasilitas-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }

    .fasilitas-img {
      width: 100%;
      height: 240px;
      background: #cbd5e1;
      position: relative;
      overflow: hidden;
    }

    .fasilitas-img::after {
      content: '📷';
      font-size: 40px;
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      color: #94a3b8;
    }

    .fasilitas-content {
      padding: 30px;
    }

    .fasilitas-content h3 {
      font-size: 22px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 12px;
    }

    .fasilitas-content p {
      font-size: 15px;
      color: #475569;
      line-height: 1.6;
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Fasilitas Kampus</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Infrastruktur modern dan lingkungan belajar yang nyaman untuk mendukung kesuksesan akademik mahasiswa.
      </p>
    </div>
  </header>

  <section class="fasilitas-section">
    <div class="container">
      <div class="fasilitas-grid">
        
        <div class="fasilitas-card animate-on-scroll">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>Gedung Kampus Terpadu</h3>
            <p>Menempati lahan seluas 0.74 hektar yang asri di Jalan Palagan Tentara Pelajar km.7, Yogyakarta. Dilengkapi dengan pusat administrasi, lobby nyaman, serta ruang terbuka hijau.</p>
          </div>
        </div>

        <div class="fasilitas-card animate-on-scroll animate-delay-1">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>Ruang Kelas Modern</h3>
            <p>16 ruang kelas eksklusif berkapasitas 50 mahasiswa. Dilengkapi AC, perangkat multimedia (LCD Proyektor & Audio), dan kursi ergonomis untuk kenyamanan belajar optimal.</p>
          </div>
        </div>

        <div class="fasilitas-card animate-on-scroll animate-delay-2">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>Laboratorium Komputer</h3>
            <p>2 ruang lab komputer canggih dengan 50+ unit PC berkinerja tinggi, koneksi internet stabil, dan *software* khusus untuk praktik pasar modal, kewirausahaan, serta ekspor-impor.</p>
          </div>
        </div>

        <div class="fasilitas-card animate-on-scroll">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>BI Corner & Perpustakaan</h3>
            <p>Fasilitas ruang baca eksklusif persembahan Bank Indonesia yang menyediakan ratusan literatur finansial, moneter, perbankan, hingga literatur internasional berkualitas tinggi.</p>
          </div>
        </div>

        <div class="fasilitas-card animate-on-scroll animate-delay-1">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>Masjid Kampus</h3>
            <p>Fasilitas ibadah yang representatif di sisi selatan gedung. Area bersih, sejuk, dan dilengkapi sarana ibadah lengkap serta perpustakaan Islami mini untuk mahasiswa.</p>
          </div>
        </div>

        <div class="fasilitas-card animate-on-scroll animate-delay-2">
          <div class="fasilitas-img"></div>
          <div class="fasilitas-content">
            <h3>Area Diskusi Mahasiswa</h3>
            <p>Ruang-ruang diskusi semi-terbuka dengan akses WiFi gratis (*hotspot area*) untuk memfasilitasi kerja kelompok, organisasi, dan pengembangan ide-ide kreatif.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
