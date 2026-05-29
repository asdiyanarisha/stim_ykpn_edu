<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita & Kegiatan - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Berita terbaru, kegiatan, prestasi, dan informasi seputar STIM YKPN Yogyakarta.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.8">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    body { background-color: #f8fafc; }

    .news-page-section {
      padding: 60px 0 80px;
    }

    .news-toolbar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px;
      background: #ffffff;
      padding: 20px 24px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.04);
      border: 1px solid #e2e8f0;
      margin-bottom: 40px;
    }

    .news-search-input {
      flex: 1;
      min-width: 220px;
      padding: 12px 16px 12px 44px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      font-size: 15px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: var(--navy-900);
      background: #f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.3-4.3'/%3E%3C/svg%3E") 14px center no-repeat;
      transition: all 0.2s ease;
    }

    .news-search-input:focus {
      outline: none;
      border-color: var(--orange-500);
      box-shadow: 0 0 0 3px rgba(241, 135, 33, 0.1);
      background-color: #fff;
    }

    .news-search-input::placeholder {
      color: #94a3b8;
    }

    .news-filter-select {
      padding: 12px 36px 12px 16px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      font-size: 15px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 500;
      color: var(--navy-900);
      background-color: #f8fafc;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      transition: all 0.2s ease;
    }

    .news-filter-select:focus {
      outline: none;
      border-color: var(--orange-500);
      box-shadow: 0 0 0 3px rgba(241, 135, 33, 0.1);
    }

    .news-results-count {
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
      margin-left: auto;
      white-space: nowrap;
    }

    .news-page-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }

    .news-page-grid .news-card {
      animation: none;
      opacity: 1;
      transform: none;
    }

    .no-results {
      display: none;
      text-align: center;
      padding: 80px 20px;
      grid-column: 1 / -1;
    }

    .no-results-icon {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.4;
    }

    .no-results h3 {
      font-size: 22px;
      font-weight: 700;
      color: var(--navy-900);
      margin-bottom: 8px;
    }

    .no-results p {
      font-size: 15px;
      color: #64748b;
      max-width: 400px;
      margin: 0 auto;
    }

    @media (max-width: 992px) {
      .news-page-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .news-toolbar {
        flex-direction: column;
        align-items: stretch;
      }

      .news-search-input {
        min-width: 100%;
      }

      .news-results-count {
        margin-left: 0;
        text-align: center;
      }
    }

    @media (max-width: 600px) {
      .news-page-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/logo-stim-new.png">
</head>
<body>

  @include('components.navbar')

  <main>
    <!-- Page Header -->
    <header class="page-header">
      <div class="container" style="position:relative; z-index:2;">
        <h1 class="page-title animate-on-scroll">Berita &amp; Kegiatan</h1>
        <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Informasi terbaru seputar kegiatan, prestasi, dan perkembangan STIM YKPN Yogyakarta.</p>
      </div>
    </header>

    <!-- News Section -->
    <section class="news-page-section">
      <div class="container">

        <!-- Toolbar -->
        <div class="news-toolbar animate-on-scroll">
          <input type="text" class="news-search-input" id="newsSearchInput" placeholder="Cari berita..." value="{{ request('search') }}">
          <select class="news-filter-select" id="newsCategoryFilter">
            <option value="Semua" {{ request('category') === 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
            <option value="Kegiatan" {{ request('category') === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            <option value="Prestasi" {{ request('category') === 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
            <option value="Dies Natalis" {{ request('category') === 'Dies Natalis' ? 'selected' : '' }}>Dies Natalis</option>
            <option value="Akademik" {{ request('category') === 'Akademik' ? 'selected' : '' }}>Akademik</option>
            <option value="Kemahasiswaan" {{ request('category') === 'Kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
          </select>
          <select class="news-filter-select" id="newsSortFilter">
            <option value="terbaru" {{ request('sort') === 'terbaru' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
            <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Terlama</option>
          </select>
          <span class="news-results-count" id="newsResultsCount">Menampilkan {{ $newsList->count() }} berita</span>
        </div>

        <!-- News Grid -->
        <div class="news-page-grid" id="newsGrid">
          
          @forelse($newsList as $news_item)
          <article class="news-card">
            <div class="news-card-image">
              <img loading="lazy" src="{{ $news_item->url_image ?? '/images/hero-bg.png' }}" alt="{{ $news_item->title }}">
              <span class="date-badge">{{ $news_item->created_at->format('d M Y') }}</span>
            </div>
            <div class="news-card-body">
              <span class="category">Berita</span>
              <h3><a href="/berita/{{ $news_item->id }}">{{ $news_item->title }}</a></h3>
              <a href="/berita/{{ $news_item->id }}" class="read-more">
                Baca Selengkapnya
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              </a>
            </div>
          </article>
          @empty
          <div class="no-results" style="display: block;">
            <div class="no-results-icon">📄</div>
            <h3>Belum ada berita</h3>
            <p>Berita terbaru akan segera diperbarui di sini.</p>
          </div>
          @endforelse

        </div>

        @if($newsList->hasPages())
        <div style="margin-top: 40px; display: flex; justify-content: center;">
          {{ $newsList->links() }}
        </div>
        @endif

      </div>
    </section>

  </main>

  @include('components.footer')

  <script src="/js/script.js?v=3.8"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('newsSearchInput');
      const categoryFilter = document.getElementById('newsCategoryFilter');
      const sortFilter = document.getElementById('newsSortFilter');

      function updateFilters() {
        const queryParams = new URLSearchParams(window.location.search);
        
        if (searchInput.value.trim() !== '') {
          queryParams.set('search', searchInput.value.trim());
        } else {
          queryParams.delete('search');
        }

        if (categoryFilter.value !== 'Semua') {
          queryParams.set('category', categoryFilter.value);
        } else {
          queryParams.delete('category');
        }

        if (sortFilter.value !== 'terbaru') {
          queryParams.set('sort', sortFilter.value);
        } else {
          queryParams.delete('sort');
        }
        
        // Reset page parameter when filters change
        queryParams.delete('page');

        window.location.href = window.location.pathname + '?' + queryParams.toString();
      }

      // Event listener for search input (with debounce)
      let searchTimeout;
      searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(updateFilters, 800); // 800ms debounce
      });

      searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          clearTimeout(searchTimeout);
          updateFilters();
        }
      });

      // Event listeners for select boxes
      categoryFilter.addEventListener('change', updateFilters);
      sortFilter.addEventListener('change', updateFilters);
    });
  </script>
</body>
</html>



