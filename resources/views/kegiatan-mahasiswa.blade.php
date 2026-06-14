@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="Kegiatan Mahasiswa — STIM YKPN Yogyakarta"
    description="Ragam kegiatan kemahasiswaan di STIM YKPN Yogyakarta: organisasi, UKM, kepanitiaan, dan pengembangan soft skill mahasiswa."
    :canonicalUrl="url('/kegiatan-mahasiswa')"
  />
@endsection

@push('styles')
  <style>
  .activity-card-layout {
    display: grid; 
    grid-template-columns: 200px 1fr; 
    gap: 25px; 
    background: white; 
    border-radius: 12px; 
    overflow: hidden; 
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  }
  @media (max-width: 768px) {
    .activity-card-layout {
      grid-template-columns: 1fr;
    }
    .activity-card-layout img {
      height: 200px !important;
    }
  }
</style>
@endpush

@section('content')
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Kegiatan Mahasiswa</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Dokumentasi berbagai aktivitas dan acara yang diselenggarakan oleh mahasiswa STIM YKPN.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Kemahasiswaan</div>
        <ul class="sidebar-menu">
          <li><a href="/kegiatan-mahasiswa" class="active">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm">UKM</a></li>
          <li><a href="/ppkpt">PPKPT</a></li>
          <li><a href="/pengumuman">Pengumuman</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Berita & Aktivitas Mahasiswa</h2>
        </div>
        <div class="article-body">
          
    <div class="search-container">
      <input type="text" class="search-input" placeholder="Cari kegiatan..." data-search-target="#activityGrid" data-search-items=".activity-card">
      <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    </div>
  
          
      <div id="activityGrid" style="display: flex; flex-direction: column; gap: 30px;">
        @foreach($activities as $activity)
          <div class="activity-card activity-card-layout">
            <div style="background: #eee; height: 100%; min-height: 150px;">
                <img src="{{ !empty($activity->header_image) ? (str_contains($activity->header_image, 'http') ? $activity->header_image : asset('storage/' . $activity->header_image)) : asset('images/lambang-stim.webp') }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy" alt="{{ $activity->title }}">
            </div>
            <div style="padding: 20px;">
              <span style="font-size: 0.8rem; color: var(--accent-orange); font-weight: bold; text-transform: uppercase;">
                {{ $activity->start_date ? $activity->start_date->format('d M Y') : 'KEGIATAN' }}
              </span>
              <h3 style="margin: 10px 0; color: var(--primary-blue);">{{ $activity->title }}</h3>
              <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;">{{ Str::limit(strip_tags($activity->description), 150) }}</p>
              <a href="#" style="color: var(--primary-blue); font-weight: bold; font-size: 0.9rem;">Selengkapnya →</a>
            </div>
          </div>
        @endforeach
      </div>
    
        </div>
      </article>

    </div>
  </section>
@endsection
