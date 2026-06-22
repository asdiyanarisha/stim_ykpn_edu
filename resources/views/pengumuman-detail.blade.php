@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="{{ $pengumuman->title }} — STIM YKPN Yogyakarta"
    description="{{ Str::limit(strip_tags($pengumuman->content), 160) }}"
    ogImage="{{ $pengumuman->url_image ?: url('/images/img/logo/logo-stim-new.png') }}"
    ogType="article"
    :canonicalUrl="url('/pengumuman/' . $pengumuman->id)"
  />
@endsection

@push('styles')
  <style>
    body {
      background-color: #f4f7f9;
    }

    .pengumuman-detail-section {
      padding: 60px 0 100px;
    }

    .pengumuman-detail-grid {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 36px;
      align-items: start;
    }

    /* ---- Main Card ---- */
    .news-detail-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }

    .news-detail-image-box {
      width: 100%;
      text-align: center;
      background: #f8fafc;
      padding: 30px;
      border-bottom: 1px solid #e2e8f0;
    }

    .news-detail-img {
      max-height: 520px;
      width: auto;
      max-width: 100%;
      object-fit: contain;
      margin: 0 auto;
      display: block;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .news-detail-content-box {
      padding: 50px;
    }

    .news-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px;
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
      padding: 4px 14px;
      border-radius: 20px;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    .news-detail-title {
      font-size: 30px;
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
    .news-body-content ul { list-style-type: disc; }
    .news-body-content ol { list-style-type: decimal; }
    .news-body-content li { margin-bottom: 8px; }

    /* Back Link */
    .back-to-list {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--orange-500);
      font-weight: 700;
      text-decoration: none;
      margin-bottom: 30px;
      transition: gap 0.2s ease;
      font-size: 15px;
    }

    .back-to-list:hover {
      gap: 14px;
    }

    /* ---- Sidebar ---- */
    .sidebar-panel {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .sidebar-widget {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
      overflow: hidden;
    }

    .sidebar-widget-header {
      padding: 18px 24px;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sidebar-widget-header h3 {
      font-size: 15px;
      font-weight: 800;
      color: var(--navy-900);
      margin: 0;
    }

    .sidebar-widget-header .widget-icon {
      width: 32px;
      height: 32px;
      background: rgba(241, 135, 33, 0.1);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .related-list {
      list-style: none;
    }

    .related-list li {
      border-bottom: 1px solid #f1f5f9;
    }

    .related-list li:last-child {
      border-bottom: none;
    }

    .related-item {
      display: flex;
      gap: 14px;
      padding: 14px 20px;
      text-decoration: none;
      transition: background 0.2s ease;
      align-items: flex-start;
    }

    .related-item:hover {
      background: #fafbfc;
    }

    .related-item-thumb {
      width: 64px;
      height: 64px;
      border-radius: 10px;
      object-fit: cover;
      flex-shrink: 0;
      background: linear-gradient(135deg, #1e3a5f, #2d5a9e);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .related-item-thumb img {
      width: 64px;
      height: 64px;
      border-radius: 10px;
      object-fit: cover;
    }

    .related-item-info {
      flex: 1;
      min-width: 0;
    }

    .related-item-title {
      font-size: 13.5px;
      font-weight: 700;
      color: var(--navy-900);
      line-height: 1.4;
      margin-bottom: 5px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .related-item-date {
      font-size: 12px;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 4px;
    }


    /* Responsive */
    @media (max-width: 1024px) {
      .pengumuman-detail-grid {
        grid-template-columns: 1fr;
      }

      .sidebar-panel {
        order: -1;
      }
    }

    @media (max-width: 768px) {
      .news-detail-content-box {
        padding: 30px 20px;
      }

      .news-detail-title {
        font-size: 22px;
      }

      .news-detail-image-box {
        padding: 15px;
      }
    }
  </style>
@endpush

@section('content')
<section class="pengumuman-detail-section">
    <div class="container">

      <a href="/pengumuman" class="back-to-list">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 19-7-7 7-7M5 12h14"/>
        </svg>
        Kembali ke Pengumuman
      </a>

      <div class="pengumuman-detail-grid">

        {{-- ===== Main Article ===== --}}
        <div>
          <div class="news-detail-card animate-on-scroll">

            @if($pengumuman->url_image)
            <div class="news-detail-image-box">
              <img
                src="{{ $pengumuman->url_image }}"
                alt="{{ $pengumuman->title }}"
                class="news-detail-img"
              >
            </div>
            @endif

            <div class="news-detail-content-box">

              <div class="news-meta">
                <span class="category-badge">Pengumuman</span>
                <div class="meta-item">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                  </svg>
                  {{ $pengumuman->created_at->translatedFormat('d F Y') }}
                </div>
                <div class="meta-item">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  {{ number_format($pengumuman->views_count) }} Dilihat
                </div>
              </div>

              <h1 class="news-detail-title">
                {{ $pengumuman->title }}
              </h1>

              <div class="news-body-content">
                {!! $pengumuman->content !!}
              </div>


            </div>

          </div>
        </div>

        {{-- ===== Sidebar: Pengumuman Lainnya ===== --}}
        <aside class="sidebar-panel animate-on-scroll animate-delay-1">

          <div class="sidebar-widget">
            <div class="sidebar-widget-header">
              <div class="widget-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--orange-500)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                  <polyline points="14 2 14 8 20 8"/>
                  <line x1="16" y1="13" x2="8" y2="13"/>
                  <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
              </div>
              <h3>Pengumuman Lainnya</h3>
            </div>

            @if($relatedPengumumans->isNotEmpty())
              <ul class="related-list">
                @foreach($relatedPengumumans as $related)
                <li>
                  <a href="/pengumuman/{{ $related->id }}" class="related-item">
                    <div class="related-item-thumb">
                      @if($related->url_image)
                        <img src="{{ $related->url_image }}" alt="{{ $related->title }}" loading="lazy">
                      @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                          <polyline points="14 2 14 8 20 8"/>
                        </svg>
                      @endif
                    </div>
                    <div class="related-item-info">
                      <div class="related-item-title">{{ $related->title }}</div>
                      <div class="related-item-date">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        {{ $related->created_at->translatedFormat('d M Y') }}
                      </div>
                    </div>
                  </a>
                </li>
                @endforeach
              </ul>
              <div style="padding: 14px 20px; border-top: 1px solid #f1f5f9;">
                <a href="/pengumuman" style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:var(--orange-500); text-decoration:none;">
                  Lihat Semua Pengumuman
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
              </div>
            @else
              <div style="padding: 32px 20px; text-align:center;">
                <div style="width:52px;height:52px;background:rgba(241,135,33,0.08);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f18721" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                  </svg>
                </div>
                <p style="font-size:13.5px;color:#64748b;margin:0 0 12px;">Belum ada pengumuman lainnya saat ini.</p>
                <a href="/pengumuman" style="display:inline-flex;align-items:center;gap:5px;font-size:13px;font-weight:700;color:var(--orange-500);text-decoration:none;padding:8px 16px;border:1.5px solid var(--orange-500);border-radius:8px;transition:all 0.2s;">
                  Kembali ke Daftar
                </a>
              </div>
            @endif
          </div>

        </aside>

      </div>
    </div>
  </section>
@endsection
