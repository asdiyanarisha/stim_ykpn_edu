<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.0">

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
      <h1 class="page-title animate-on-scroll">Alumni</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Wadah komunikasi, informasi, dan jejaring karir bagi seluruh lulusan STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Informasi</div>
        <ul class="sidebar-menu">
          <li><a href="/brosur.html">Brosur</a></li>
          <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">Portal</a></li>
          <li><a href="/unduh.html">Unduh</a></li>
          <li><a href="/alumni.html" class="active">Alumni</a></li>
          <li><a href="/lowongan-kerja.html">Lowongan Kerja</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>KASTIMA (Keluarga Alumni STIM AMP YKPN)</h2>
        </div>
        <div class="article-body">
          
      <p style="margin-bottom: 30px;">Jaringan alumni STIM YKPN (KASTIMA) telah tersebar di berbagai instansi pemerintah, BUMN, dan perusahaan swasta di seluruh Indonesia. Bergabunglah bersama kami dan bangun karir gemilang Anda!</p>
      
      <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 4px solid var(--accent-orange); margin-bottom: 40px;">
          <h3 style="color: var(--accent-orange); font-size: 1.25rem; margin-bottom: 15px;">Tracer Study STIM YKPN</h3>
          <p style="font-size: 0.95rem; color: #444; line-height: 1.6; margin-bottom: 20px;">Bagi alumni yang belum mengisi tracer study, kami sangat mengharapkan partisipasi Anda. Data ini sangat penting untuk akreditasi kampus dan pengembangan kurikulum ke depan.</p>
          <a href="#" class="btn btn-outline">Isi Tracer Study</a>
      </div>

      <h3 style="font-size: 1.5rem; color: var(--navy-900); margin-bottom: 20px;">Apa Kata Alumni</h3>
      @if(isset($alumnis) && count($alumnis) > 0)
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
          @foreach($alumnis as $alumni)
          <div style="background: #f8fafc; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
              <div style="font-size: 0.95rem; color: var(--gray-600); line-height: 1.6; font-style: italic; margin-bottom: 20px; flex-grow: 1;">
                  "{!! strip_tags($alumni->testimony) !!}"
              </div>
              <div style="display: flex; align-items: center; gap: 15px;">
                  @if($alumni->image)
                  <img src="{{ str_contains($alumni->image, 'http') ? $alumni->image : asset('storage/' . $alumni->image) }}" alt="{{ $alumni->name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                  @else
                  <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--navy-900); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem;">
                      {{ substr($alumni->name, 0, 1) }}
                  </div>
                  @endif
                  <div>
                      <div style="font-weight: 700; color: var(--navy-900); font-size: 1rem;">{{ $alumni->name }}</div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      @else
      <p style="color: var(--gray-500); font-style: italic; margin-bottom: 40px;">Belum ada data testimoni alumni.</p>
      @endif

      <h3 style="font-size: 1.5rem; color: var(--navy-900); margin-bottom: 20px;">Layanan Alumni</h3>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
          <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
              <h4 style="font-weight: 700; color: var(--navy-900); margin-bottom: 10px;">Legalisir Ijazah & Transkrip</h4>
              <p style="font-size: 0.9rem; color: var(--gray-600);">Informasi dan prosedur legalisir dokumen akademik untuk alumni.</p>
          </div>
          <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
              <h4 style="font-weight: 700; color: var(--navy-900); margin-bottom: 10px;">Pembuatan Kartu Alumni</h4>
              <p style="font-size: 0.9rem; color: var(--gray-600);">Syarat dan ketentuan pembuatan kartu anggota alumni STIM YKPN.</p>
          </div>
      </div>

        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>






