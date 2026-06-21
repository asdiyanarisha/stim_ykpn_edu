@extends('layouts.public')

@section('seo')
  <x-seo-head
    :title="$news->title"
    :description="Str::limit(strip_tags($news->content), 160)"
    :ogImage="$news->url_image ?: url('/images/img/logo/logo-stim-new.png')"
    ogType="article"
    :canonicalUrl="url('/berita/' . $news->id)"
    :schemaJson="$articleSchema"
  />
@endsection

@push('styles')
  <style>
    body {
      background-color: #f4f7f9;
    }

    .news-detail-section {
      padding: 60px 0 100px;
    }

    .news-detail-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }

    .news-detail-image-box {
      width: 100%;
      max-height: 500px;
      overflow: hidden;
      background: #1e293b;
    }

    .news-detail-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      max-height: 500px;
    }

    .news-detail-content-box {
      padding: 50px;
    }

    .news-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 20px;
      margin-bottom: 24px;
      font-size: 14px;
      color: #64748b;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .category-badge {
      background: rgba(241, 135, 33, 0.1);
      color: var(--orange-500);
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    .news-detail-title {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 30px;
      line-height: 1.4;
    }

    /* Article Content Styles */
    .news-body-content {
      font-size: 16px;
      line-height: 1.8;
      color: #334155;
    }

    .news-body-content p {
      margin-bottom: 24px;
      text-align: justify;
    }

    .news-body-content h2, .news-body-content h3, .news-body-content h4 {
      color: var(--navy-900);
      font-weight: 800;
      margin-top: 40px;
      margin-bottom: 16px;
    }

    .news-body-content h2 { font-size: 24px; }
    .news-body-content h3 { font-size: 20px; }

    .news-body-content ul, .news-body-content ol {
      margin-bottom: 24px;
      padding-left: 24px;
    }

    .news-body-content li {
      margin-bottom: 8px;
    }

    .back-to-home {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--orange-500);
      font-weight: 700;
      text-decoration: none;
      margin-bottom: 30px;
      transition: gap 0.2s ease;
    }

    .back-to-home:hover {
      gap: 12px;
    }

    @media (max-width: 768px) {
      .news-detail-content-box {
        padding: 30px 20px;
      }

      .news-detail-title {
        font-size: 24px;
        margin-bottom: 20px;
      }
    }

    /* Layout styles */
    .news-detail-layout {
      display: grid;
      grid-template-columns: 2.3fr 1fr;
      gap: 30px;
      align-items: start;
    }

    .news-main-content {
      min-width: 0;
    }

    /* Sidebar styles */
    .news-sidebar {
    }

    .sidebar-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
      border: 1px solid #e2e8f0;
      padding: 30px;
      margin-bottom: 30px;
    }

    .sidebar-title {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 24px;
      padding-bottom: 12px;
      border-bottom: 2px solid var(--orange-500);
      position: relative;
    }

    .sidebar-news-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .sidebar-news-item {
      display: flex;
      gap: 15px;
      text-decoration: none;
      transition: all 0.2s ease;
      align-items: center;
    }

    .sidebar-news-item:hover .sidebar-news-title {
      color: var(--orange-500);
    }

    .sidebar-news-img-box {
      width: 75px;
      height: 75px;
      border-radius: 10px;
      overflow: hidden;
      flex-shrink: 0;
      background: #e2e8f0;
      border: 1px solid #f1f5f9;
    }

    .sidebar-news-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .sidebar-news-item:hover .sidebar-news-img {
      transform: scale(1.08);
    }

    .sidebar-news-content {
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex-grow: 1;
      min-width: 0;
    }

    .sidebar-news-title {
      font-size: 14px;
      font-weight: 700;
      color: var(--navy-900);
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      margin: 0;
      transition: color 0.2s ease;
    }

    .sidebar-news-date {
      font-size: 12px;
      color: #64748b;
      display: flex;
      align-items: center;
    }

    .no-sidebar-news {
      font-size: 14px;
      color: #64748b;
      text-align: center;
      margin: 0;
    }

    @media (max-width: 992px) {
      .news-detail-layout {
        grid-template-columns: 1fr;
      }

      .news-sidebar {
        position: static;
        margin-top: 20px;
      }
    }
  </style>
@endpush

@section('content')
<!-- ============================================
       NEWS DETAIL SECTION
       ============================================ -->
  <section class="news-detail-section">
    <div class="container">
      
      <a href="/#berita" class="back-to-home">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 19-7-7 7-7M5 12h14"/>
        </svg>
        Kembali ke Beranda
      </a>

      <div class="news-detail-layout">
        <!-- Main Content -->
        <div class="news-main-content">
          <div class="news-detail-card animate-on-scroll">
            
            @if($news->url_image)
            <div class="news-detail-image-box">
              <img src="{{ $news->url_image }}" alt="{{ $news->title }}" class="news-detail-img">
            </div>
            @endif

            <div class="news-detail-content-box">
              
              <div class="news-meta">
                <span class="category-badge">Berita</span>
                <div class="meta-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                  </svg>
                  {{ $news->created_at->format('d M Y') }}
                </div>
                <div class="meta-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  {{ $news->views_count }} Kali Dilihat
                </div>
              </div>

              <h1 class="news-detail-title">
                {{ $news->title }}
              </h1>

              <div class="news-body-content">
                {!! $news->content !!}
              </div>

            </div>

          </div>
        </div>

        <!-- Sidebar -->
        <aside class="news-sidebar animate-on-scroll">
          <!-- Card 1: Berita Terbaru -->
          <div class="sidebar-card">
            <h3 class="sidebar-title">Berita Terbaru</h3>
            <div class="sidebar-news-list">
              @forelse($latestNews as $latest_item)
              <a href="/berita/{{ $latest_item->id }}" class="sidebar-news-item">
                <div class="sidebar-news-img-box">
                  <img src="{{ $latest_item->url_image ?? '/images/hero-bg.webp' }}" alt="{{ $latest_item->title }}" class="sidebar-news-img">
                </div>
                <div class="sidebar-news-content">
                  <h4 class="sidebar-news-title">{{ $latest_item->title }}</h4>
                  <span class="sidebar-news-date">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; margin-right:4px; vertical-align:middle;">
                      <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                      <line x1="16" x2="16" y1="2" y2="6"/>
                      <line x1="8" x2="8" y1="2" y2="6"/>
                      <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    {{ $latest_item->created_at->format('d M Y') }}
                  </span>
                </div>
              </a>
              @empty
              <p class="no-sidebar-news">Belum ada berita lainnya.</p>
              @endforelse
            </div>
          </div>

          <!-- Card 2: Berita Terpopuler -->
          <div class="sidebar-card">
            <h3 class="sidebar-title">Berita Terpopuler</h3>
            <div class="sidebar-news-list">
              @forelse($popularNews as $pop_item)
              <a href="/berita/{{ $pop_item->id }}" class="sidebar-news-item">
                <div class="sidebar-news-img-box">
                  <img src="{{ $pop_item->url_image ?? '/images/hero-bg.webp' }}" alt="{{ $pop_item->title }}" class="sidebar-news-img">
                </div>
                <div class="sidebar-news-content">
                  <h4 class="sidebar-news-title">{{ $pop_item->title }}</h4>
                  <span class="sidebar-news-date" style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <span style="display: flex; align-items: center;">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; margin-right:4px; vertical-align:middle;">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                      </svg>
                      {{ $pop_item->created_at->format('d M Y') }}
                    </span>
                    <span style="display: flex; align-items: center; color: var(--orange-500); font-weight: 600;">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; margin-right:4px; vertical-align:middle;">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      {{ $pop_item->views_count }} Views
                    </span>
                  </span>
                </div>
              </a>
              @empty
              <p class="no-sidebar-news">Belum ada berita terpopuler.</p>
              @endforelse
            </div>
          </div>
        </aside>
      </div>

    </div>
  </section>
@endsection
