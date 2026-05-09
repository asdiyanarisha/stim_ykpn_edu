<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan - STIM YKPN Yogyakarta</title>
  
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

    .library-section {
      padding: 80px 0;
    }

    .library-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-bottom: 60px;
    }

    .lib-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .lib-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; width: 100%; height: 4px;
      background: linear-gradient(90deg, var(--blue-400), var(--orange-400));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .lib-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    }

    .lib-card:hover::before {
      transform: scaleX(1);
    }

    .lib-icon {
      width: 80px;
      height: 80px;
      background: #f1f5f9;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      color: var(--blue-500);
      transition: all 0.3s ease;
    }

    .lib-card:hover .lib-icon {
      background: var(--blue-500);
      color: #ffffff;
    }

    .lib-card h3 {
      font-size: 20px;
      color: var(--navy-900);
      margin-bottom: 16px;
      font-weight: 800;
    }

    .lib-card p {
      color: var(--gray-600);
      font-size: 15px;
      line-height: 1.7;
      margin-bottom: 24px;
    }

    .lib-cta {
      display: inline-block;
      font-weight: 700;
      color: var(--orange-500);
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 2px solid transparent;
      padding-bottom: 2px;
      transition: all 0.2s ease;
    }

    .lib-card:hover .lib-cta {
      border-bottom-color: var(--orange-500);
    }

    /* Library Search Banner */
    .lib-search-banner {
      background: linear-gradient(135deg, var(--blue-600), var(--navy-800));
      border-radius: 24px;
      padding: 60px 40px;
      text-align: center;
      color: #fff;
      position: relative;
      overflow: hidden;
    }

    .lib-search-banner h2 {
      font-size: 28px;
      font-weight: 800;
      margin-bottom: 16px;
      position: relative;
      z-index: 2;
    }

    .lib-search-banner p {
      color: rgba(255,255,255,0.8);
      font-size: 16px;
      margin-bottom: 30px;
      position: relative;
      z-index: 2;
    }

    .search-form {
      max-width: 600px;
      margin: 0 auto;
      display: flex;
      gap: 10px;
      position: relative;
      z-index: 2;
    }

    .search-input {
      flex: 1;
      padding: 16px 24px;
      border-radius: 99px;
      border: none;
      font-family: inherit;
      font-size: 16px;
      outline: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .search-btn {
      background: var(--orange-500);
      color: #fff;
      border: none;
      border-radius: 99px;
      padding: 0 32px;
      font-weight: 700;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s ease;
    }

    .search-btn:hover {
      background: #d9771a;
      transform: translateY(-2px);
    }

  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Perpustakaan</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Pusat literatur dan referensi ilmu manajemen terbesar untuk mendukung kegiatan belajar dan riset civitas akademika.
      </p>
    </div>
  </header>

  <section class="library-section">
    <div class="container">
      
      <div class="library-grid animate-on-scroll">
        <!-- Layanan 1 -->
        <div class="lib-card">
          <div class="lib-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          </div>
          <h3>Katalog Digital (OPAC)</h3>
          <p>Cari ribuan koleksi buku teks, referensi manajemen, dan literatur pendukung secara online sebelum datang ke perpustakaan.</p>
          <a href="#" class="lib-cta">Akses OPAC &rarr;</a>
        </div>

        <!-- Layanan 2 -->
        <div class="lib-card animate-delay-1">
          <div class="lib-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          </div>
          <h3>E-Journal & E-Book</h3>
          <p>Akses tanpa batas ke berbagai jurnal ilmiah nasional maupun internasional yang dilanggan oleh perpustakaan kampus.</p>
          <a href="#" class="lib-cta">Lihat Jurnal &rarr;</a>
        </div>

        <!-- Layanan 3 -->
        <div class="lib-card animate-delay-2">
          <div class="lib-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          </div>
          <h3>Repositori Karya Ilmiah</h3>
          <p>Kumpulan skripsi, tesis, dan hasil penelitian dosen STIM YKPN yang dapat dijadikan referensi akademik Anda.</p>
          <a href="#" class="lib-cta">Masuk Repositori &rarr;</a>
        </div>
      </div>

      <!-- Search Banner -->
      <div class="lib-search-banner animate-on-scroll">
        <h2>Cari Literatur Anda Sekarang</h2>
        <p>Gunakan kata kunci, judul, pengarang, atau ISBN untuk menemukan buku.</p>
        <form class="search-form" onsubmit="event.preventDefault(); alert('Fungsi pencarian OPAC akan dialihkan ke server perpustakaan.');">
          <input type="text" class="search-input" placeholder="Masukkan judul buku atau nama pengarang...">
          <button type="submit" class="search-btn">Cari Buku</button>
        </form>
      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
