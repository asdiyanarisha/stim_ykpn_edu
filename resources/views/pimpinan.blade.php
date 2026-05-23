<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pimpinan - STIM YKPN Yogyakarta</title>
  <meta name="description" content="Profil Pimpinan STIM YKPN Yogyakarta.">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
    /* Premium Academic Styles */
    body { background-color: #f8fafc; }

    .page-header {
      background: var(--navy-900);
      padding: 100px 0 80px;
      text-align: center;
      position: relative;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-image: 
        linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
      background-size: 30px 30px;
    }

    .pimpinan-section {
      padding: 100px 0;
      background: #f8fafc;
    }

    .pimpinan-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 40px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .pimpinan-card {
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      border: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      padding: 30px;
      transition: all 0.3s ease;
    }

    .pimpinan-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
      border-color: #cbd5e1;
    }

    .pimpinan-photo {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: #e2e8f0;
      flex-shrink: 0;
      margin-right: 30px;
      border: 4px solid #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      position: relative;
    }

    .pimpinan-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Initials placeholder if no image */
    .pimpinan-photo::after {
      content: '🎓';
      font-size: 40px;
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      color: #94a3b8;
    }

    .pimpinan-info h3 {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 8px;
    }

    .pimpinan-info .jabatan {
      font-size: 14px;
      font-weight: 700;
      color: var(--orange-500);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 12px;
      display: inline-block;
      padding: 4px 12px;
      background: rgba(241, 135, 33, 0.1);
      border-radius: 20px;
    }

    /* Ketua gets special treatment */
    .pimpinan-card.ketua {
      grid-column: 1 / -1;
      max-width: 700px;
      margin: 0 auto;
      text-align: center;
      flex-direction: column;
      padding: 50px;
    }

    .pimpinan-card.ketua .pimpinan-photo {
      width: 180px;
      height: 180px;
      margin-right: 0;
      margin-bottom: 24px;
    }

    @media (max-width: 768px) {
      .pimpinan-grid { grid-template-columns: 1fr; }
      .pimpinan-card { flex-direction: column; text-align: center; padding: 30px; }
      .pimpinan-photo { margin-right: 0; margin-bottom: 20px; }
      .pimpinan-card.ketua { padding: 30px; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Pimpinan STIM YKPN</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Jajaran pimpinan yang mendedikasikan diri untuk memajukan pendidikan tinggi manajemen di Indonesia.
      </p>
    </div>
  </header>

  <section class="pimpinan-section">
    <div class="container">
      <div class="pimpinan-grid">
        
        @forelse($pimpinans as $index => $pimpinan)
          @php
              $jobTitle = $pimpinan->jobTitle ? $pimpinan->jobTitle->title : 'Pimpinan';
              $isKetua = (strpos(strtolower($jobTitle), 'ketua') !== false && strpos(strtolower($jobTitle), 'wakil') === false);
              $delayClass = ($index % 2 != 0 && !$isKetua) ? 'animate-delay-1' : '';
          @endphp
          <div class="pimpinan-card {{ $isKetua ? 'ketua' : '' }} animate-on-scroll {{ $delayClass }}">
            <div class="pimpinan-photo">
              @if($pimpinan->image_url)
                  <img src="{{ $pimpinan->image_url }}" alt="{{ $pimpinan->full_name }}" loading="lazy">
              @endif
            </div>
            <div class="pimpinan-info">
              <span class="jabatan">{{ $jobTitle }}</span>
              <h3>{{ $pimpinan->front_title ? $pimpinan->front_title . ' ' : '' }}{{ $pimpinan->full_name }}{{ $pimpinan->back_title ? ', ' . $pimpinan->back_title : '' }}</h3>
              @if($pimpinan->personal_description)
                  <p style="color: #64748b; font-size: 15px; margin-top: 10px;">{{ Str::limit(strip_tags($pimpinan->personal_description), 150) }}</p>
              @endif
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <p style="color: #64748b;">Data pimpinan belum tersedia.</p>
          </div>
        @endforelse

      </div>
    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
