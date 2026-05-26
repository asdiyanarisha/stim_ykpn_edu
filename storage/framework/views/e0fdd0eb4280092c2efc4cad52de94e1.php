<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jurnal Penelitian Dosen - STIM YKPN Yogyakarta</title>
  
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

    @media (max-width: 992px) {
      .academic-layout { grid-template-columns: 1fr; }
      .academic-sidebar { position: relative; top: 0; }
    }
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <header class="page-header">
    <div class="container" style="position:relative; z-index:2;">
      <h1 class="page-title animate-on-scroll">Jurnal Penelitian Dosen</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: none; margin: 0 auto;">Koleksi karya ilmiah dan hasil penelitian para dosen STIM YKPN Yogyakarta.</p>
    </div>
  </header>

  <section class="academic-content-section">
    <div class="container academic-layout">
      
      <!-- Sidebar -->
      <aside class="academic-sidebar animate-on-scroll">
        <div class="sidebar-title">Penelitian</div>
        <ul class="sidebar-menu">
          <li><a href="https://journal.stimykpn.ac.id/index.php/tb" target="_blank" rel="noopener noreferrer">Jurnal Telaah Bisnis</a></li>
          <li><a href="https://journal.stimykpn.ac.id/index.php/cb" target="_blank" rel="noopener noreferrer">Jurnal Cakrawangsa Bisnis</a></li>
          <li><a href="/jurnal-penelitian" class="active">Penelitian Dosen</a></li>
          <li><a href="/jurnal-pengabdian">Pengabdian Dosen</a></li>
        </ul>
      </aside>

      <!-- Main Content -->
      <article class="academic-article animate-on-scroll animate-delay-1">
        <div class="article-header">
          <h2>Daftar Artikel Penelitian</h2>
        </div>
        <div class="article-body">
          
          <div class="search-container search-group">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" class="search-input" placeholder="Cari judul atau penulis..." data-search-target="#journalTable" data-search-items="tr.journal-row">
          </div>
  
          <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
              <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                  <th style="padding: 15px; text-align: left; color: var(--navy-900);">Judul Artikel</th>
                  <th style="padding: 15px; text-align: left; color: var(--navy-900); width: 200px;">Penulis</th>
                  <th style="padding: 15px; text-align: center; color: var(--navy-900); width: 80px;">Tahun</th>
                  <th style="padding: 15px; text-align: center; color: var(--navy-900); width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody id="journalTable">
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Pengaruh Komunikasi Pemasaran Terpadu terhadap Ekuitas Merek: Studi pada Hotel Cakra Kembang Yogyakarta</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Lisiya Fatma Umami, Ralina Transistari</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/122-225-3-PB_1707102034.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Antecedents of Customers Loyalty toward Go-Jek Service</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Helmy Ilham Nugraha, Anas Hidayat, Putra Endi Catyanaika, Sri Rejeki Ekasasi</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/188-512-1-PB_1707101976.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Pengaruh gaya Hidup, Kualitas Produk, dan Promosi terhadap Keputusan Pembelian Produk makanan Sehat Soyjoy</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Novita Sukmawati, Sri Rejeki Ekasasi</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/125-221-3-PB_1707101650.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Konflik Peran terhadap Komitmen Organisasi melalui Kepuasan Kerja Sebagai Variabel Intervening</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Dwi Lestari, Ralina Transistari</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/185-323-1-SM_1707101588.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Pengaruh nilai tukar, produksi, dan harga terhadap volume ekspor batubara di Provinsi Bengkulu</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Wahyuni Dwi Safitri, Retno Hartati</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/1144-2403-1-PB_1707101531.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Pengaruh Pendidikan, Pelatihan, dan Lingkungan Kerja terhadap Kinerja Karyawan di PT Kereta Api Indonesia</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Putu Yama Asmara, Sri Ekanti Sabardini</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/126-222-3-PB_1707101460.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">Does GCG Increase Financial Performance? A Study in Indonesian Sharia Banks</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Devi Novianti, Tri Gunarsih, Ralina Transistari</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2020</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/Does%20GCG%20Increase%20Financial%20Performance_Okt%202020_1707098712.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
                  <tr class="journal-row" style="border-bottom: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">The Impact of The Coronavirus Outbreak on Hotel Tax and Recovery Strategy</td>
                    <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Suparmono, dkk.</td>
                    <td style="padding: 15px; color: #64748b; text-align: center;">2022</td>
                    <td style="padding: 15px; text-align: center;">
                      <a href="https://stimykpn.ac.id/storage/journal/20suparmono_1686638416.pdf" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 5px; color: var(--orange-500); font-weight: bold; text-decoration: none; font-size: 0.85rem;">
                         PDF <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                      </a>
                    </td>
                  </tr>
                
              </tbody>
            </table>
          </div>

        </div>
      </article>

    </div>
  </section>

  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script src="/js/script.js?v=3.0"></script>
</body>
</html>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/jurnal-penelitian.blade.php ENDPATH**/ ?>