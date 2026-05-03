# 🎓 STIM YKPN EDU - Academic Management System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue.js" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind" />
  <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker" />
  <img src="https://img.shields.io/badge/JWT-000000?style=for-the-badge&logo=json-web-tokens&logoColor=white" alt="JWT" />
</div>

---

## 🌟 Overview

**STIM YKPN EDU** is a modern, high-performance academic management platform designed to streamline administrative workflows and enhance the educational experience. Built with the power of **Laravel 10** and the reactivity of **Vue 3**, this platform offers a seamless, premium interface for managing academic data.

## 🔥 Key Features

### 📋 Modul Back-Office
| Kategori | Modul |
|---|---|
| **Konten** | Banner, Berita, Lowongan Kerja, Logo Sertifikasi |
| **Profil** | Sambutan Ketua, Visi & Misi, Sejarah, Logo & Lambang, Fasilitas, Prestasi, SPMI & Akreditasi |
| **Akademik** | Program Pendidikan, Kalender Akademik, Ketentuan Perkuliahan, Ujian & Kelulusan, Perpustakaan |
| **Penelitian** | Jurnal/Artikel Dosen |
| **Kemahasiswaan** | Kegiatan Mahasiswa, UKM, Testimoni Alumni |
| **Campus Life** | Video, Informasi Tempat Tinggal |
| **PMB** | Beasiswa, Keunggulan Program, Program Reguler, Program Ekstensi |
| **Master Data** | Dosen, Tahun Ajaran, Program Studi |
| **Manajemen** | User, Role, Brosur, File Publik, Voucher, Pengaturan Pembayaran |

### 🔒 Security & Authentication
- **Custom JWT Implementation**: Secure, stateless authentication using HMAC-SHA256.
- **Database-Backed Validation**: Every JWT request is cross-verified against the database.
- **Role-Based Access Control (RBAC)**: Optimized payload for fast performance.

### 🎨 Premium UI/UX
- **Glassmorphism Aesthetics**: Modern, clean, and elegant design using Tailwind CSS.
- **Micro-animations**: Subtle transitions for a high-end feel.
- **Responsive Design**: Fully optimized for mobile and desktop views.

## 🛠️ Tech Stack

- **Backend**: [Laravel 10](https://laravel.com/) (PHP 8.1+)
- **Frontend**: [Vue.js 3](https://vuejs.org/) (Composition API)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **Auth**: Custom JWT (JSON Web Tokens)
- **Database**: MySQL 8.0
- **Container**: Docker + Docker Compose
- **Build**: Vite 5

---

## 🚀 Getting Started

### 📦 Opsi 1: Setup Manual (Local Development)

1. **Clone repository**
   ```bash
   git clone https://github.com/your-username/stim_ykpn_edu.git
   cd stim_ykpn_edu
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   > Edit `.env` dan sesuaikan konfigurasi database.

4. **Migrasi database**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

5. **Jalankan development server**
   ```bash
   # Terminal 1
   php artisan serve

   # Terminal 2
   npm run dev
   ```
   Akses di `http://localhost:8000`

---

### 🐳 Opsi 2: Docker (Recommended untuk VPS)

#### Quick Start
```bash
# 1. Copy environment file
cp .env.example .env
# Edit .env sesuai kebutuhan (APP_KEY, DB credentials, dll)

# 2. Build & jalankan
docker compose up -d --build

# 3. Jalankan migrasi (pertama kali)
docker compose exec app php artisan migrate --seed --force

# 4. Akses aplikasi
# App:        http://localhost:8080
# phpMyAdmin: http://localhost:8081 (dev mode)
```

#### Perintah Docker Berguna
```bash
# Start semua service
docker compose up -d

# Start dengan phpMyAdmin (dev)
docker compose --profile dev up -d

# Stop semua service
docker compose down

# Rebuild setelah perubahan kode
docker compose up -d --build

# Lihat log
docker compose logs -f app

# Masuk ke container
docker compose exec app sh

# Jalankan artisan command
docker compose exec app php artisan migrate --force
docker compose exec app php artisan cache:clear

# Reset database (HATI-HATI!)
docker compose exec app php artisan migrate:fresh --seed --force
```

#### Environment Variables (Docker)
| Variable | Default | Keterangan |
|---|---|---|
| `APP_PORT` | `8080` | Port aplikasi di host |
| `APP_KEY` | - | Laravel app key (wajib) |
| `APP_ENV` | `production` | Environment |
| `DB_DATABASE` | `stim_ykpn_edu` | Nama database |
| `DB_USERNAME` | `stim_user` | User database |
| `DB_PASSWORD` | `secret` | Password database |
| `DB_ROOT_PASSWORD` | `rootsecret` | Root password MySQL |
| `DB_PORT` | `3307` | Port MySQL di host |
| `PMA_PORT` | `8081` | Port phpMyAdmin |

---

### 📜 Opsi 3: Deploy Script (Hosting / VPS tanpa Docker)

Script `deploy.sh` otomatis menjalankan semua langkah deployment:

```bash
# Deploy update biasa (database aman)
bash deploy.sh

# Deploy fresh (reset database — HATI-HATI!)
bash deploy.sh --fresh
```

**Yang dilakukan script:**
1. ✅ `git pull` — ambil kode terbaru
2. ✅ `composer install` — install PHP dependencies
3. ✅ `npm ci && npm run build` — build frontend assets
4. ✅ Cek file `.env`
5. ✅ `php artisan migrate` — migrasi database
6. ✅ `php artisan storage:link` — symlink storage
7. ✅ Cache optimization (config, route, view)
8. ✅ Set folder permissions

---

## 📂 Project Structure

```
├── app/
│   ├── Http/Controllers/Api/  # API Controllers (CRUD semua modul)
│   ├── Http/Middleware/        # JWT Auth Middleware
│   ├── Models/                 # Eloquent Models
│   └── Helpers/                # JwtHelper
├── database/
│   ├── migrations/             # 65+ migration files
│   └── seeders/                # Admin & Role seeders
├── docker/
│   ├── nginx.conf              # Nginx configuration
│   └── supervisord.conf        # Supervisor (PHP-FPM + Nginx)
├── resources/js/
│   ├── Pages/                  # Vue page components
│   │   ├── Content/            # Profil, Banner, News, dll
│   │   ├── Student/            # Activity, UKM, Testimony
│   │   ├── PaymentSetting/     # Pengaturan Pembayaran
│   │   └── ...                 # 20+ module directories
│   ├── Components/             # Reusable components
│   │   ├── Atoms/              # AppButton, AppInput
│   │   ├── Molecules/          # StatCard
│   │   └── Organisms/          # AppSidebar, AppNavbar
│   ├── Config/                 # sidebarMenu.json
│   └── Helpers/                # cookie.js
├── routes/
│   ├── web.php                 # 50+ page routes
│   └── api.php                 # 80+ API endpoints
├── Dockerfile                  # Multi-stage Docker build
├── docker-compose.yml          # App + MySQL + phpMyAdmin
├── deploy.sh                   # One-click deploy script
└── .dockerignore               # Docker build exclusions
```

## 🔐 Default Login

| Username | Password |
|---|---|
| `admindev` | `12345678Aa*` |

> ⚠️ **Ganti password default setelah deploy ke production!**

---

<div align="center">
  Developed with ❤️ for <b>STIM YKPN</b>
</div>
