<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Dosen — STIM YKPN Yogyakarta</title>
  <meta name="description" content="Kenali para pakar dan akademisi kami yang berdedikasi di STIM YKPN Yogyakarta.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css?v=2.3">
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container">
      <h1 class="page-title animate-on-scroll">Profil Dosen</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1">
        Kenali para pakar dan akademisi STIM YKPN yang berdedikasi tinggi dalam membentuk pemimpin bisnis masa depan.
      </p>
    </div>
  </header>

  <!-- ============================================
       FACULTY SECTION
       ============================================ -->
  <section class="faculty-section">
    <div class="container">
      <!-- Filter -->
      <div class="faculty-filter animate-on-scroll animate-delay-2">
        <a href="/dosen?category=all" class="filter-btn {{ request('category', 'all') == 'all' ? 'active' : '' }}">Semua</a>
        @foreach($categories as $cat)
          <a href="/dosen?category={{ $cat->slug }}" class="filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}">{{ $cat->title }}</a>
        @endforeach
      </div>

      <!-- Grid -->
      <div class="faculty-grid">
        @forelse($teachers as $teacher)
        <div class="faculty-card animate-on-scroll">
          <div class="faculty-img-wrap">
            <img src="{{ $teacher->image_url ?: '/images/default-user.png' }}" alt="{{ $teacher->full_name }}" onerror="this.onerror=null;this.src='/images/default-user.png';">
            <div class="faculty-overlay">
              <a href="#" class="btn-white-outline" style="text-align: center;">Lihat Profil Lengkap</a>
            </div>
          </div>
          <div class="faculty-info">
            <h3 class="faculty-name">{{ ($teacher->front_title ? $teacher->front_title . ' ' : '') . $teacher->full_name . ($teacher->back_title ? ', ' . $teacher->back_title : '') }}</h3>
            <p class="faculty-role">{{ $teacher->category->title ?? '' }}</p>
            <span class="faculty-expertise">{{ str($teacher->personal_description)->limit(100) }}</span>
          </div>
        </div>
        @empty
        <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 50px;">
          <p>Belum ada data dosen untuk kategori ini.</p>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="pagination-container animate-on-scroll">
        {{ $teachers->appends(request()->query())->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
