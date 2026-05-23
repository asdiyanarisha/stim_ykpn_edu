<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Pendaftaran - STIM YKPN</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
    rel="stylesheet">

  <!-- Base Styles -->
  <link rel="stylesheet" href="/css/style.css?v=2.3">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <style>
    /* ==============================================
       CLEAN FORM WITH MODERN ORNAMENTS
       ============================================== */
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f4f7f9;
      /* Subtle dot grid pattern */
      background-image: radial-gradient(#d1d5db 1px, transparent 1px);
      background-size: 24px 24px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: #1e293b;
      margin: 0;
      position: relative;
    }

    /* ORNAMENT: Floating Light Blobs */
    .decor-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      z-index: -1;
      opacity: 0.6;
    }

    .decor-1 {
      top: 100px;
      left: 10%;
      width: 300px;
      height: 300px;
      background: rgba(241, 135, 33, 0.2);
    }

    .decor-2 {
      top: 200px;
      right: 5%;
      width: 400px;
      height: 400px;
      background: rgba(0, 75, 147, 0.2);
    }

    /* ==============================================
       PAGE HEADER STYLING
       ============================================== */
    .page-header {
      padding: 160px 0 120px;
      background: linear-gradient(135deg, var(--navy-900) 0%, var(--blue-600) 100%);
      color: white;
      text-align: center;
      position: relative;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 40px;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent);
    }

    .page-title {
      font-size: 2.8rem;
      font-weight: 800;
      color: white;
      margin-bottom: 16px;
    }

    .page-subtitle {
      font-size: 1.1rem;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.6;
    }

    .form-page-container {
      max-width: 900px;
      margin: -60px auto 100px;
      /* Negative top margin to overlap header */
      padding: 0 20px;
      position: relative;
      z-index: 10;
    }

    /* Form Card with Accent */
    .form-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
      padding: 60px;
      border-top: 6px solid var(--orange-500);
      position: relative;
    }

    /* ORNAMENT: Watermark Logo inside card */
    .form-card::after {
      content: '';
      position: absolute;
      bottom: 20px;
      right: 20px;
      width: 200px;
      height: 200px;
      background-image: url('/images/img/logo/logo-stim-new.png');
      background-size: contain;
      background-repeat: no-repeat;
      background-position: bottom right;
      opacity: 0.03;
      pointer-events: none;
    }

    .form-header {
      text-align: center;
      margin-bottom: 48px;
    }

    .form-header h1 {
      font-size: 30px;
      font-weight: 800;
      color: var(--navy-900);
      margin-bottom: 8px;
      letter-spacing: -0.5px;
    }

    .form-header p {
      font-size: 14px;
      color: #f18721;
      margin: 0;
      font-weight: 800;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    /* Form Layout Grid (UNCHANGED) */
    .stim-form {
      display: flex;
      flex-direction: column;
      gap: 24px;
      position: relative;
      z-index: 2;
    }

    .form-row {
      display: flex;
      gap: 24px;
      width: 100%;
    }

    .form-col-100 {
      flex: 1;
      width: 100%;
    }

    .form-col-50 {
      flex: 1;
      width: calc(50% - 12px);
    }

    .form-col-33 {
      flex: 1;
      width: calc(33.333% - 16px);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-size: 14px;
      color: #334155;
      font-weight: 600;
    }

    .form-control {
      width: 100%;
      height: 52px;
      padding: 0 16px;
      background-color: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      color: #1e293b;
      outline: none;
      transition: all 0.2s ease;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.01);
    }

    textarea.form-control {
      height: auto;
      min-height: 120px;
      padding: 16px;
      resize: vertical;
    }

    .form-control:hover {
      border-color: #cbd5e1;
      background-color: #f1f5f9;
    }

    .form-control:focus {
      background-color: #ffffff;
      border-color: var(--blue-500);
      box-shadow: 0 0 0 4px rgba(0, 75, 147, 0.1);
    }

    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 16px center;
      cursor: pointer;
    }

    .btn-submit {
      width: 100%;
      height: 56px;
      background-color: #f18721;
      color: #ffffff;
      font-size: 16px;
      font-weight: 800;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(241, 135, 33, 0.3);
      animation: formSubmitPulse 2s infinite;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-submit:hover {
      background-color: #d9771a;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(241, 135, 33, 0.5);
    }

    @keyframes formSubmitPulse {
      0% {
        box-shadow: 0 0 0 0 rgba(241, 135, 33, 0.4);
      }

      70% {
        box-shadow: 0 0 0 12px rgba(241, 135, 33, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(241, 135, 33, 0);
      }
    }

    /* Helpdesk Banner */
    .helpdesk-banner {
      display: flex;
      align-items: center;
      gap: 16px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      padding: 16px 20px;
      border-radius: 12px;
      margin-bottom: 32px;
    }

    .helpdesk-icon {
      font-size: 24px;
      background: #dbeafe;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    .helpdesk-text {
      flex: 1;
      font-size: 14px;
      color: #1e3a8a;
      line-height: 1.4;
    }

    .helpdesk-link {
      background: #25D366;
      color: white;
      text-decoration: none;
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 700;
      transition: background 0.3s;
    }

    .helpdesk-link:hover {
      background: #1ebc5a;
    }

    /* Checkbox Styling */
    .checkbox-group {
      margin-top: 8px;
      margin-bottom: 8px;
    }

    .custom-checkbox {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      cursor: pointer;
      user-select: none;
    }

    .custom-checkbox input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      display: block;
      flex-shrink: 0;
      width: 24px;
      height: 24px;
      background-color: #f8fafc;
      border: 2px solid #cbd5e1;
      border-radius: 6px;
      position: relative;
      transition: all 0.2s ease;
      margin-top: 2px;
    }

    .custom-checkbox:hover input~.checkmark {
      border-color: #0060ba;
    }

    .custom-checkbox input:checked~.checkmark {
      background-color: #004b93;
      border-color: #004b93;
    }

    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
      left: 7px;
      top: 3px;
      width: 6px;
      height: 12px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    .custom-checkbox input:checked~.checkmark:after {
      display: block;
    }

    .checkbox-text {
      font-size: 14px;
      color: #475569;
      line-height: 1.5;
    }

    /* Light mode navbar adjustment */
    .navbar:not(.scrolled) {
      background: transparent !important;
      box-shadow: none !important;
    }

    .navbar:not(.scrolled) .nav-links a {
      color: rgba(255, 255, 255, 0.9) !important;
    }

    .navbar.scrolled {
      background: #ffffff !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    }

    .navbar.scrolled .nav-links a {
      color: var(--navy-900) !important;
    }

    .navbar.scrolled .nav-links a.active {
      color: var(--orange-500) !important;
    }

    .navbar.scrolled .brand-logo {
      filter: none !important;
    }

    /* Fix dropdown visibility on transparent navbar */
    .navbar:not(.scrolled) .nav-links .dropdown-menu a {
      color: var(--gray-800) !important;
    }

    .navbar:not(.scrolled) .nav-links .dropdown-menu a:hover {
      color: var(--orange-500) !important;
      background: var(--gray-50);
    }

    .navbar:not(.scrolled) .nav-links .dropdown-submenu>a {
      color: var(--gray-800) !important;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 20px;
      }

      .form-col-50,
      .form-col-33 {
        width: 100%;
      }

      .helpdesk-banner {
        flex-direction: column;
        text-align: center;
      }

      .helpdesk-link {
        width: 100%;
        text-align: center;
      }

      .form-card {
        padding: 40px 24px;
      }
    }
  </style>
  @vite(['resources/js/app.js'])
  <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">
</head>

<body>

  <!-- Background Ornaments -->
  <div class="decor-blob decor-1"></div>
  <div class="decor-blob decor-2"></div>

  <!-- NAVBAR -->
  @include('components.navbar')

  <!-- ============================================
       PAGE HEADER
       ============================================ -->
  <header class="page-header">
    <div class="container">
      <h1 class="page-title animate-on-scroll">Pendaftaran PMB</h1>
      <p class="page-subtitle animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto;">
        Lengkapi formulir di bawah ini untuk memulai perjalanan akademik Anda bersama STIM YKPN Yogyakarta.
      </p>
    </div>
  </header>

  <!-- FORM SECTION (VUE) -->
  <div id="app" data-page="pmbFrontendForm"></div>

  @include('components.footer')

  <!-- Script -->
  <script src="/js/script.js?v=2.3"></script>
  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Vite client is injected, but we don't need the inline manual submission anymore
  </script>
</body>

</html>
