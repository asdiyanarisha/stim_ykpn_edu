@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="{{ $vacancy->title }} — STIM YKPN Yogyakarta"
    description="{{ Str::limit(strip_tags($vacancy->content), 160) }}"
    ogImage="{{ $vacancy->url_image ?: url('/images/img/logo/logo-stim-new.png') }}"
    ogType="article"
    canonicalUrl="{{ url('/lowongan-kerja/' . $vacancy->id) }}"
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
      text-align: center;
      background: #f8fafc;
      padding: 30px;
      border-bottom: 1px solid #e2e8f0;
    }

    .news-detail-img {
      max-height: 600px;
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
    .news-body-content ul {
      list-style-type: disc;
    }
    .news-body-content ol {
      list-style-type: decimal;
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
      
      .news-detail-image-box {
        padding: 15px;
      }
    }
  </style>
@endpush

@section('content')
<section class="news-detail-section">
    <div class="container">
      
      <a href="/lowongan-kerja" class="back-to-home">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 19-7-7 7-7M5 12h14"/>
        </svg>
        Kembali ke Lowongan Kerja
      </a>

      <div class="news-detail-card animate-on-scroll">
        
        @if($vacancy->url_image)
        <div class="news-detail-image-box">
          <img src="{{ $vacancy->url_image }}" alt="{{ $vacancy->title }}" class="news-detail-img">
        </div>
        @endif

        <div class="news-detail-content-box">
          
          <div class="news-meta">
            <span class="category-badge">Lowongan Kerja</span>
            <div class="meta-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                <line x1="16" x2="16" y1="2" y2="6"/>
                <line x1="8" x2="8" y1="2" y2="6"/>
                <line x1="3" x2="21" y1="10" y2="10"/>
              </svg>
              {{ $vacancy->created_at->translatedFormat('d M Y') }}
            </div>
            <div class="meta-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              {{ $vacancy->views_count }} Kali Dilihat
            </div>
          </div>

          <h1 class="news-detail-title">
            {{ $vacancy->title }}
          </h1>

          <div class="news-body-content">
            {!! $vacancy->content !!}
          </div>

        </div>

      </div>

    </div>
  </section>
@endsection
