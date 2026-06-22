@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="Pengumuman Resmi – STIM YKPN Yogyakarta"
    description="Pengumuman resmi akademik dan kemahasiswaan dari STIM YKPN Yogyakarta."
    :canonicalUrl="url('/pengumuman')"
  />
@endsection

@push('styles')
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

    @media (max-width: 992px) {
      .academic-layout { grid-template-columns: 1fr; }
      .academic-sidebar { position: relative; top: 0; }
    }

    /* Search Bar */
    .search-form {
      display: flex;
      gap: 10px;
      margin-bottom: 36px;
      flex-wrap: wrap;
    }

    .search-container {
      position: relative;
      flex: 1;
      min-width: 200px;
    }

    .search-input {
      width: 100%;
      padding: 14px 20px 14px 48px;
      font-size: 15px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      outline: none;
      transition: all 0.3s ease;
      background: #f8fafc;
      color: var(--navy-900);
    }

    .search-input:focus {
      border-color: var(--orange-500);
      background: #ffffff;
      box-shadow: 0 4px 20px rgba(241, 135, 33, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      pointer-events: none;
    }

    .btn-search {
      padding: 14px 24px;
      background: var(--orange-500);
      color: #fff;
      font-weight: 700;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      font-size: 15px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      transition: background 0.2s ease;
      white-space: nowrap;
    }

    .btn-search:hover {
      background: var(--orange-600, #d97706);
    }

    /* Pengumuman Cards */
    .pengumuman-list {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .pengumuman-card {
      display: grid;
      grid-template-columns: 200px 1fr;
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      background: #ffffff;
      transition: all 0.3s ease;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
      text-decoration: none;
      color: inherit;
    }

    .pengumuman-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.09);
      border-color: var(--orange-500);
    }

    .pengumuman-card-img {
      width: 200px;
      min-height: 150px;
      object-fit: cover;
      background: #f1f5f9;
      display: block;
    }

    .pengumuman-card-img-placeholder {
      width: 200px;
      min-height: 150px;
      background: linear-gradient(135deg, #1e3a5f 0%, #2d5a9e 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .pengumuman-card-body {
      padding: 22px 24px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .pengumuman-card-badge {
      font-size: 11px;
      font-weight: 800;
      color: var(--orange-500);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 8px;
    }

    .pengumuman-card-title {
      font-size: 17px;
      font-weight: 700;
      color: var(--navy-900);
      margin-bottom: 8px;
      line-height: 1.4;
    }

    .pengumuman-card-excerpt {
      font-size: 13.5px;
      color: #64748b;
      line-height: 1.6;
      margin-bottom: 14px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .pengumuman-card-meta {
      display: flex;
      align-items: center;
      gap: 14px;
      font-size: 12px;
      color: #94a3b8;
    }

    .pengumuman-card-meta span {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .pengumuman-read-more {
      color: var(--orange-500);
      font-weight: 700;
      font-size: 13px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      margin-top: auto;
    }

    @media (max-width: 600px) {
      .pengumuman-card {
        grid-template-columns: 1fr;
      }
      .pengumuman-card-img,
      .pengumuman-card-img-placeholder {
        width: 100%;
        height: 180px;
        min-height: unset;
      }
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      background: #f8fafc;
      border-radius: 16px;
      border: 2px dashed #cbd5e1;
    }

    .empty-state-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, rgba(241,135,33,0.1), rgba(241,135,33,0.2));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }

    .empty-state h3 {
      font-size: 20px;
      font-weight: 700;
      color: var(--navy-900);
      margin-bottom: 10px;
    }

    .empty-state p {
      color: #64748b;
      font-size: 15px;
      margin-bottom: 20px;
    }

    .empty-state-reset {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--orange-500);
      font-weight: 700;
      text-decoration: none;
      font-size: 14px;
      padding: 10px 20px;
      border: 2px solid var(--orange-500);
      border-radius: 10px;
      transition: all 0.2s ease;
    }

    .empty-state-reset:hover {
      background: var(--orange-500);
      color: #fff;
    }

    /* Pagination */
    .pagination-container {
      margin-top: 40px;
    }

    /* Search results info */
    .search-results-info {
      font-size: 14px;
      color: #64748b;
      margin-bottom: 20px;
      padding: 10px 16px;
      background: #f1f5f9;
      border-radius: 8px;
      border-left: 3px solid var(--orange-500);
    }
  </style>
@endpush

@section('content')
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Pengumuman</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 800px; margin: 0 auto;">Informasi dan pengumuman terbaru seputar kegiatan kemahasiswaan STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Kemahasiswaan</div>
        <ul class="sidebar-menu">
          <li><a href="/kegiatan-mahasiswa">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm">UKM</a></li>
          <li><a href="/ppkpt">PPKPT</a></li>
          <li><a href="/pengumuman" class="active">Pengumuman</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Daftar Pengumuman</h2>
        </div>
        <div class="article-body">

          {{-- Search Form --}}
          <form method="GET" action="/pengumuman" class="search-form" id="searchForm">
            <div class="search-container">
              <input
                type="text"
                name="search"
                id="searchInput"
                class="search-input"
                placeholder="Cari pengumuman..."
                value="{{ request('search') }}"
                autocomplete="off"
              >
              <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <button type="submit" class="btn-search" id="searchBtn">Cari</button>
          </form>

          {{-- Search Results Info --}}
          @if(request()->filled('search'))
            <div class="search-results-info">
              Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
              — {{ $pengumumans->total() }} pengumuman ditemukan.
              <a href="/pengumuman" style="margin-left:8px; color: var(--orange-500); font-weight:700;">Hapus filter</a>
            </div>
          @endif

          {{-- Pengumuman List --}}
          @if($pengumumans->isEmpty())
            <div class="empty-state">
              <div class="empty-state-icon">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#f18721" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                  <polyline points="14 2 14 8 20 8"/>
                  <line x1="16" y1="13" x2="8" y2="13"/>
                  <line x1="16" y1="17" x2="8" y2="17"/>
                  <polyline points="10 9 9 9 8 9"/>
                </svg>
              </div>
              @if(request()->filled('search'))
                <h3>Pengumuman Tidak Ditemukan</h3>
                <p>Tidak ada pengumuman yang cocok dengan kata kunci <strong>"{{ request('search') }}"</strong>. Coba kata kunci lain.</p>
                <a href="/pengumuman" class="empty-state-reset">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m12 19-7-7 7-7M5 12h14"/></svg>
                  Lihat Semua Pengumuman
                </a>
              @else
                <h3>Belum Ada Pengumuman</h3>
                <p>Saat ini belum ada pengumuman yang dipublikasikan. Silakan kunjungi kembali nanti.</p>
              @endif
            </div>
          @else
            <div class="pengumuman-list" id="pengumumanList">
              @foreach($pengumumans as $item)
                <a href="/pengumuman/{{ $item->id }}" class="pengumuman-card">
                  @if($item->url_image)
                    <img
                      src="{{ $item->url_image }}"
                      alt="{{ $item->title }}"
                      class="pengumuman-card-img"
                      loading="lazy"
                    >
                  @else
                    <div class="pengumuman-card-img-placeholder">
                      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                      </svg>
                    </div>
                  @endif
                  <div class="pengumuman-card-body">
                    <div class="pengumuman-card-badge">Pengumuman</div>
                    <h3 class="pengumuman-card-title">{{ $item->title }}</h3>
                    <p class="pengumuman-card-excerpt">{{ Str::limit(strip_tags($item->content), 140) }}</p>
                    <div class="pengumuman-card-meta">
                      <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        {{ $item->created_at->translatedFormat('d M Y') }}
                      </span>
                      <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ number_format($item->views_count) }} Dilihat
                      </span>
                    </div>
                    <span class="pengumuman-read-more">
                      Selengkapnya
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                  </div>
                </a>
              @endforeach
            </div>

            {{-- Pagination --}}
            @if($pengumumans->hasPages())
              <div class="pagination-container">
                {{ $pengumumans->links('vendor.pagination.bootstrap-4', ['noun' => 'pengumuman']) }}
              </div>
            @endif
          @endif

        </div>
      </article>

    </div>
  </section>
@endsection
