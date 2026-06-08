<!DOCTYPE html>
<html lang="id">
<head>
  <x-seo-head
    title="Lowongan Kerja & Karir — STIM YKPN Yogyakarta"
    description="Informasi lowongan kerja terbaru untuk mahasiswa dan alumni STIM YKPN Yogyakarta dari berbagai perusahaan terpercaya."
    :canonicalUrl="url('/lowongan-kerja')"
  />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/img/logo/logo-stim-new.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.9">

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

    .job-content ul, .job-content ol {
      padding-left: 20px;
      margin-bottom: 20px;
    }
    .job-content ul {
      list-style-type: disc;
    }
    .job-content ol {
      list-style-type: decimal;
    }
    .job-content li {
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
      <h1 class="page-title animate-on-scroll">Lowongan Kerja</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Informasi peluang karir terbaru dari berbagai mitra perusahaan untuk lulusan STIM YKPN.</p>
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
          <li><a href="/alumni.html">Alumni</a></li>
          <li><a href="/lowongan-kerja.html" class="active">Lowongan Kerja</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Pusat Karir & Lowongan Kerja</h2>
        </div>
        <div class="article-body">
          
      <p style="margin-bottom: 30px;">Pusat Pengembangan Karir (Career Center) STIM YKPN secara rutin memperbarui informasi lowongan pekerjaan dari berbagai mitra strategis kami untuk lulusan STIM YKPN.</p>
      
      <div style="display: flex; flex-direction: column; gap: 20px;">
          @forelse($vacancies as $vacancy)
              <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 25px; transition: all 0.2s ease; background: #ffffff;">
                  <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                      <div>
                          <h3 style="color: var(--primary-blue); font-size: 1.25rem; font-weight: 700; margin-bottom: 5px;">{{ $vacancy->title }}</h3>
                          <div style="font-size: 0.85rem; color: var(--gray-500);">
                              🗓️ Diposting: {{ $vacancy->created_at->translatedFormat('d F Y') }}
                          </div>
                      </div>
                  </div>
                  <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin-bottom: 20px;">
                      {{ Str::limit(strip_tags($vacancy->content), 180) }}
                  </p>
                  <a href="/lowongan-kerja/{{ $vacancy->id }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.85rem; display: inline-block;">Lihat Detail</a>
              </div>
          @empty
              <div style="text-align: center; padding: 40px; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">
                  <p style="color: var(--gray-500); margin-bottom: 0;">Belum ada lowongan kerja yang tersedia saat ini.</p>
              </div>
          @endforelse
      </div>

      @if($vacancies->hasPages())
          <div class="pagination-container">
              {{ $vacancies->links('vendor.pagination.bootstrap-4', ['noun' => 'lowongan']) }}
          </div>
      @endif

        </div>
      </article>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.9"></script>
</body>
</html>






