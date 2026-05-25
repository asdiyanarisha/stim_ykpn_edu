<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalender Akademik - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.0">

  <style>
    body { background-color: #f8fafc; }

    .calendar-section {
      padding: 80px 0;
    }

    .calendar-container {
      background: #ffffff;
      border-radius: 20px;
      padding: 50px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.04);
      border: 1px solid #e2e8f0;
      max-width: 1000px;
      margin: 0 auto;
    }

    .calendar-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      flex-wrap: wrap;
      gap: 20px;
    }

    .calendar-tabs {
      display: flex;
      gap: 10px;
    }

    .tab-btn {
      padding: 10px 24px;
      border-radius: 99px;
      background: #f1f5f9;
      color: var(--gray-600);
      border: 1px solid transparent;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .tab-btn.active {
      background: var(--blue-500);
      color: #fff;
      box-shadow: 0 4px 12px rgba(0, 75, 147, 0.2);
    }

    .tab-btn:hover:not(.active) {
      background: #e2e8f0;
      color: var(--navy-900);
    }

    .download-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--orange-500);
      font-weight: 700;
      padding: 10px 20px;
      border: 1px solid var(--orange-500);
      border-radius: 99px;
      transition: all 0.2s ease;
    }

    .download-btn:hover {
      background: var(--orange-500);
      color: #fff;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .calendar-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 700px;
    }

    .calendar-table th {
      background: #f8fafc;
      color: var(--navy-900);
      font-weight: 700;
      text-align: left;
      padding: 18px 24px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 2px solid #cbd5e1;
    }

    .calendar-table th:first-child { border-top-left-radius: 12px; }
    .calendar-table th:last-child { border-top-right-radius: 12px; }

    .calendar-table td {
      padding: 20px 24px;
      border-bottom: 1px solid #e2e8f0;
      color: var(--gray-700);
      font-size: 15px;
      vertical-align: top;
    }

    .calendar-table tbody tr:hover td {
      background: #f8fafc;
    }

    .calendar-table tbody tr:last-child td {
      border-bottom: none;
    }

    .event-date {
      font-weight: 700;
      color: var(--navy-900);
      display: block;
      margin-bottom: 4px;
    }

    .event-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-akademik { background: #e0f2fe; color: #0284c7; }
    .badge-libur { background: #fee2e2; color: #ef4444; }
    .badge-ujian { background: #fef3c7; color: #d97706; }
    .badge-kegiatan { background: #dcfce7; color: #16a34a; }

    @media (max-width: 768px) {
      .calendar-container { padding: 30px 20px; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">{{ $calendar ? $calendar->title : 'Kalender Akademik' }}</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Jadwal penting kegiatan perkuliahan, ujian, dan hari libur di lingkungan STIM YKPN Yogyakarta.
      </p>
    </div>
  </header>

  <section class="calendar-section">
    <div class="container">
      
      <div class="calendar-container animate-on-scroll" style="padding: 40px; border-radius: 20px;">
        @if($calendar)
            <div class="prose max-w-none text-slate-700" style="line-height: 1.8; font-size: 16px;">
                {!! $calendar->content !!}
            </div>
            
            @if($calendar->header_image)
                <div style="margin-top: 40px; text-align: center;">
                    <img src="{{ $calendar->header_image }}" alt="Kalender Akademik" style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 40px 0; color: #64748b;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 64px; height: 64px; margin: 0 auto 16px; opacity: 0.5;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p>Data Kalender Akademik belum tersedia.</p>
            </div>
        @endif
      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>






