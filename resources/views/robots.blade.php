User-agent: *

# Allow all public pages
Allow: /
Allow: /berita
Allow: /berita/
Allow: /dosen
Allow: /dosen/
Allow: /profil
Allow: /visi-misi
Allow: /sambutan-ketua
Allow: /pimpinan
Allow: /fasilitas
Allow: /prestasi
Allow: /spmi
Allow: /pmb.html
Allow: /biaya-kuliah
Allow: /beasiswa
Allow: /program-reguler
Allow: /program-ekstensi
Allow: /pengumuman-diterima
Allow: /kegiatan-mahasiswa
Allow: /ukm
Allow: /ppkpt
Allow: /pengumuman
Allow: /alumni
Allow: /lowongan-kerja
Allow: /video
Allow: /informasi-tempat-tinggal
Allow: /brosur
Allow: /unduh
Allow: /kalender-akademik
Allow: /perpustakaan
Allow: /jurnal-penelitian
Allow: /jurnal-pengabdian
Allow: /logo
Allow: /sasaran-pendidikan
Allow: /cara-mencapai-sasaran
Allow: /beban-studi
Allow: /sks
Allow: /jenjang-studi
Allow: /kegiatan-akademik
Allow: /dosen-pembimbing
Allow: /sanksi-akademik
Allow: /kehadiran-kuliah
Allow: /tata-tertib-kuliah
Allow: /jumlah-kehadiran
Allow: /seminar-proposal
Allow: /ketentuan-ujian
Allow: /tata-tertib-ujian
Allow: /kelulusan
Allow: /yudisium

# Block admin & internal pages
Disallow: /login
Disallow: /dashboard
Disallow: /unauthenticated
Disallow: /masterData/
Disallow: /content/
Disallow: /academic/
Disallow: /student/
Disallow: /campus-life/
Disallow: /pmb/
Disallow: /research/
Disallow: /roles
Disallow: /roles/
Disallow: /user
Disallow: /user/
Disallow: /brochure
Disallow: /brochure/
Disallow: /public-files
Disallow: /public-files/
Disallow: /voucher
Disallow: /voucher/
Disallow: /payment_settings
Disallow: /setting
Disallow: /whatsapp-contact
Disallow: /api/

# Block internal utility
Disallow: /hot
Disallow: /build/

# Sitemap location — otomatis menggunakan APP_URL dari .env
Sitemap: {{ url('/sitemap.xml') }}
