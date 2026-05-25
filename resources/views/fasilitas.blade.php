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
  <link rel="stylesheet" href="/css/style.css?v=3.0">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css">

  <style>
    body { background-color: #ffffff; }

    .fasilitas-section {
      padding: 100px 0;
      background-color: var(--slate-50, #f8fafc);
    }

    .fasilitas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .fasilitas-card {
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
      transition: all 0.4s ease;
      display: flex;
      flex-direction: column;
    }

    .fasilitas-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .fasilitas-img-wrapper {
      position: relative;
      width: 100%;
      height: 240px;
      overflow: hidden;
      background: #e2e8f0;
    }

    .fasilitas-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
    }

    .fasilitas-card:hover .fasilitas-img-wrapper img {
      transform: scale(1.08);
    }

    /* Gradient overlay to make badges pop */
    .fasilitas-img-wrapper::after {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(10,22,40,0.6) 100%);
      pointer-events: none;
    }

    .badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: var(--orange-500, #f97316);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
      z-index: 2;
      box-shadow: 0 2px 8px rgba(249,115,22,0.3);
    }

    .badge-secondary {
      background: var(--blue-600, #003670);
      box-shadow: 0 2px 8px rgba(0,54,112,0.3);
    }

    .fasilitas-content {
      padding: 30px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .fasilitas-title-wrapper {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 15px;
    }

    .fasilitas-icon {
      width: 42px;
      height: 42px;
      background: #eff6ff; /* blue-50 */
      color: var(--blue-600, #003670);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .fasilitas-content h3 {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy-900, #0a1628);
      margin: 0;
      line-height: 1.3;
    }

    .fasilitas-content p {
      font-size: 15px;
      color: #475569;
      line-height: 1.6;
      margin: 0;
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
        
        <!-- Gedung Kampus Terpadu -->
        <div class="fasilitas-card animate-on-scroll">
          <div class="fasilitas-img-wrapper">
            <span class="badge">Eksklusif</span>
            <img src="/images/fasilitas/gedung.png" alt="Gedung Kampus" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-building"></i></div>
              <h3>Gedung Kampus Terpadu</h3>
            </div>
            <p>Menempati lahan seluas 0.74 hektar yang asri di Jalan Palagan Tentara Pelajar km.7. Dilengkapi pusat administrasi modern, lobby yang nyaman, serta ruang terbuka hijau.</p>
          </div>
        </div>

        <!-- Ruang Kelas Modern -->
        <div class="fasilitas-card animate-on-scroll animate-delay-1">
          <div class="fasilitas-img-wrapper">
            <span class="badge">Full AC & Multimedia</span>
            <img src="/images/fasilitas/kelas.png" alt="Ruang Kelas Modern" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-chalkboard-user"></i></div>
              <h3>Ruang Kelas Modern</h3>
            </div>
            <p>16 ruang kelas berkapasitas 50 mahasiswa. Dilengkapi pendingin udara, proyektor, audio sistem, dan kursi ergonomis untuk memastikan kenyamanan belajar optimal.</p>
          </div>
        </div>

        <!-- Laboratorium Komputer -->
        <div class="fasilitas-card animate-on-scroll animate-delay-2">
          <div class="fasilitas-img-wrapper">
            <span class="badge badge-secondary">High-End PC</span>
            <img src="/images/fasilitas/lab.png" alt="Laboratorium Komputer" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-computer"></i></div>
              <h3>Laboratorium Komputer</h3>
            </div>
            <p>2 ruang lab komputer canggih dengan 50+ unit PC berkinerja tinggi, internet stabil, dan *software* khusus untuk praktik pasar modal serta kewirausahaan.</p>
          </div>
        </div>

        <!-- BI Corner & Perpustakaan -->
        <div class="fasilitas-card animate-on-scroll">
          <div class="fasilitas-img-wrapper">
            <span class="badge badge-secondary">Akses Gratis</span>
            <img src="/images/fasilitas/perpus.png" alt="BI Corner & Perpustakaan" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-books"></i></div>
              <h3>BI Corner & Perpustakaan</h3>
            </div>
            <p>Ruang baca eksklusif persembahan Bank Indonesia yang menyediakan ratusan literatur finansial, moneter, perbankan, hingga jurnal-jurnal internasional berkualitas tinggi.</p>
          </div>
        </div>

        <!-- Masjid Kampus -->
        <div class="fasilitas-card animate-on-scroll animate-delay-1">
          <div class="fasilitas-img-wrapper">
            <span class="badge">Nyaman & Sejuk</span>
            <img src="/images/fasilitas/masjid.png" alt="Masjid Kampus" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-star-and-crescent"></i></div>
              <h3>Masjid Kampus</h3>
            </div>
            <p>Fasilitas ibadah yang representatif di sisi selatan gedung. Area bersih, sejuk, dan dilengkapi sarana ibadah lengkap serta perpustakaan mini Islami.</p>
          </div>
        </div>

        <!-- Area Diskusi Mahasiswa -->
        <div class="fasilitas-card animate-on-scroll animate-delay-2">
          <div class="fasilitas-img-wrapper">
            <span class="badge badge-secondary">24/7 Wi-Fi</span>
            <img src="/images/fasilitas/diskusi.png" alt="Area Diskusi Mahasiswa" loading="lazy">
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              <div class="fasilitas-icon"><i class="fi fi-rr-users-alt"></i></div>
              <h3>Area Diskusi Mahasiswa</h3>
            </div>
            <p>Ruang-ruang diskusi semi-terbuka dengan akses *high-speed Wi-Fi* untuk memfasilitasi kerja kelompok, organisasi kemahasiswaan, dan pertukaran ide kreatif.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>




