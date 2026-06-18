@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="Fasilitas Kampus STIM YKPN Yogyakarta"
    description="Fasilitas lengkap kampus STIM YKPN Yogyakarta: laboratorium komputer, perpustakaan, aula, wifi kampus, dan berbagai sarana penunjang akademik."
    :canonicalUrl="url('/fasilitas')"
  />
@endsection

@push('styles')
  <style>
    body { background-color: #ffffff; }

    .fasilitas-section {
      padding: 100px 0;
      background-color: var(--slate-50, #f8fafc);
    }

    .fasilitas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .fasilitas-card {
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
      transition: all 0.4s ease;
      display: flex;
      flex-direction: column;
    }

    .fasilitas-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .fasilitas-img-wrapper {
      position: relative;
      width: 100%;
      height: 240px;
      overflow: hidden;
      background: #e2e8f0;
    }

    .fasilitas-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
    }

    .fasilitas-card:hover .fasilitas-img-wrapper img {
      transform: scale(1.08);
    }

    /* Gradient overlay to make badges pop */
    .fasilitas-img-wrapper::after {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(10,22,40,0.6) 100%);
      pointer-events: none;
    }

    .badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: var(--orange-500, #f97316);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
      z-index: 2;
      box-shadow: 0 2px 8px rgba(249,115,22,0.3);
    }

    .badge-secondary {
      background: var(--blue-600, #003670);
      box-shadow: 0 2px 8px rgba(0,54,112,0.3);
    }

    .fasilitas-content {
      padding: 30px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .fasilitas-title-wrapper {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 15px;
    }

    .fasilitas-icon {
      width: 42px;
      height: 42px;
      background: #eff6ff; /* blue-50 */
      color: var(--blue-600, #003670);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .fasilitas-content h3 {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy-900, #0a1628);
      margin: 0;
      line-height: 1.3;
    }

    .fasilitas-content p {
      font-size: 15px;
      color: #475569;
      line-height: 1.6;
      margin: 0;
    }
  </style>
@endpush

@section('content')
<header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Fasilitas Kampus</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Infrastruktur modern dan lingkungan belajar yang nyaman untuk mendukung kesuksesan akademik mahasiswa.
      </p>
    </div>
  </header>

  <section class="fasilitas-section">
    <div class="container">
      <div class="fasilitas-grid">
        
        @foreach($facilities as $index => $facility)
        <div class="fasilitas-card animate-on-scroll {{ $index > 0 ? 'animate-delay-' . ($index % 3) : '' }}">
          <div class="fasilitas-img-wrapper">
            @if($facility->top_facility)
            <span class="badge {{ $index % 2 == 0 ? '' : 'badge-secondary' }}">{{ $facility->top_facility }}</span>
            @endif
            @if($facility->header_image)
            <img src="{{ $facility->header_image }}" alt="{{ $facility->title }}" loading="lazy">
            @endif
          </div>
          <div class="fasilitas-content">
            <div class="fasilitas-title-wrapper">
              @if($facility->icon)
              <div class="fasilitas-icon"><i class="{{ $facility->icon }}"></i></div>
              @else
              <div class="fasilitas-icon"><i class="fi fi-rr-building"></i></div>
              @endif
              <h3>{{ $facility->title }}</h3>
            </div>
            <p>{!! $facility->content !!}</p>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
@endsection
