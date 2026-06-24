@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="Unduh Dokumen & Formulir — STIM YKPN Yogyakarta"
    description="Unduh berbagai dokumen, formulir akademik, dan panduan mahasiswa STIM YKPN Yogyakarta."
    :canonicalUrl="url('/unduh')"
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
@endpush

@section('content')
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Unduh Dokumen</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Pusat unduhan formulir, panduan, dan dokumen akademik STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Informasi</div>
        <ul class="sidebar-menu">
          <li><a href="/brosur">Brosur</a></li>
          <li><a href="https://stimykpn.ecampuz.com/" target="_blank" rel="noopener noreferrer">Portal</a></li>
          <li><a href="/unduh" class="active">Unduh</a></li>
          <li><a href="/alumni">Alumni</a></li>
          <li><a href="/lowongan-kerja">Lowongan Kerja</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Pusat Unduhan</h2>
        </div>
        <div class="article-body">
          
      <p style="margin-bottom: 30px;">Pusat unduhan dokumen resmi STIM YKPN. Anda dapat mengunduh formulir, panduan akademik, dokumen SPMI, serta berkas kemahasiswaan lainnya di sini.</p>
      
      <div style="display: flex; flex-direction: column; gap: 15px;">
          @php
              $icons = [
                  ['bg' => '#e0f2fe', 'color' => 'var(--primary-blue)'],
                  ['bg' => 'rgba(241,135,33,0.1)', 'color' => 'var(--accent-orange)'],
                  ['bg' => '#f1f5f9', 'color' => 'var(--gray-600)'],
              ];
          @endphp

          @forelse($files as $file)
              @php
                  $style = $icons[$loop->index % count($icons)];
                  $extension = $file->file_path ? strtoupper(pathinfo(parse_url($file->file_path, PHP_URL_PATH), PATHINFO_EXTENSION)) : 'FILE';
              @endphp
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                  <div style="display: flex; align-items: center; gap: 15px;">
                      <div style="width: 48px; height: 48px; background: {{ $style['bg'] }}; border-radius: 10px; display: flex; justify-content: center; align-items: center; color: {{ $style['color'] }}; flex-shrink: 0;">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                      </div>
                      <div>
                          <h4 style="font-size: 1.1rem; color: var(--navy-900); margin: 0 0 5px 0; font-weight: 700;">{{ $file->title }}</h4>
                          @if($file->description)
                              <p style="font-size: 0.9rem; color: var(--gray-600); margin: 0 0 5px 0; line-height: 1.4;">{{ $file->description }}</p>
                          @endif
                          <div style="font-size: 0.85rem; color: var(--gray-500);">
                              {{ $extension }} • {{ $file->file_size ?: 'Size Unknown' }} • Diperbarui {{ $file->updated_at->translatedFormat('d M Y') }}
                          </div>
                      </div>
                  </div>
                  @if($file->file_path)
                      <a href="{{ $file->file_path }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; flex-shrink: 0;" download target="_blank">
                          Unduh
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                  @else
                      <span style="font-size: 0.85rem; color: var(--gray-400); flex-shrink: 0;">Tidak tersedia</span>
                  @endif
              </div>
          @empty
              <div style="text-align: center; padding: 40px; background: white; border-radius: 12px; border: 1px solid #e2e8f0; color: var(--gray-500);">
                  Belum ada dokumen yang tersedia untuk diunduh.
              </div>
          @endforelse
      </div>
 
        </div>
      </article>

    </div>
  </section>
@endsection
