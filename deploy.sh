#!/bin/bash
# ============================================
# 🚀 STIM YKPN EDU - Deploy Script (Hosting/VPS)
# ============================================
# Usage: bash deploy.sh [--fresh]
#   --fresh  : Reset database (migrate:fresh) — HATI-HATI DATA HILANG!
# ============================================

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

echo -e "${CYAN}"
echo "╔═══════════════════════════════════════════╗"
echo "║   🎓 STIM YKPN EDU - Deploy Script       ║"
echo "╚═══════════════════════════════════════════╝"
echo -e "${NC}"

FRESH_MODE=false
if [ "$1" == "--fresh" ]; then
    FRESH_MODE=true
    echo -e "${YELLOW}⚠️  Mode: FRESH (database akan di-reset!)${NC}"
else
    echo -e "${GREEN}📦 Mode: UPDATE (database aman)${NC}"
fi

# ============================================
# Step 1: Pull latest code
# ============================================
echo -e "\n${CYAN}[1/8] 📥 Pull kode terbaru dari git...${NC}"
git pull origin main 2>/dev/null || git pull origin master 2>/dev/null || echo -e "${YELLOW}Tidak ada remote git, skip pull.${NC}"

# ============================================
# Step 2: Install PHP dependencies
# ============================================
echo -e "\n${CYAN}[2/8] 📦 Install PHP dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

# ============================================
# Step 3: Install & build frontend
# ============================================
echo -e "\n${CYAN}[3/8] 🎨 Install & build frontend assets...${NC}"
npm ci --production=false
npm run build

# ============================================
# Step 4: Environment setup
# ============================================
echo -e "\n${CYAN}[4/8] ⚙️  Cek environment...${NC}"
if [ ! -f .env ]; then
    echo -e "${YELLOW}File .env belum ada, membuat dari .env.example...${NC}"
    cp .env.example .env
    php artisan key:generate --force
    echo -e "${RED}⚠️  PENTING: Edit file .env dengan konfigurasi database yang benar!${NC}"
    echo -e "${RED}   Jalankan deploy.sh lagi setelah edit .env${NC}"
    exit 1
fi

# ============================================
# Step 5: Database migration
# ============================================
echo -e "\n${CYAN}[5/8] 🗄️  Migrasi database...${NC}"
if [ "$FRESH_MODE" = true ]; then
    echo -e "${RED}⚠️  Menjalankan migrate:fresh (semua data akan hilang!)${NC}"
    read -p "Yakin? (y/N): " confirm
    if [ "$confirm" = "y" ] || [ "$confirm" = "Y" ]; then
        php artisan migrate:fresh --seed --force
    else
        echo -e "${YELLOW}Dibatalkan. Menjalankan migrate biasa...${NC}"
        php artisan migrate --force
    fi
else
    php artisan migrate --force
fi

# ============================================
# Step 6: Storage link
# ============================================
echo -e "\n${CYAN}[6/8] 🔗 Membuat storage link...${NC}"
php artisan storage:link 2>/dev/null || echo "Storage link sudah ada."

# ============================================
# Step 7: Cache optimization
# ============================================
echo -e "\n${CYAN}[7/8] ⚡ Optimasi cache...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# ============================================
# Step 8: Set permissions
# ============================================
echo -e "\n${CYAN}[8/8] 🔐 Set permission folder...${NC}"
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || echo -e "${YELLOW}Tidak bisa chown (bukan root), skip.${NC}"

echo -e "\n${GREEN}"
echo "╔═══════════════════════════════════════════╗"
echo "║   ✅ Deploy selesai!                      ║"
echo "╚═══════════════════════════════════════════╝"
echo -e "${NC}"
echo -e "Pastikan web server mengarah ke folder ${CYAN}public/${NC}"
echo ""
