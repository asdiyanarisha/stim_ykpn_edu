<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unit Kegiatan Mahasiswa (UKM) - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=3.0">

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

    /* Search Bar Styling */
    .search-container {
      position: relative;
      margin-bottom: 40px;
      max-width: 600px;
    }

    .search-input {
      width: 100%;
      padding: 16px 20px 16px 50px;
      font-size: 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      border: 2px solid #e2e8f0;
      border-radius: 16px;
      outline: none;
      transition: all 0.3s ease;
      background: #f8fafc;
      color: var(--navy-900);
    }

    .search-input:focus {
      border-color: var(--orange-500);
      background: #ffffff;
      box-shadow: 0 4px 20px rgba(241, 135, 33, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      pointer-events: none;
      transition: color 0.3s ease;
    }

    .search-input:focus ~ .search-icon {
      color: var(--orange-500);
    }

    /* UKM Card Styling with Image */
    #ukmGrid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .ukm-card {
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.04);
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .ukm-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
      border-color: var(--orange-500);
    }

    .ukm-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-bottom: 1px solid #e2e8f0;
      transition: transform 0.5s ease;
    }
    
    .ukm-card:hover .ukm-image {
      transform: scale(1.05);
    }
    
    .ukm-image-container {
      overflow: hidden;
      width: 100%;
      height: 200px;
    }

    .ukm-content {
      padding: 24px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .ukm-content h3 {
      color: var(--navy-900);
      font-size: 20px;
      font-weight: 800;
      margin-bottom: 20px;
      line-height: 1.3;
    }

    .ukm-info {
      margin-top: auto;
    }

    .ukm-info-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 12px;
      font-size: 14px;
      color: #64748b;
    }

    .ukm-info-item svg {
      width: 18px;
      height: 18px;
      color: var(--orange-500);
      flex-shrink: 0;
      margin-top: 2px;
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Unit Kegiatan Mahasiswa (UKM)</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Wadah pengembangan minat, bakat, dan kreativitas mahasiswa STIM YKPN Yogyakarta.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Kemahasiswaan</div>
        <ul class="sidebar-menu">
          <li><a href="/kegiatan-mahasiswa.html">Kegiatan Mahasiswa</a></li>
          <li><a href="/ukm.html" class="active">UKM</a></li>
        </ul>
      </aside>


      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Daftar Unit Kegiatan Mahasiswa</h2>
        </div>
        <div class="article-body">
          
    <div class="search-container">
      <input type="text" class="search-input" placeholder="Cari nama UKM atau jadwal..." data-search-target="#ukmGrid" data-search-items=".ukm-card">
      <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    </div>
  
    <p style="margin-bottom: 30px; font-size: 16px; color: #475569; line-height: 1.8;">Selain kegiatan perkuliahan, STIM YKPN juga mendukung para mahasiswa untuk dapat berprestasi dalam bidang UKM Olahraga dan non-olahraga melalui wadah-wadah berikut:</p>
      
    <div id="ukmGrid">
      <?php $__currentLoopData = $ukms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="ukm-card">
          <div class="ukm-image-container">
            <img src="<?php echo e(asset('storage/' . $ukm->header_image)); ?>" alt="<?php echo e($ukm->title); ?>" class="ukm-image">
          </div>
          <div class="ukm-content">
            <h3><?php echo e($ukm->title); ?></h3>
            <div class="ukm-info">
              <div class="ukm-info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span><strong>Jadwal:</strong><br><?php echo e($ukm->day); ?> - <?php echo e(\Carbon\Carbon::parse($ukm->time)->format('H:i')); ?> WIB</span>
              </div>
              <div class="ukm-info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span><strong>Lokasi:</strong><br><?php echo e($ukm->location); ?></span>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
        </div>
      </article>

    </div>
  </section>

  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>






<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/ukm.blade.php ENDPATH**/ ?>