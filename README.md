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

### 📜 Opsi 3: Deploy Script (Hosting / VPS dengan SSH)

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

### 🌐 Opsi 4: Deploy ke Shared Hosting (cPanel — TANPA Composer & NPM)

> ⚠️ **Khusus untuk shared hosting yang HANYA memiliki File Manager cPanel, tanpa akses SSH, Composer, atau NPM.**

Strategi: **Build semua di komputer lokal → ZIP → Upload via File Manager cPanel.**

---

#### 📋 Prasyarat

| Komponen | Di Komputer Lokal | Di Shared Hosting |
|---|---|---|
| **PHP** | ≥ 8.1 ✅ | ≥ 8.1 (cek di cPanel) |
| **Composer** | ✅ Required | ❌ Tidak perlu |
| **Node.js + NPM** | ≥ 18 ✅ Required | ❌ Tidak perlu |
| **MySQL** | Opsional | ✅ Buat via cPanel |
| **zip** | ✅ Required | ❌ cPanel bisa extract |

---

#### 🔧 Step 1: Persiapan di cPanel (Satu Kali)

Sebelum upload, siapkan dulu database di cPanel:

1. **Login ke cPanel** hosting kamu
2. **Buat Database MySQL:**
   - Buka **MySQL® Databases**
   - Buat database baru, contoh: `stim_ykpn`
   - Buat user baru, contoh: `stim_user` dengan password kuat
   - **Add User to Database** → pilih **ALL PRIVILEGES**
   - Catat nama database, username, dan password (format cPanel biasanya `cpanelusername_namadb`)

3. **Cek versi PHP:**
   - Buka **Select PHP Version** atau **MultiPHP Manager**
   - Pastikan domain menggunakan **PHP 8.1** atau lebih tinggi
   - Aktifkan ekstensi: `fileinfo`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`

---

#### 📦 Step 2: Build di Komputer Lokal

Jalankan script build di komputer lokal (tempat source code berada):

```bash
# Clone/pull kode terbaru
git pull origin main

# Jalankan script deploy untuk shared hosting
bash deploy-shared-hosting.sh
```

Script ini akan:
1. ✅ Cek semua prerequisite (PHP, Composer, NPM, zip)
2. ✅ Install PHP dependencies (`composer install --no-dev`)
3. ✅ Build frontend assets (`npm run build`)
4. ✅ Salin semua file yang diperlukan ke folder `deploy_package/`
5. ✅ Buat helper scripts PHP untuk setup di hosting
6. ✅ Bersihkan file yang tidak perlu (Docker, tests, dll.)
7. ✅ Buat file ZIP siap upload

Hasil: file `stim_ykpn_edu_deploy_YYYYMMDD_HHMMSS.zip`

---

#### 📤 Step 3: Upload ke cPanel

1. **Buka File Manager** di cPanel
2. **Tentukan struktur folder** (pilih salah satu):

##### Opsi A: Project di luar `public_html` (✅ RECOMMENDED)

Struktur yang paling aman dan proper:

```
/home/cpanelusername/
├── stim_ykpn_edu/          ← Extract ZIP di sini
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── public/             ← Isi folder ini yang ditaruh ke public_html
│   │   ├── build/
│   │   ├── index.php       ← EDIT path autoload & bootstrap
│   │   ├── .htaccess
│   │   └── ...
│   ├── .env
│   └── artisan
│
├── public_html/            ← Domain utama mengarah ke sini
│   ├── build/              ← Copy dari stim_ykpn_edu/public/build/
│   ├── index.php           ← Copy dari stim_ykpn_edu/public/index.php (EDIT!)
│   ├── .htaccess           ← Copy dari stim_ykpn_edu/public/.htaccess
│   ├── favicon.ico
│   └── robots.txt
```

**Langkah-langkah:**

1. Upload ZIP ke `/home/cpanelusername/` (home directory, bukan di public_html)
2. **Extract** ZIP → folder `stim_ykpn_edu/` terbuat
3. **Copy isi** folder `stim_ykpn_edu/public/` ke `public_html/`
4. **EDIT `public_html/index.php`** — ubah path agar mengarah ke project:

   ```php
   // SEBELUM (baris sekitar 17-18):
   require __DIR__.'/../vendor/autoload.php';
   $app = require_once __DIR__.'/../bootstrap/app.php';

   // SESUDAH (sesuaikan path ke folder project):
   require __DIR__.'/../stim_ykpn_edu/vendor/autoload.php';
   $app = require_once __DIR__.'/../stim_ykpn_edu/bootstrap/app.php';
   ```

##### Opsi B: Menggunakan Subdomain / Addon Domain

Jika menggunakan subdomain (misal `akademik.domain.com`):

1. **Buat subdomain** di cPanel → arahkan **Document Root** ke `/home/cpanelusername/stim_ykpn_edu/public`
2. Upload & extract ZIP ke `/home/cpanelusername/stim_ykpn_edu/`
3. Tidak perlu edit `index.php` karena domain langsung mengarah ke `public/`

##### Opsi C: Semua di dalam `public_html` (⚠️ Kurang aman)

Jika terpaksa harus di dalam `public_html`:

```
/home/cpanelusername/
├── public_html/
│   ├── stim_ykpn_edu/      ← Extract ZIP di sini
│   │   ├── app/
│   │   ├── vendor/
│   │   ├── public/
│   │   │   ├── build/
│   │   │   ├── index.php
│   │   │   └── .htaccess
│   │   └── ...
│   │
│   ├── index.php            ← Copy .htaccess-root sebagai .htaccess
│   └── .htaccess            ← Redirect ke stim_ykpn_edu/public/
```

---

#### ⚙️ Step 4: Konfigurasi Environment (.env)

1. Di **File Manager**, masuk ke folder project (`stim_ykpn_edu/`)
2. **Rename** file `.env.production` menjadi `.env`
3. **Edit** file `.env` dan isi dengan data yang benar:

```env
APP_NAME="STIM YKPN EDU"
APP_ENV=production
APP_KEY=                          ← Akan di-generate di step berikutnya
APP_DEBUG=false                   ← WAJIB false di production!
APP_URL=https://domainmu.com      ← Ganti dengan domain asli

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cpanelusername_stim_ykpn    ← Sesuaikan!
DB_USERNAME=cpanelusername_dbuser       ← Sesuaikan!
DB_PASSWORD=password_yang_kuat          ← Sesuaikan!
```

> ⚠️ **PENTING:** Jangan pernah set `APP_DEBUG=true` di production! Data sensitif bisa terekspos.

---

#### 🔑 Step 5: Generate APP_KEY

Karena tidak ada akses terminal, gunakan helper PHP:

1. Buka browser: `https://domainmu.com/_generate_key.php`
2. APP_KEY akan otomatis di-generate dan disimpan ke file `.env`
3. ✅ Pastikan muncul pesan sukses
4. **🗑️ HAPUS file `_generate_key.php` dari `public/` setelah selesai!**

---

#### 🗄️ Step 6: Migrasi Database

1. **Edit token keamanan** di file `public/_migrate.php`:
   - Buka file via File Manager
   - Ganti `GANTI_DENGAN_TOKEN_RAHASIA_KAMU` dengan token rahasia kamu, misal: `secrettoken123`

2. **Jalankan migrasi pertama kali** (buka via browser):
   ```
   https://domainmu.com/_migrate.php?token=secrettoken123&fresh=1&seed=1
   ```
   
   Parameter:
   - `token=XXX` — Token keamanan (wajib)
   - `fresh=1` — Reset & buat ulang semua tabel (hanya untuk pertama kali!)
   - `seed=1` — Jalankan seeder (buat admin user default)

3. **Untuk update berikutnya** (migrasi tanpa reset data):
   ```
   https://domainmu.com/_migrate.php?token=secrettoken123
   ```

4. **🗑️ HAPUS file `_migrate.php` dari `public/` setelah selesai!**

---

#### 🔗 Step 7: Buat Storage Link

1. Buka browser: `https://domainmu.com/_storage_link.php`
2. Symlink `public/storage` → `storage/app/public` akan dibuat
3. **🗑️ HAPUS file `_storage_link.php` dari `public/` setelah selesai!**

> ℹ️ Jika symlink gagal (beberapa hosting tidak mendukung), buat folder `public/storage/` manual dan copy isi dari `storage/app/public/` ke sana setiap kali ada upload file baru.

---

#### ⚡ Step 8: Optimasi Cache

1. **Edit token keamanan** di file `public/_optimize.php` (sama seperti di _migrate.php)
2. **Jalankan optimasi** (buka via browser):
   ```
   https://domainmu.com/_optimize.php?token=secrettoken123
   ```
3. **🗑️ HAPUS file `_optimize.php` dari `public/` setelah selesai!**

---

#### ✅ Step 9: Verifikasi & Cleanup

1. **Buka website** di browser → pastikan halaman utama tampil
2. **Login admin** dengan credential default
3. **🗑️ HAPUS SEMUA file helper dari `public/`:**
   - `_generate_key.php`
   - `_migrate.php`
   - `_storage_link.php`
   - `_optimize.php`

> 🔴 **WAJIB DIHAPUS!** File-file ini adalah celah keamanan jika dibiarkan di server production.

---

#### 🔄 Update Aplikasi (Deploy Ulang)

Untuk deploy perubahan baru:

1. **Di komputer lokal:**
   ```bash
   git pull origin main
   bash deploy-shared-hosting.sh
   ```

2. **Di cPanel File Manager:**
   - Upload ZIP baru
   - Extract & **overwrite** file lama (JANGAN hapus `.env` yang sudah ada!)
   - Jika ada migration baru, gunakan `_migrate.php` lagi (tanpa `fresh`)
   - Jalankan `_optimize.php` untuk clear & rebuild cache
   - **Hapus lagi** semua file `_*.php`

3. **Yang TIDAK boleh di-overwrite saat update:**
   - File `.env` (sudah dikonfigurasi)
   - Folder `storage/app/public/` (berisi file upload user)
   - Symlink `public/storage`

---

#### 🚨 Troubleshooting Shared Hosting

| Problem | Solusi |
|---|---|
| **500 Internal Server Error** | Cek file `.env` sudah benar. Pastikan `APP_KEY` sudah ter-generate. Cek `storage/logs/laravel.log` |
| **403 Forbidden** | Pastikan permission folder `storage/` dan `bootstrap/cache/` adalah `755` atau `775` |
| **Halaman blank putih** | Set `APP_DEBUG=true` sementara untuk lihat error, lalu kembalikan ke `false` |
| **CSS/JS tidak load** | Pastikan folder `public/build/` sudah ada dan berisi file `.js` & `.css` |
| **Upload file gagal** | Pastikan `storage/app/public/` writable. Cek `upload_max_filesize` di `.htaccess` |
| **Symlink gagal** | Buat folder `public/storage/` manual, copy isi dari `storage/app/public/` |
| **Migration error** | Pastikan database credentials di `.env` benar. Cek user punya ALL PRIVILEGES |
| **"Class not found" error** | Folder `vendor/` mungkin corrupt. Upload ulang dari ZIP |
| **Mixed content warning** | Pastikan `APP_URL` menggunakan `https://`. Cek `.htaccess` force HTTPS |

---

#### 📋 Checklist Deploy Shared Hosting

Gunakan checklist ini untuk memastikan tidak ada yang terlewat:

- [ ] ✅ Database MySQL sudah dibuat di cPanel
- [ ] ✅ PHP version ≥ 8.1 di cPanel
- [ ] ✅ Ekstensi PHP yang diperlukan sudah aktif
- [ ] ✅ `deploy-shared-hosting.sh` sudah dijalankan di lokal
- [ ] ✅ ZIP sudah diupload & di-extract di cPanel
- [ ] ✅ `index.php` sudah diedit (jika pakai Opsi A)
- [ ] ✅ `.env.production` sudah di-rename jadi `.env` dan diedit
- [ ] ✅ APP_KEY sudah di-generate
- [ ] ✅ Database sudah di-migrate & seed
- [ ] ✅ Storage link sudah dibuat
- [ ] ✅ Cache sudah di-optimize
- [ ] ✅ Website bisa diakses dan login berhasil
- [ ] ✅ **Semua file `_*.php` sudah DIHAPUS dari `public/`**

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
├── deploy.sh                   # Deploy script (VPS dengan SSH)
├── deploy-shared-hosting.sh    # Deploy script (Shared Hosting cPanel)
├── .dockerignore               # Docker build exclusions
└── README.md                   # Dokumentasi ini
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
