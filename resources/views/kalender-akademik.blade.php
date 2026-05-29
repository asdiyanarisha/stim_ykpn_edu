<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalender Akademik - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/css/style.css?v=3.8">

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
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .calendar-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 700px;
      background: #fff;
    }

    .calendar-table th {
      background: var(--navy-900);
      color: rgba(255, 255, 255, 0.95);
      font-weight: 700;
      text-align: left;
      padding: 20px 24px;
      font-size: 15px;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 3px solid var(--orange-500);
    }

    .calendar-table td {
      padding: 20px 24px;
      border-bottom: 1px solid #e2e8f0;
      color: var(--gray-700);
      font-size: 15px;
      vertical-align: top;
      transition: background 0.2s ease, border-left 0.2s ease;
      border-left: 4px solid transparent;
    }

    /* Zebra Striping */
    .calendar-table tbody tr:nth-child(even) td {
      background-color: #f8fafc;
    }

    /* Hover effect */
    .calendar-table tbody tr:hover td {
      background-color: #f1f5f9;
    }
    
    .calendar-table tbody tr:hover td:first-child {
      border-left: 4px solid var(--orange-500);
    }

    .calendar-table tbody tr:last-child td {
      border-bottom: none;
    }

    .event-date {
      font-weight: 800;
      color: var(--navy-900);
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
      font-size: 16px;
    }
    
    .event-date i {
      color: var(--orange-500);
      font-size: 18px;
    }

    .event-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-akademik { background: #e0f2fe; color: #0369a1; }
    .badge-libur { background: #fee2e2; color: #b91c1c; }
    .badge-ujian { background: #fef3c7; color: #b45309; }
    .badge-kegiatan { background: #dcfce7; color: #15803d; }

    @media (max-width: 768px) {
      .calendar-container { padding: 30px 20px; }
      .calendar-table th, .calendar-table td { padding: 15px; }
    }
    
    @media print {
      .navbar, .footer, .calendar-tabs, .download-btn, .page-header, .wa-floating-container {
        display: none !important;
      }
      .calendar-container {
        box-shadow: none;
        border: none;
        padding: 0;
      }
      .calendar-section {
        padding: 0;
      }
      .calendar-table {
        page-break-inside: auto;
      }
      .calendar-table tr {
        page-break-inside: avoid;
        page-break-after: auto;
      }
      body {
        background-color: #fff;
      }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Kalender Akademik {{ $activeYear ? $activeYear->label : '' }}</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Jadwal penting kegiatan perkuliahan, ujian, dan hari libur di lingkungan STIM YKPN Yogyakarta.
      </p>
    </div>
  </header>

  <section class="calendar-section">
    <div class="container">
      
      <div class="calendar-container animate-on-scroll">
        
        <div class="calendar-controls">
          <div class="calendar-tabs">
            @foreach($semesters as $index => $sem)
              <button class="tab-btn {{ $index === 0 ? 'active' : '' }}" id="btn-{{ $sem->kode }}" onclick="switchTab('{{ $sem->kode }}')">
                {{ $sem->nama }}
              </button>
            @endforeach
          </div>
          <a href="#" class="download-btn" onclick="window.print(); return false;" title="Cetak atau Simpan sebagai PDF">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Unduh / Cetak PDF
          </a>
        </div>

        @foreach($semesters as $index => $sem)
          <div class="table-responsive" id="table-{{ $sem->kode }}" style="{{ $index === 0 ? '' : 'display: none;' }}">
            <table class="calendar-table">
              <thead>
                <tr>
                  <th width="30%">Tanggal / Waktu</th>
                  <th width="50%">Kegiatan Akademik</th>
                  <th width="20%">Kategori</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $semKegiatans = $kegiatans->where('semester_id', $sem->id);
                @endphp
                @forelse($semKegiatans as $keg)
                  @php
                    $start = \Carbon\Carbon::parse($keg->tanggal_mulai);
                    $end = \Carbon\Carbon::parse($keg->tanggal_selesai);
                    
                    // Set locale to Indonesian
                    \Carbon\Carbon::setLocale('id');
                    
                    if ($start->format('Y-m-d') === $end->format('Y-m-d')) {
                        $dateRange = $start->translatedFormat('d F');
                    } elseif ($start->format('Y-m') === $end->format('Y-m')) {
                        $dateRange = $start->translatedFormat('d') . ' - ' . $end->translatedFormat('d F');
                    } elseif ($start->format('Y') === $end->format('Y')) {
                        $dateRange = $start->translatedFormat('d M') . ' - ' . $end->translatedFormat('d M');
                    } else {
                        $dateRange = $start->translatedFormat('d M Y') . ' - ' . $end->translatedFormat('d M Y');
                    }
                    
                    $yearDisplay = ($start->format('Y') === $end->format('Y')) 
                        ? $start->format('Y') 
                        : $start->format('Y') . '/' . $end->format('Y');
                  @endphp
                  <tr>
                    <td>
                      <span class="event-date">
                        <i class="fi fi-rr-calendar-lines"></i> 
                        {{ $dateRange }}
                      </span>
                      {{ $yearDisplay }}
                    </td>
                    <td>
                      <strong style="color: var(--navy-900); font-size: 16px;">{{ $keg->judul }}</strong><br>
                      {{ $keg->deskripsi }}
                    </td>
                    <td>
                      @php
                        $kat = $kategori->firstWhere('id', $keg->kategori_id);
                      @endphp
                      @if($kat)
                        <span class="event-badge" style="background-color: {{ $kat->warna }}15; color: {{ $kat->warna }}; border: 1px solid {{ $kat->warna }}30; text-transform: uppercase;">
                          <i class="{{ str_starts_with($kat->ikon, 'bi-') ? 'bi' : 'fi' }} {{ $kat->ikon }}"></i> 
                          {{ $kat->nama }}
                        </span>
                      @else
                        -
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" style="text-align: center; color: var(--gray-500); padding: 40px 20px;">
                      Belum ada kegiatan akademik yang terdaftar untuk semester ini.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        @endforeach

        <div style="margin-top: 30px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 25px;">
          <h4 style="color: var(--navy-900); margin-top: 0; font-size: 18px; margin-bottom: 15px;"><i class="fi fi-rr-info"></i> Keterangan Khusus</h4>
          <ol style="margin-bottom: 0; padding-left: 20px; color: var(--gray-700); font-size: 15px; line-height: 1.6;">
            <li style="margin-bottom: 8px;">Kuliah dan Pengenalan Kehidupan Campus Mahasiswa Baru diatur dalam pengumuman tersendiri.</li>
            <li style="margin-bottom: 8px;">Kuliah di hari Libur Nasional dan cuti bersama diganti di hari Sabtu pada minggu yang sama.</li>
            <li style="margin-bottom: 8px;">Libur perkuliahan di Hari Raya Idul Fitri mengikuti Yayasan.</li>
            <li style="margin-bottom: 8px;">Seminar Proposal Skripsi diatur dalam ketentuan tersendiri.</li>
            <li>Ujian Skripsi dan Tugas Akhir diatur dalam ketentuan tersendiri.</li>
          </ol>
        </div>

        <script>
          function switchTab(targetKode) {
            // Deactivate all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
              btn.classList.remove('active');
            });
            // Hide all tables
            document.querySelectorAll('.table-responsive').forEach(tbl => {
              tbl.style.display = 'none';
            });
            
            // Activate selection
            const targetBtn = document.getElementById('btn-' + targetKode);
            const targetTable = document.getElementById('table-' + targetKode);
            
            if (targetBtn) targetBtn.classList.add('active');
            if (targetTable) targetTable.style.display = 'block';
          }
        </script>

      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=3.8"></script>
</body>
</html>
