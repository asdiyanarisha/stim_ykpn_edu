<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalender Akademik - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.3">

  <style>
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
      <h1 class="page-title animate-on-scroll">Kalender Akademik</h1>
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
            <button class="tab-btn active">Semester Gasal</button>
            <button class="tab-btn">Semester Genap</button>
          </div>
          <a href="#" class="download-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Unduh PDF
          </a>
        </div>

        <div class="table-responsive">
          <table class="calendar-table">
            <thead>
              <tr>
                <th width="30%">Tanggal / Waktu</th>
                <th width="50%">Kegiatan Akademik</th>
                <th width="20%">Kategori</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <span class="event-date">1 - 15 Agustus</span>
                  2026
                </td>
                <td>
                  <strong>Pembayaran SPP Tetap & Registrasi Ulang</strong><br>
                  Pembayaran SPP Tetap dan Heregistrasi mahasiswa lama semester gasal.
                </td>
                <td><span class="event-badge badge-akademik">Administrasi</span></td>
              </tr>
              <tr>
                <td>
                  <span class="event-date">18 - 22 Agustus</span>
                  2026
                </td>
                <td>
                  <strong>Pengisian Kartu Rencana Studi (KRS)</strong><br>
                  Pengisian dan bimbingan KRS online melalui sistem E-Campuz.
                </td>
                <td><span class="event-badge badge-akademik">Akademik</span></td>
              </tr>
              <tr>
                <td>
                  <span class="event-date">1 September</span>
                  2026
                </td>
                <td>
                  <strong>Awal Perkuliahan Semester Gasal</strong><br>
                  Kuliah perdana tatap muka untuk seluruh jenjang program studi.
                </td>
                <td><span class="event-badge badge-kegiatan">Perkuliahan</span></td>
              </tr>
              <tr>
                <td>
                  <span class="event-date">20 - 31 Oktober</span>
                  2026
                </td>
                <td>
                  <strong>Ujian Tengah Semester (UTS)</strong><br>
                  Pelaksanaan UTS gasal secara terjadwal.
                </td>
                <td><span class="event-badge badge-ujian">Ujian</span></td>
              </tr>
              <tr>
                <td>
                  <span class="event-date">25 Desember</span>
                  2026
                </td>
                <td>
                  <strong>Libur Nasional Hari Raya Natal</strong><br>
                  Kegiatan kampus diliburkan.
                </td>
                <td><span class="event-badge badge-libur">Libur</span></td>
              </tr>
              <tr>
                <td>
                  <span class="event-date">5 - 17 Januari</span>
                  2027
                </td>
                <td>
                  <strong>Ujian Akhir Semester (UAS)</strong><br>
                  Pelaksanaan UAS gasal sebagai syarat ketuntasan studi.
                </td>
                <td><span class="event-badge badge-ujian">Ujian</span></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </section>

  @include('components.footer')

  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
