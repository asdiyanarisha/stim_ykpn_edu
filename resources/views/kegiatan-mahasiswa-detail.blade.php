@extends('layouts.public')

@section('seo')
  <x-seo-head
    :title="$activity->title . ' — Kegiatan Mahasiswa STIM YKPN'"
    :description="Str::limit(strip_tags($activity->description), 160)"
    :ogImage="$activity->header_image ?: url('/images/img/logo/logo-stim-new.png')"
    ogType="article"
    :canonicalUrl="url('/kegiatan-mahasiswa/' . $activity->id)"
  />
@endsection

@push('styles')
  <style>
    body {
      background-color: #f4f7f9;
    }

    .activity-detail-section {
      padding: 60px 0 100px;
    }

    .activity-detail-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }

    .activity-detail-image-box {
      width: 100%;
      max-height: 500px;
      overflow: hidden;
      background: #1e293b;
    }

    .activity-detail-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      max-height: 500px;
    }

    .activity-detail-content-box {
      padding: 50px;
    }

    .activity-meta {
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

    .location-badge {
      background: rgba(59, 130, 246, 0.1);
      color: var(--primary-blue, #3b82f6);
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 700;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .activity-detail-title {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 30px;
      line-height: 1.4;
    }

    /* Article Content Styles */
    .activity-body-content {
      font-size: 16px;
      line-height: 1.8;
      color: #334155;
      word-break: break-word;
      overflow-wrap: break-word;
    }

    .activity-body-content a {
      color: var(--blue-500);
      text-decoration: underline;
      transition: color 0.2s ease;
    }

    .activity-body-content a:hover {
      color: var(--blue-600);
      text-decoration: underline;
    }

    .activity-body-content p {
      margin-bottom: 24px;
      text-align: justify;
    }

    .activity-body-content h2, .activity-body-content h3, .activity-body-content h4 {
      color: var(--navy-900);
      font-weight: 800;
      margin-top: 40px;
      margin-bottom: 16px;
    }

    .activity-body-content h2 { font-size: 24px; }
    .activity-body-content h3 { font-size: 20px; }

    .activity-body-content ul, .activity-body-content ol {
      margin-bottom: 24px;
      padding-left: 24px;
    }

    .activity-body-content li {
      margin-bottom: 8px;
    }

    .activity-body-content img {
      max-width: 100%;
      border-radius: 12px;
      margin: 16px 0;
    }

    .back-to-list {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--orange-500);
      font-weight: 700;
      text-decoration: none;
      margin-bottom: 30px;
      transition: gap 0.2s ease;
    }

    .back-to-list:hover {
      gap: 12px;
    }

    /* Info Cards */
    .activity-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-top: 30px;
      margin-bottom: 40px;
    }

    .activity-info-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      padding: 20px;
    }

    .activity-info-card .info-label {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 800;
      color: #94a3b8;
      margin-bottom: 6px;
    }

    .activity-info-card .info-value {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
    }

    @media (max-width: 768px) {
      .activity-detail-content-box {
        padding: 30px 20px;
      }

      .activity-detail-title {
        font-size: 24px;
        margin-bottom: 20px;
      }
    }

    /* Layout styles */
    .activity-detail-layout {
      display: grid;
      grid-template-columns: 2.3fr 1fr;
      gap: 30px;
      align-items: start;
    }

    .activity-main-content {
      min-width: 0;
    }

    /* Sidebar styles */
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

    .sidebar-activity-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .sidebar-activity-item {
      display: flex;
      gap: 15px;
      text-decoration: none;
      transition: all 0.2s ease;
      align-items: center;
    }

    .sidebar-activity-item:hover .sidebar-activity-title {
      color: var(--orange-500);
    }

    .sidebar-activity-img-box {
      width: 75px;
      height: 75px;
      border-radius: 10px;
      overflow: hidden;
      flex-shrink: 0;
      background: #e2e8f0;
      border: 1px solid #f1f5f9;
    }

    .sidebar-activity-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .sidebar-activity-item:hover .sidebar-activity-img {
      transform: scale(1.08);
    }

    .sidebar-activity-content {
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex-grow: 1;
      min-width: 0;
    }

    .sidebar-activity-title {
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

    .sidebar-activity-date {
      font-size: 12px;
      color: #64748b;
      display: flex;
      align-items: center;
    }

    .no-sidebar-activity {
      font-size: 14px;
      color: #64748b;
      text-align: center;
      margin: 0;
    }

    @media (max-width: 992px) {
      .activity-detail-layout {
        grid-template-columns: 1fr;
      }

      .activity-sidebar {
        position: static;
        margin-top: 20px;
      }
    }
  </style>
@endpush

@section('content')
  <section class="activity-detail-section">
    <div class="container">
      
      <a href="/kegiatan-mahasiswa" class="back-to-list">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 19-7-7 7-7M5 12h14"/>
        </svg>
        Kembali ke Kegiatan Mahasiswa
      </a>

      <div class="activity-detail-layout">
        <!-- Main Content -->
        <div class="activity-main-content">
          <div class="activity-detail-card animate-on-scroll">
            
            @php
              $imageUrl = null;
              if (!empty($activity->header_image)) {
                $imageUrl = str_contains($activity->header_image, 'http') 
                  ? $activity->header_image 
                  : asset('storage/' . $activity->header_image);
              }
            @endphp

            @if($imageUrl)
            <div class="activity-detail-image-box">
              <img src="{{ $imageUrl }}" alt="{{ $activity->title }}" class="activity-detail-img">
            </div>
            @endif

            <div class="activity-detail-content-box">
              
              <div class="activity-meta">
                <span class="category-badge">Kegiatan Mahasiswa</span>
                
                @if($activity->location)
                <span class="location-badge">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                  </svg>
                  {{ $activity->location }}
                </span>
                @endif

                <div class="meta-item">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                  </svg>
                  @if($activity->start_date)
                    {{ $activity->start_date->format('d M Y, H:i') }}
                    @if($activity->end_date)
                      — {{ $activity->end_date->format('d M Y, H:i') }}
                    @endif
                  @else
                    {{ $activity->created_at->format('d M Y, H:i') }}
                  @endif
                </div>
              </div>

              <h1 class="activity-detail-title">
                {{ $activity->title }}
              </h1>

              <!-- Description Section -->
              <div style="padding-top: 30px; border-top: 2px dashed #e2e8f0;">
                <h3 style="font-size: 18px; font-weight: 800; color: var(--navy-900); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                  <span style="width: 4px; height: 22px; background: var(--orange-500); border-radius: 4px; display: inline-block;"></span>
                  Deskripsi Kegiatan
                </h3>
                <div class="activity-body-content">
                  {!! $activity->description !!}
                </div>
              </div>

            </div>

          </div>
        </div>

        <!-- Sidebar -->
        <aside class="activity-sidebar animate-on-scroll">
          <div class="sidebar-card">
            <h3 class="sidebar-title">Kegiatan Lainnya</h3>
            <div class="sidebar-activity-list">
              @forelse($relatedActivities as $related)
              <a href="/kegiatan-mahasiswa/{{ $related->id }}" class="sidebar-activity-item">
                <div class="sidebar-activity-img-box">
                  @php
                    $relatedImg = asset('images/lambang-stim.webp');
                    if (!empty($related->header_image)) {
                      $relatedImg = str_contains($related->header_image, 'http') 
                        ? $related->header_image 
                        : asset('storage/' . $related->header_image);
                    }
                  @endphp
                  <img src="{{ $relatedImg }}" alt="{{ $related->title }}" class="sidebar-activity-img">
                </div>
                <div class="sidebar-activity-content">
                  <h4 class="sidebar-activity-title">{{ $related->title }}</h4>
                  <span class="sidebar-activity-date">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; margin-right:4px; vertical-align:middle;">
                      <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                      <line x1="16" x2="16" y1="2" y2="6"/>
                      <line x1="8" x2="8" y1="2" y2="6"/>
                      <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    {{ $related->start_date ? $related->start_date->format('d M Y') : $related->created_at->format('d M Y') }}
                  </span>
                </div>
              </a>
              @empty
              <p class="no-sidebar-activity">Belum ada kegiatan lainnya.</p>
              @endforelse
            </div>
          </div>
        </aside>
      </div>

    </div>
  </section>
@endsection
