<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil {{ $teacher->full_name }} — STIM YKPN Yogyakarta</title>
  <meta name="description" content="Detail profil akademik {{ $teacher->full_name }} di STIM YKPN Yogyakarta.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css?v=2.3">
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

  <!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container">
      <div class="breadcrumbs animate-on-scroll" style="margin-bottom: 20px; color: rgba(255,255,255,0.6); font-size: 0.9rem;">
        <a href="/" style="color: inherit;">Beranda</a> &nbsp;/&nbsp; 
        <a href="/dosen" style="color: inherit;">Dosen</a> &nbsp;/&nbsp; 
        <span style="color: var(--white);">{{ $teacher->full_name }}</span>
      </div>
      <h1 class="page-title animate-on-scroll">{{ ($teacher->front_title ? $teacher->front_title . ' ' : '') . $teacher->full_name . ($teacher->back_title ? ', ' . $teacher->back_title : '') }}</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1">
        {{ $teacher->jobTitle->title ?? 'Dosen STIM YKPN' }}
      </p>
    </div>
  </header>

  <!-- ============================================
       PROFILE SECTION
       ============================================ -->
  <section class="profile-section">
    <div class="container">
      <div class="profile-container">
        
        <!-- Sidebar -->
        <aside class="profile-sidebar animate-on-scroll">
          <div class="profile-photo-wrap">
            <img src="{{ $teacher->image_url ?: '/images/default-user.png' }}" alt="{{ $teacher->full_name }}" onerror="this.onerror=null;this.src='/images/default-user.png';">
          </div>

          <div class="profile-contact">
            @if($teacher->email)
            <div class="contact-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              <a href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a>
            </div>
            @endif

            @if($teacher->phone_number)
            <div class="contact-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
              <span>{{ $teacher->phone_number }}</span>
            </div>
            @endif

            @if($teacher->address)
            <div class="contact-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              <span>{{ $teacher->address }}</span>
            </div>
            @endif

            <!-- Online Profiles -->
            @if(isset($teacher->online_academic_profiles) && $teacher->online_academic_profiles->count() > 0)
              <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--gray-100);">
                <p style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--gray-400); margin-bottom: 12px; letter-spacing: 1px;">Profil Akademik</p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                  @foreach($teacher->online_academic_profiles as $profile)
                    <a href="{{ $profile->url }}" target="_blank" class="course-item" style="padding: 6px 14px; font-size: 0.8rem;">
                      {{ $profile->platform_name }}
                    </a>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <a href="/dosen" class="btn btn-outline" style="width: 100%; margin-top: 24px; justify-content: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12,19 5,12 12,5"></polyline></svg>
            Kembali ke Daftar
          </a>
        </aside>

        <!-- Main Content -->
        <main class="profile-main animate-on-scroll animate-delay-1">
          <div class="profile-header">
            <h2 class="profile-name">{{ ($teacher->front_title ? $teacher->front_title . ' ' : '') . $teacher->full_name . ($teacher->back_title ? ', ' . $teacher->back_title : '') }}</h2>
            <p class="profile-title">{{ $teacher->jobTitle->title ?? 'Dosen' }} | {{ $teacher->category->title ?? '' }}</p>
          </div>

          <div class="profile-content">
            <!-- Biography -->
            <h3>Biografi</h3>
            <p>{{ $teacher->personal_description ?: 'Belum ada informasi biografi untuk dosen ini.' }}</p>

            <!-- Education -->
            @if(isset($teacher->education) && $teacher->education->count() > 0)
              <h3>Pendidikan</h3>
              <div class="edu-timeline">
                @foreach($teacher->education as $edu)
                  <div class="edu-item">
                    <div class="edu-year">{{ $edu->graduation_year }}</div>
                    <div class="edu-degree">{{ $edu->degree }} - {{ $edu->major }}</div>
                    <div class="edu-univ">{{ $edu->institution }}</div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Professional Positions -->
            @if(isset($teacher->professional_positions) && $teacher->professional_positions->count() > 0)
              <h3>Jabatan Struktural / Profesional</h3>
              <div class="edu-timeline">
                @foreach($teacher->professional_positions as $pos)
                  <div class="edu-item">
                    <div class="edu-year">{{ $pos->start_year }} - {{ $pos->end_year ?: 'Sekarang' }}</div>
                    <div class="edu-degree">{{ $pos->position }}</div>
                    <div class="edu-univ">{{ $pos->institution }}</div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Expertise / Research Areas -->
            @if(isset($teacher->research_areas) && $teacher->research_areas->count() > 0)
              <h3>Bidang Keahlian / Riset</h3>
              <div class="course-list">
                @foreach($teacher->research_areas as $area)
                  <span class="course-item">{{ $area->area_name }}</span>
                @endforeach
              </div>
            @endif

            <!-- Publications -->
            @if(isset($teacher->publications) && $teacher->publications->count() > 0)
              <h3>Publikasi Jurnal / Artikel</h3>
              <div class="pub-list">
                @foreach($teacher->publications as $pub)
                  <div class="pub-item">
                    <div class="pub-title">{{ $pub->title }}</div>
                    <div class="pub-meta">{{ $pub->journal_name }} | {{ $pub->year }} @if($pub->url) | <a href="{{ $pub->url }}" target="_blank" style="color: var(--blue-500);">Lihat Publikasi</a> @endif</div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Books -->
            @if(isset($teacher->books) && $teacher->books->count() > 0)
              <h3>Buku</h3>
              <div class="pub-list">
                @foreach($teacher->books as $book)
                  <div class="pub-item">
                    <div class="pub-title">{{ $book->title }}</div>
                    <div class="pub-meta">Penerbit: {{ $book->publisher }} | Tahun: {{ $book->year }} @if($book->isbn) | ISBN: {{ $book->isbn }} @endif</div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Popular Writings -->
            @if(isset($teacher->popular_writings) && $teacher->popular_writings->count() > 0)
              <h3>Tulisan Populer / Media</h3>
              <div class="pub-list">
                @foreach($teacher->popular_writings as $writing)
                  <div class="pub-item">
                    <div class="pub-title">{{ $writing->title }}</div>
                    <div class="pub-meta">Media: {{ $writing->media }} | Tanggal: {{ $writing->date }} @if($writing->url) | <a href="{{ $writing->url }}" target="_blank" style="color: var(--blue-500);">Baca Selengkapnya</a> @endif</div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- Awards -->
            @if(isset($teacher->awards) && $teacher->awards->count() > 0)
              <h3>Penghargaan</h3>
              <div class="pub-list">
                @foreach($teacher->awards as $award)
                  <div class="pub-item">
                    <div class="pub-title">{{ $award->award_name }}</div>
                    <div class="pub-meta">Pemberi: {{ $award->grantor }} | Tahun: {{ $award->year }}</div>
                  </div>
                @endforeach
              </div>
            @endif

          </div>
        </main>
      </div>
    </div>
  </section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
</body>
</html>
