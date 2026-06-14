@extends('layouts.public')

@section('seo')
  <x-seo-head
    title="Kegiatan Akademik — STIM YKPN Yogyakarta"
    description="Jadwal dan informasi kegiatan akademik mahasiswa STIM YKPN Yogyakarta."
    :canonicalUrl="url('/kegiatan-akademik')"
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
      <h1 class="page-title animate-on-scroll">Kegiatan Akademik</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">Rangkaian kegiatan perkuliahan, praktikum, dan riset bagi mahasiswa.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Program Pendidikan</div>
        <ul class="sidebar-menu">
          <li><a href="/sasaran-pendidikan">Sasaran Pendidikan</a></li>
          <li><a href="/cara-mencapai-sasaran">Cara Mencapai Sasaran</a></li>
          <li><a href="/beban-studi">Beban Studi</a></li>
          <li><a href="/sks">Sistem Kredit Semester (SKS)</a></li>
          <li><a href="/jenjang-studi">Jenjang Studi Dan Masa Studi</a></li>
          <li><a href="/kegiatan-akademik" class="active">Kegiatan Akademik</a></li>
          <li><a href="/dosen-pembimbing">Dosen Pembimbing</a></li>
          <li><a href="/sanksi-akademik">Sanksi Akademik</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Kegiatan Akademik Terpadu</h2>
        </div>
        <div class="article-body">
          <p>Kegiatan akademik di STIM YKPN Yogyakarta mencakup berbagai kegiatan yang mendukung Tridharma Perguruan Tinggi, mulai dari perkuliahan tatap muka hingga riset lapangan.</p>
          
          <ul class="target-list">
            <li>
              <h4>Perkuliahan Tatap Muka & E-Learning</h4>
              Kegiatan interaktif antara dosen dan mahasiswa di kelas, didukung dengan platform *E-Campuz* untuk materi digital dan tugas *online*.
            </li>
            <li>
              <h4>Praktikum Laboratorium</h4>
              Kegiatan khusus untuk mata kuliah aplikatif seperti komputer akuntansi, riset operasi, digital marketing, dan simulasi pasar modal.
            </li>
            <li>
              <h4>Kuliah Kerja Lapangan (KKL) / Magang</h4>
              Program wajib untuk memberikan wawasan langsung tentang dunia industri yang biasanya dilaksanakan pada semester akhir.
            </li>
            <li>
              <h4>Penulisan Skripsi / Tugas Akhir</h4>
              Karya tulis ilmiah mandiri yang wajib disusun mahasiswa pada akhir jenjang pendidikan sebagai syarat kelulusan dan pemerolehan gelar.
            </li>
          </ul>
        </div>
      </article>

    </div>
  </section>
@endsection
