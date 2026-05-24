<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visi & Misi - STIM YKPN Yogyakarta</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=2.5">

  <style>
body { background: #f8fafc; }

/* === HERO === */
.vm-hero {
  position: relative;
  background: #0a1628 url('/images/hero-bg.png') center/cover no-repeat;
  min-height: 380px;
  display: flex;
  align-items: center;
  padding: 130px 0 80px;
  overflow: hidden;
}
.vm-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(6,18,40,0.7) 0%, rgba(8,24,56,0.9) 100%);
}
.vm-hero::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, transparent 0%, #f97316 50%, transparent 100%);
  z-index: 2;
}
.vm-hero-content { position: relative; z-index: 2; }

.vm-hero h1 {
  font-size: clamp(2.8rem, 5vw, 3.5rem);
  font-weight: 800;
  color: #fff;
  margin-bottom: 16px;
  letter-spacing: -0.5px;
}
.vm-hero p {
  font-size: 1.1rem;
  color: rgba(255,255,255,0.65);
  max-width: 560px;
  line-height: 1.7;
}

/* === VISI SECTION === */
.visi-section {
  padding: 100px 0;
  background: #fff;
}
.visi-layout {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 60px;
  align-items: center;
  max-width: 1000px;
  margin: 0 auto;
}
.visi-label-side {
  position: relative;
}
.visi-big-text {
  font-size: 160px;
  font-weight: 900;
  color: rgba(15,23,42,0.03);
  line-height: 0.85;
  letter-spacing: -8px;
  user-select: none;
}
.visi-small-label {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 14px;
  font-weight: 800;
  color: #f97316;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin-top: 16px;
}
.visi-small-label::before {
  content: '';
  width: 32px;
  height: 3px;
  background: #f97316;
  border-radius: 2px;
}
.misi-small-label {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 14px;
  font-weight: 800;
  color: #004b93;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin-top: 16px;
}
.misi-small-label::before {
  content: '';
  width: 32px;
  height: 3px;
  background: #004b93;
  border-radius: 2px;
}
.visi-statement {
  font-size: clamp(1.7rem, 3vw, 2.4rem);
  font-weight: 600;
  color: #0f172a;
  line-height: 1.55;
  font-family: Georgia, 'Times New Roman', serif;
}
.visi-highlight {
  color: #f97316;
  position: relative;
}
.visi-divider {
  max-width: 1000px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  gap: 20px;
  padding-top: 80px;
}
.visi-divider::before, .visi-divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: #e2e8f0;
}
.visi-divider-diamond {
  width: 10px;
  height: 10px;
  background: #f97316;
  transform: rotate(45deg);
  flex-shrink: 0;
}

/* === MISI SECTION === */
.misi-section {
  padding: 100px 0;
  background: #f1f5f9;
  position: relative;
}
.misi-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(circle, rgba(0,0,0,0.03) 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
}
.misi-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}
.misi-box {
  background: #fff;
  border-radius: 16px;
  padding: 32px 28px;
  border: 1px solid #e8ecf1;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  position: relative;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.misi-box::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, #f97316, #fb923c);
  opacity: 0;
  transition: opacity 0.3s;
}
.misi-box:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.06);
}
.misi-box:hover::before {
  opacity: 1;
}
.misi-box.wide {
  grid-column: span 2;
}
.misi-box-icon {
  width: 44px;
  height: 44px;
  background: linear-gradient(135deg, #0f172a, #1e3a5f);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  margin-bottom: 16px;
  transition: all 0.3s ease;
}
.misi-box:hover .misi-box-icon {
  background: linear-gradient(135deg, #f97316, #fb923c);
  transform: scale(1.05);
}
.misi-box-number {
  position: absolute;
  top: 16px;
  right: 20px;
  font-size: 60px;
  font-weight: 900;
  color: rgba(15,23,42,0.03);
  line-height: 1;
  pointer-events: none;
}
.misi-box-text {
  font-size: 16px;
  line-height: 1.65;
  color: #0f172a;
  font-weight: 600;
  font-family: Georgia, 'Times New Roman', serif;
}

/* === RESPONSIVE === */
@media (max-width: 900px) {
  .visi-layout { grid-template-columns: 1fr; gap: 32px; text-align: center; }
  .visi-big-text { font-size: 100px; }
  .visi-small-label { justify-content: center; }
  .misi-grid { grid-template-columns: 1fr; text-align: left; }
  .misi-box.wide { grid-column: span 1; }
}
@media (max-width: 768px) {
  .vm-hero { min-height: 320px; padding: 110px 0 60px; }
  .visi-section { padding: 60px 0; }
  .visi-statement { font-size: 1.5rem; }
  .visi-divider { padding-top: 50px; }
  .misi-section { padding: 60px 0; }
  .misi-box { padding: 24px 20px; }
  .misi-box-number { font-size: 48px; }
}
  </style>
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>
<body>

  @include('components.navbar')

<!-- ===== HERO ===== -->
<div class="vm-hero">
  <div class="container vm-hero-content animate-on-scroll">
    <h1>Visi &amp; Misi</h1>
    <p>Arah kebijakan dan komitmen teguh STIM YKPN Yogyakarta dalam mencetak generasi unggul di bidang manajemen bisnis.</p>
  </div>
</div>

<!-- ===== VISI ===== -->
<section class="visi-section">
  <div class="container">
    <div class="visi-layout">
      <div class="visi-label-side animate-on-scroll">
        <div class="visi-big-text" style="color: rgba(249, 115, 22, 0.05);">VISI</div>
        <div class="visi-small-label">Visi Kami</div>
      </div>
      <div class="animate-on-scroll animate-delay-1">
        <div class="visi-statement">
          Menjadi Sekolah Tinggi Ilmu Manajemen yang unggul di tingkat nasional pada tahun <span class="visi-highlight">2030</span>.
        </div>
      </div>
    </div>
    <div class="visi-divider animate-on-scroll">
      <div class="visi-divider-diamond"></div>
    </div>
  </div>
</section>

<!-- ===== MISI ===== -->
<section class="misi-section">
  <div class="container">
    <div class="visi-layout" style="align-items: flex-start;">
      <div class="visi-label-side animate-on-scroll">
        <div class="visi-big-text" style="font-size: 140px; color: rgba(0, 75, 147, 0.05);">MISI</div>
        <div class="misi-small-label">Misi Kami</div>
      </div>
      <div class="animate-on-scroll animate-delay-1">
        <div class="misi-grid">
          <!-- Misi 1 -->
          <div class="misi-box wide">
            <div class="misi-box-number">01</div>
            <div class="misi-box-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1.1 2.7 2 6 2s6-.9 6-2v-5"/></svg>
            </div>
            <div class="misi-box-text">Menyelenggarakan proses pendidikan dan pengajaran di bidang manajemen dengan dukungan sumberdaya manusia yang profesional, sarana dan prasarana yang memadai, dan lingkungan yang kondusif untuk menghasilkan lulusan yang berkualitas.</div>
          </div>
          <!-- Misi 2 -->
          <div class="misi-box">
            <div class="misi-box-number">02</div>
            <div class="misi-box-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"/></svg>
            </div>
            <div class="misi-box-text">Menyelenggarakan kegiatan penelitian guna pengembangan ilmu manajemen dan memberi manfaat bagi dunia bisnis.</div>
          </div>
          <!-- Misi 3 -->
          <div class="misi-box">
            <div class="misi-box-number">03</div>
            <div class="misi-box-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/></svg>
            </div>
            <div class="misi-box-text">Menyelenggarakan kegiatan pengabdian kepada masyarakat untuk memberi kontribusi kepada pemangku kepentingan.</div>
          </div>
          <!-- Misi 4 -->
          <div class="misi-box wide">
            <div class="misi-box-number">04</div>
            <div class="misi-box-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
            </div>
            <div class="misi-box-text">Mengembangkan Sekolah Tinggi menjadi organisasi yang sehat dengan sistem tata kelola yang baik.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.5"></script>
</body>
</html>
