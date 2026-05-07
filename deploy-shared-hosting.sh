#!/bin/bash
# ================================================================
# 🚀 STIM YKPN EDU - Deploy Script untuk Shared Hosting (cPanel)
# ================================================================
# Script ini mempersiapkan file deploy di LOCAL MACHINE kamu,
# lalu menghasilkan file ZIP yang siap diupload ke cPanel.
#
# Karena shared hosting cPanel TIDAK memiliki:
#   - Composer (PHP package manager)
#   - NPM/Node.js (JavaScript package manager)
#   - SSH/Terminal access
#
# Maka semua proses build dilakukan di sini (lokal), dan hasilnya
# di-zip untuk diupload via File Manager cPanel.
#
# Usage:
#   bash deploy-shared-hosting.sh
#   bash deploy-shared-hosting.sh --fresh   (include seeder untuk pertama kali)
#
# Prerequisite di komputer lokal:
#   - PHP >= 8.1
#   - Composer
#   - Node.js >= 18 & NPM
# ================================================================

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

echo -e "${CYAN}"
echo "╔══════════════════════════════════════════════════════════╗"
echo "║   🎓 STIM YKPN EDU - Deploy Shared Hosting (cPanel)    ║"
echo "║   📦 Build lokal → ZIP → Upload via File Manager       ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo -e "${NC}"

# ================================================================
# Konfigurasi
# ================================================================
DEPLOY_DIR="deploy_package"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
ZIP_NAME="stim_ykpn_edu_deploy_${TIMESTAMP}.zip"

INCLUDE_FRESH=false
if [ "$1" = "--fresh" ]; then
    INCLUDE_FRESH=true
    echo -e "${YELLOW}⚠️  Mode: FRESH DEPLOY (pertama kali, include seeder)${NC}"
else
    echo -e "${GREEN}📦 Mode: UPDATE (upload perubahan terbaru)${NC}"
fi

# ================================================================
# Step 1: Cek prerequisite lokal
# ================================================================
echo -e "\n${CYAN}[1/7] 🔍 Mengecek prerequisite lokal...${NC}"

check_command() {
    if ! command -v $1 > /dev/null 2>&1; then
        echo -e "${RED}❌ $1 tidak ditemukan! Install dulu: $2${NC}"
        exit 1
    else
        echo -e "  ${GREEN}✓${NC} $1 tersedia: $($1 --version 2>&1 | head -1)"
    fi
}

check_command php "https://www.php.net/downloads"
check_command composer "https://getcomposer.org/download/"
check_command node "https://nodejs.org/"
check_command npm "https://nodejs.org/"
check_command zip "sudo apt install zip"

# ================================================================
# Step 2: Install PHP dependencies (production only)
# ================================================================
echo -e "\n${CYAN}[2/7] 📦 Install PHP dependencies (production)...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction --quiet
echo -e "  ${GREEN}✓${NC} Composer dependencies installed"

# ================================================================
# Step 3: Install & build frontend assets
# ================================================================
echo -e "\n${CYAN}[3/7] 🎨 Build frontend assets (Vite + Vue)...${NC}"
npm ci --silent 2>/dev/null || npm install --silent
npm run build
echo -e "  ${GREEN}✓${NC} Frontend assets built → public/build/"

# ================================================================
# Step 4: Bersihkan deploy folder lama
# ================================================================
echo -e "\n${CYAN}[4/7] 🧹 Menyiapkan folder deploy...${NC}"
rm -rf "${DEPLOY_DIR}"
mkdir -p "${DEPLOY_DIR}"
echo -e "  ${GREEN}✓${NC} Folder ${DEPLOY_DIR}/ siap"

# ================================================================
# Step 5: Copy file yang diperlukan
# ================================================================
echo -e "\n${CYAN}[5/7] 📋 Menyalin file project...${NC}"

# ---- Direktori utama ----
echo -e "  Copying app/..."
cp -r app "${DEPLOY_DIR}/"

echo -e "  Copying bootstrap/..."
cp -r bootstrap "${DEPLOY_DIR}/"

echo -e "  Copying config/..."
cp -r config "${DEPLOY_DIR}/"

echo -e "  Copying database/..."
cp -r database "${DEPLOY_DIR}/"

echo -e "  Copying public/..."
cp -r public "${DEPLOY_DIR}/"

echo -e "  Copying resources/..."
# Hanya copy views (blade), bukan js/css source karena sudah di-build
mkdir -p "${DEPLOY_DIR}/resources"
cp -r resources/views "${DEPLOY_DIR}/resources/" 2>/dev/null || true
# Copy lang jika ada
cp -r resources/lang "${DEPLOY_DIR}/resources/" 2>/dev/null || true

echo -e "  Copying routes/..."
cp -r routes "${DEPLOY_DIR}/"

echo -e "  Copying storage/..."
cp -r storage "${DEPLOY_DIR}/"

echo -e "  Copying vendor/..."
cp -r vendor "${DEPLOY_DIR}/"

# ---- File root yang diperlukan ----
echo -e "  Copying root files..."
cp artisan "${DEPLOY_DIR}/"
cp composer.json "${DEPLOY_DIR}/"
cp composer.lock "${DEPLOY_DIR}/"

# Copy .env.example sebagai referensi
cp .env.example "${DEPLOY_DIR}/.env.example"

# Copy .htaccess root jika ada
[ -f .htaccess ] && cp .htaccess "${DEPLOY_DIR}/"

# ================================================================
# Step 5b: Buat .htaccess untuk root domain (redirect ke public/)
# ================================================================
echo -e "  Creating root .htaccess..."

# .htaccess di root project (jika taruh di luar public_html)
cat > "${DEPLOY_DIR}/.htaccess-root" << 'HTACCESS_ROOT'
# ============================================
# .htaccess — Redirect semua ke folder public/
# ============================================
# GUNAKAN FILE INI jika project ditaruh di LUAR public_html
# dan domain diarahkan ke folder project via cPanel
# ============================================

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
HTACCESS_ROOT

# .htaccess khusus jika project langsung di public_html
cat > "${DEPLOY_DIR}/.htaccess-public-html" << 'HTACCESS_PH'
# ============================================
# .htaccess — Untuk di dalam public_html
# ============================================
# GUNAKAN FILE INI jika isi folder public/ dicopy langsung
# ke dalam public_html, dan sisa project ditaruh di level atas
# ============================================

<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Increase upload limits
php_value upload_max_filesize 10M
php_value post_max_size 12M
php_value max_execution_time 120
php_value max_input_time 120
HTACCESS_PH

# ================================================================
# Step 5c: Buat file .env.production sebagai template
# ================================================================
echo -e "  Creating .env.production template..."
cat > "${DEPLOY_DIR}/.env.production" << 'ENV_PROD'
# ============================================
# 🔧 STIM YKPN EDU — Environment Production
# ============================================
# EDIT sesuai dengan konfigurasi hosting kamu!
# Setelah diedit, RENAME file ini menjadi .env
# ============================================

APP_NAME="STIM YKPN EDU"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://namadomainmu.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# ============================================
# Database — Sesuaikan dengan cPanel MySQL
# ============================================
# Buka cPanel → MySQL Databases untuk membuat database & user
# Format username cPanel: cpanelusername_dbuser
# Format database cPanel: cpanelusername_dbname
# ============================================
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cpanelusername_stim_ykpn
DB_USERNAME=cpanelusername_dbuser
DB_PASSWORD=password_database_kamu

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# ============================================
# Mail — Opsional, sesuaikan jika perlu
# ============================================
MAIL_MAILER=smtp
MAIL_HOST=mail.namadomainmu.com
MAIL_PORT=465
MAIL_USERNAME=info@namadomainmu.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@namadomainmu.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
ENV_PROD

# ================================================================
# Step 5d: Buat script post-upload untuk generate key & migrate
# ================================================================
echo -e "  Creating post-upload helper scripts..."

# Script PHP untuk generate APP_KEY (dijalankan via browser 1x saja)
cat > "${DEPLOY_DIR}/public/_generate_key.php" << 'GENKEY'
<?php
/**
 * 🔑 Generate APP_KEY — Jalankan 1x via browser
 * URL: https://domainmu.com/_generate_key.php
 * 
 * HAPUS FILE INI SETELAH SELESAI!
 */

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    die('❌ File .env belum ada! Rename .env.production menjadi .env terlebih dahulu.');
}

$key = 'base64:' . base64_encode(random_bytes(32));
$envContent = file_get_contents($envPath);

if (strpos($envContent, 'APP_KEY=base64:') !== false) {
    echo '✅ APP_KEY sudah ter-generate. Tidak perlu dijalankan lagi.<br>';
    echo 'APP_KEY saat ini: <code>' . htmlspecialchars(explode("\n", preg_grep('/^APP_KEY=/', explode("\n", $envContent))[array_key_first(preg_grep('/^APP_KEY=/', explode("\n", $envContent)))])[0] ?? '') . '</code>';
    echo '<br><br>⚠️ <strong>HAPUS FILE INI SEKARANG!</strong>';
    exit;
}

$envContent = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=' . $key, $envContent);
file_put_contents($envPath, $envContent);

echo '<h2>✅ APP_KEY berhasil di-generate!</h2>';
echo '<p>Key: <code>' . htmlspecialchars($key) . '</code></p>';
echo '<p style="color:red;font-weight:bold;">⚠️ HAPUS FILE INI SEKARANG dari File Manager!</p>';
?>
GENKEY

# Script PHP untuk menjalankan migration via browser
cat > "${DEPLOY_DIR}/public/_migrate.php" << 'MIGRATE'
<?php
/**
 * 🗄️ Database Migration — Jalankan via browser
 * URL: https://domainmu.com/_migrate.php
 * URL: https://domainmu.com/_migrate.php?fresh=1  (RESET semua data!)
 * URL: https://domainmu.com/_migrate.php?seed=1   (jalankan seeder)
 * 
 * HAPUS FILE INI SETELAH SELESAI!
 */

// Security: Simple token protection
$token = 'GANTI_DENGAN_TOKEN_RAHASIA_KAMU';
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    http_response_code(403);
    die('🔒 Akses ditolak. Tambahkan ?token=XXXX di URL.');
}

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '<pre style="background:#1e1e1e;color:#d4d4d4;padding:20px;border-radius:8px;font-family:monospace;">';
echo "🗄️ STIM YKPN EDU — Database Migration\n";
echo "═══════════════════════════════════════\n\n";

try {
    if (isset($_GET['fresh'])) {
        echo "⚠️  Mode: migrate:fresh (RESET SEMUA DATA!)\n\n";
        Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
    } else {
        echo "📦 Mode: migrate (update)\n\n";
        Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }
    echo Illuminate\Support\Facades\Artisan::output();

    if (isset($_GET['seed'])) {
        echo "\n🌱 Menjalankan seeder...\n\n";
        Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        echo Illuminate\Support\Facades\Artisan::output();
    }

    echo "\n✅ Migrasi selesai!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
}

echo '</pre>';
echo '<br><p style="color:red;font-weight:bold;">⚠️ HAPUS FILE INI SETELAH SELESAI!</p>';
?>
MIGRATE

# Script PHP untuk membuat storage symlink
cat > "${DEPLOY_DIR}/public/_storage_link.php" << 'STORLINK'
<?php
/**
 * 🔗 Storage Link — Jalankan via browser 1x saja
 * URL: https://domainmu.com/_storage_link.php
 * 
 * Membuat symlink: public/storage → storage/app/public
 * HAPUS FILE INI SETELAH SELESAI!
 */

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (is_link($link) || is_dir($link)) {
    echo '✅ Storage link sudah ada.<br>';
    echo 'Link: <code>' . $link . '</code><br>';
    echo 'Target: <code>' . readlink($link) . '</code><br>';
    echo '<br>⚠️ <strong>HAPUS FILE INI SEKARANG!</strong>';
    exit;
}

if (!file_exists($target)) {
    mkdir($target, 0755, true);
}

if (symlink($target, $link)) {
    echo '<h2>✅ Storage link berhasil dibuat!</h2>';
    echo '<p>Link: <code>' . $link . '</code></p>';
    echo '<p>Target: <code>' . $target . '</code></p>';
} else {
    echo '<h2>❌ Gagal membuat symlink!</h2>';
    echo '<p>Coba buat manual via File Manager cPanel atau hubungi hosting provider.</p>';
    echo '<p>Alternatif: Copy isi <code>storage/app/public/</code> ke <code>public/storage/</code></p>';
}

echo '<br><p style="color:red;font-weight:bold;">⚠️ HAPUS FILE INI SETELAH SELESAI!</p>';
?>
STORLINK

# Script PHP untuk cache optimization
cat > "${DEPLOY_DIR}/public/_optimize.php" << 'OPTIMIZE'
<?php
/**
 * ⚡ Optimize Cache — Jalankan via browser setelah deploy
 * URL: https://domainmu.com/_optimize.php
 * URL: https://domainmu.com/_optimize.php?clear=1  (clear cache dulu)
 * 
 * HAPUS FILE INI SETELAH SELESAI!
 */

$token = 'GANTI_DENGAN_TOKEN_RAHASIA_KAMU';
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    http_response_code(403);
    die('🔒 Akses ditolak. Tambahkan ?token=XXXX di URL.');
}

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '<pre style="background:#1e1e1e;color:#d4d4d4;padding:20px;border-radius:8px;font-family:monospace;">';
echo "⚡ STIM YKPN EDU — Cache Optimization\n";
echo "═══════════════════════════════════════\n\n";

try {
    if (isset($_GET['clear'])) {
        echo "🧹 Clearing all caches...\n\n";
        Illuminate\Support\Facades\Artisan::call('cache:clear');
        echo Illuminate\Support\Facades\Artisan::output();
        Illuminate\Support\Facades\Artisan::call('config:clear');
        echo Illuminate\Support\Facades\Artisan::output();
        Illuminate\Support\Facades\Artisan::call('route:clear');
        echo Illuminate\Support\Facades\Artisan::output();
        Illuminate\Support\Facades\Artisan::call('view:clear');
        echo Illuminate\Support\Facades\Artisan::output();
        echo "\n";
    }

    echo "📦 Caching configuration...\n";
    Illuminate\Support\Facades\Artisan::call('config:cache');
    echo Illuminate\Support\Facades\Artisan::output();

    echo "📦 Caching routes...\n";
    Illuminate\Support\Facades\Artisan::call('route:cache');
    echo Illuminate\Support\Facades\Artisan::output();

    echo "📦 Caching views...\n";
    Illuminate\Support\Facades\Artisan::call('view:cache');
    echo Illuminate\Support\Facades\Artisan::output();

    echo "\n✅ Optimasi selesai!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
}

echo '</pre>';
echo '<br><p style="color:red;font-weight:bold;">⚠️ HAPUS FILE INI SETELAH SELESAI!</p>';
?>
OPTIMIZE

echo -e "  ${GREEN}✓${NC} Semua file berhasil disalin"

# ================================================================
# Step 6: Bersihkan file yang tidak perlu dari deploy
# ================================================================
echo -e "\n${CYAN}[6/7] 🧹 Membersihkan file yang tidak diperlukan...${NC}"

# Hapus file dev/local yang tidak perlu di hosting
rm -rf "${DEPLOY_DIR}/storage/logs/"*.log 2>/dev/null
rm -rf "${DEPLOY_DIR}/storage/framework/cache/data/"* 2>/dev/null
rm -rf "${DEPLOY_DIR}/storage/framework/sessions/"* 2>/dev/null
rm -rf "${DEPLOY_DIR}/storage/framework/views/"* 2>/dev/null

# Pastikan directory structure storage ada
mkdir -p "${DEPLOY_DIR}/storage/app/public"
mkdir -p "${DEPLOY_DIR}/storage/framework/cache/data"
mkdir -p "${DEPLOY_DIR}/storage/framework/sessions"
mkdir -p "${DEPLOY_DIR}/storage/framework/views"
mkdir -p "${DEPLOY_DIR}/storage/logs"

# Buat .gitkeep di folder kosong
touch "${DEPLOY_DIR}/storage/app/public/.gitkeep"
touch "${DEPLOY_DIR}/storage/framework/cache/data/.gitkeep"
touch "${DEPLOY_DIR}/storage/framework/sessions/.gitkeep"
touch "${DEPLOY_DIR}/storage/framework/views/.gitkeep"
touch "${DEPLOY_DIR}/storage/logs/.gitkeep"

# Pastikan bootstrap/cache ada
mkdir -p "${DEPLOY_DIR}/bootstrap/cache"
touch "${DEPLOY_DIR}/bootstrap/cache/.gitkeep"

# Hapus file yang tidak perlu
rm -f "${DEPLOY_DIR}/deploy.sh"
rm -f "${DEPLOY_DIR}/deploy-shared-hosting.sh"
rm -f "${DEPLOY_DIR}/docker-compose.yml"
rm -f "${DEPLOY_DIR}/Dockerfile"
rm -f "${DEPLOY_DIR}/.dockerignore"
rm -rf "${DEPLOY_DIR}/docker"
rm -rf "${DEPLOY_DIR}/tests"
rm -f "${DEPLOY_DIR}/.editorconfig"
rm -f "${DEPLOY_DIR}/phpunit.xml"
rm -f "${DEPLOY_DIR}/postcss.config.js"
rm -f "${DEPLOY_DIR}/tailwind.config.js"
rm -f "${DEPLOY_DIR}/vite.config.js"
rm -f "${DEPLOY_DIR}/package.json"
rm -f "${DEPLOY_DIR}/package-lock.json"

echo -e "  ${GREEN}✓${NC} File yang tidak perlu sudah dihapus"

# ================================================================
# Step 7: ZIP the deploy package
# ================================================================
echo -e "\n${CYAN}[7/7] 📦 Membuat file ZIP...${NC}"

cd "${DEPLOY_DIR}"
zip -r -q "../${ZIP_NAME}" .
cd ..

ZIP_SIZE=$(du -sh "${ZIP_NAME}" | cut -f1)
echo -e "  ${GREEN}✓${NC} ZIP berhasil dibuat: ${BOLD}${ZIP_NAME}${NC} (${ZIP_SIZE})"

# ================================================================
# Selesai!
# ================================================================
echo -e "\n${GREEN}"
echo "╔══════════════════════════════════════════════════════════╗"
echo "║   ✅ Build selesai! File siap diupload ke cPanel        ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo -e "${NC}"

echo -e "${BOLD}📦 File ZIP:${NC} ${ZIP_NAME} (${ZIP_SIZE})"
echo ""
echo -e "${BOLD}📋 Langkah selanjutnya:${NC}"
echo -e "  ${CYAN}1.${NC} Upload ${ZIP_NAME} ke cPanel via File Manager"
echo -e "  ${CYAN}2.${NC} Extract di folder yang sesuai"
echo -e "  ${CYAN}3.${NC} Edit .env.production → rename jadi .env"
echo -e "  ${CYAN}4.${NC} Buka: https://domainmu.com/_generate_key.php"
echo -e "  ${CYAN}5.${NC} Buka: https://domainmu.com/_migrate.php?token=XXX&seed=1"
echo -e "  ${CYAN}6.${NC} Buka: https://domainmu.com/_storage_link.php"
echo -e "  ${CYAN}7.${NC} Buka: https://domainmu.com/_optimize.php?token=XXX"
echo -e "  ${CYAN}8.${NC} ${RED}HAPUS semua file _*.php dari public/ !!!${NC}"
echo ""
echo -e "${YELLOW}📖 Baca README.md bagian 'Deploy ke Shared Hosting' untuk detail lengkap.${NC}"
echo ""
