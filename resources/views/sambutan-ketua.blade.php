<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sambutan Ketua - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Sambutan Ketua STIM YKPN Yogyakarta, Dr. Suparmono, M.Si.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Base Styles -->
  <link rel="stylesheet" href="/css/style.css?v=3.5">

  <style>
    /* ==============================================
       CLEAN & SAFE CARD LAYOUT FOR CHAIRMAN
       ============================================== */
    body {
      background-color: #f4f7f9;
    }

    .chairman-section {
      padding: 80px 0 120px;
    }

    .chairman-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
      display: grid;
      grid-template-columns: 400px 1fr;
      overflow: hidden; /* Ensures image corners stay rounded inside card */
    }

    /* Left: Image Box */
    .chairman-image-box {
      position: relative;
      background: var(--navy-900);
      display: flex;
      flex-direction: column;
    }

    .chairman-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      min-height: 500px;
    }

    .chairman-badge {
      background: var(--orange-500);
      color: #ffffff;
      padding: 24px;
      text-align: center;
    }

    .badge-number {
      font-size: 28px;
      font-weight: 800;
      display: block;
      line-height: 1;
      margin-bottom: 4px;
    }

    .badge-text {
      font-size: 14px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Right: Text Box */
    .chairman-text-box {
      padding: 60px;
      position: relative;
      background: #ffffff;
    }

    /* Decorative Quote Icon */
    .quote-icon {
      position: absolute;
      top: 40px;
      right: 40px;
      width: 60px;
      height: 60px;
      opacity: 0.05;
      pointer-events: none;
    }

    .chairman-title {
      font-size: 28px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 24px;
      line-height: 1.4;
      padding-right: 60px; /* Leave space for quote icon */
    }

    .chairman-title span {
      color: var(--orange-500);
    }

    .chairman-paragraph {
      font-size: 16px;
      line-height: 1.8;
      color: #475569;
      text-align: justify;
      margin-bottom: 20px;
    }

    .chairman-paragraph strong {
      color: var(--navy-900);
    }

    .author-box {
      margin-top: 40px;
      padding-top: 30px;
      border-top: 2px solid #f1f5f9;
    }

    .author-name {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy-900);
      margin: 0 0 4px 0;
    }

    .author-role {
      font-size: 14px;
      font-weight: 700;
      color: var(--orange-500);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0;
    }

    @media (max-width: 992px) {
      .chairman-card {
        grid-template-columns: 1fr;
      }
      .chairman-img {
        height: 400px;
        min-height: 400px;
      }
      .chairman-text-box {
        padding: 40px 24px;
      }
      .quote-icon {
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
      }
      .chairman-title {
        font-size: 22px;
        padding-right: 0;
      }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container">
      <h1 class="page-title animate-on-scroll">Sambutan Ketua</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Mari bersinergi membangun masa depan pendidikan manajemen yang unggul bersama STIM YKPN Yogyakarta.
      </p>
    </div>
  </header>

  <!-- ============================================
       CHAIRMAN CARD SECTION
       ============================================ -->
  <section class="chairman-section">
    <div class="container">
      
      <div class="chairman-card animate-on-scroll">
        
        <!-- Left Side: Photo & Banner -->
        <div class="chairman-image-box">
          <img src="/images/dosen/pimpinan_dr_suparmono_msi.jpg" alt="Ketua STIM YKPN" class="chairman-img" loading="lazy">
          <div class="chairman-badge">
            <span class="badge-number">50</span>
            <span class="badge-text">Tahun Pendidikan Tinggi</span>
          </div>
        </div>

        <!-- Right Side: Content -->
        <div class="chairman-text-box">
          <!-- Quote Icon SVG -->
          <svg class="quote-icon" viewBox="0 0 24 24" fill="currentColor">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>

          <h2 class="chairman-title">
            Berkomitmen Mencetak Lulusan Manajemen <span>Unggul & Berdaya Saing Global.</span>
          </h2>

          <div class="chairman-paragraph">
            <strong>Selamat Datang di STIM YKPN Yogyakarta!</strong>
          </div>
          
          <div class="chairman-paragraph">
            STIM YKPN telah menyelenggarakan pendidikan tinggi selama lebih dari 50 tahun. Selama itu pula kami berkomitmen untuk terus meningkatkan kualitas dari berbagai aspek antara lain proses pendidikan, kelembagaan, kemahasiswaan serta lulusan agar dapat semakin bersaing di dunia industri kelak.
          </div>

          <div class="chairman-paragraph">
            Salah satu upaya yang kami lakukan adalah dengan menjalin kerjasama baik di bidang akademik, penelitian maupun pengabdian kepada masyarakat. Harapannya, semakin banyak kerjasama yang kami lakukan, kebermanfaatan STIM YKPN sebagai kampus manajemen dan perguruan tinggi dapat dirasakan oleh banyak pihak dan dari berbagai kalangan.
          </div>

          <div class="chairman-paragraph">
            Hal ini juga sebagai bentuk dedikasi dan komitmen STIM YKPN untuk mencapai visi <strong>"Menjadi Sekolah Tinggi Ilmu Manajemen yang unggul di bidang manajemen di tingkat Nasional pada 2030"</strong>.
          </div>

          <div class="chairman-paragraph">
            Selamat menjelajahi website kami, temukan informasi sebanyak-banyaknya dan manfaatkan seluruh fitur yang tersedia agar kita dapat selalu terhubung.
          </div>

          <div class="author-box">
            <h3 class="author-name">Dr. Suparmono, M.Si.</h3>
            <p class="author-role">Ketua STIM YKPN Yogyakarta</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=3.4"></script>
</body>
</html>


