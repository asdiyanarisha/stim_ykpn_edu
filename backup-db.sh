#!/bin/bash
# ============================================================
# Laravel Database Backup Script
# ============================================================
# Membaca konfigurasi database dari file .env Laravel
# dan melakukan backup menggunakan mysqldump.
#
# Penggunaan:
#   ./backup-db.sh                  # backup dengan konfigurasi default
#   ./backup-db.sh --dir /path/to   # custom direktori backup
#   ./backup-db.sh --keep 14        # simpan backup 14 hari terakhir
#   ./backup-db.sh --no-compress    # tanpa kompresi gzip
# ============================================================

set -euo pipefail

# ── Warna untuk output ──────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# ── Konfigurasi default ─────────────────────────────────────
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="${SCRIPT_DIR}/.env"
BACKUP_DIR="${SCRIPT_DIR}/storage/backups/database"
RETENTION_DAYS=7
COMPRESS=true
TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")

# ── Parse argumen ───────────────────────────────────────────
while [[ $# -gt 0 ]]; do
    case $1 in
        --dir)
            BACKUP_DIR="$2"
            shift 2
            ;;
        --keep)
            RETENTION_DAYS="$2"
            shift 2
            ;;
        --no-compress)
            COMPRESS=false
            shift
            ;;
        --env)
            ENV_FILE="$2"
            shift 2
            ;;
        --help|-h)
            echo ""
            echo -e "${CYAN}Laravel Database Backup Script${NC}"
            echo ""
            echo "Penggunaan:"
            echo "  ./backup-db.sh [opsi]"
            echo ""
            echo "Opsi:"
            echo "  --dir <path>      Direktori untuk menyimpan backup (default: storage/backups/database)"
            echo "  --keep <hari>     Jumlah hari retensi backup (default: 7)"
            echo "  --no-compress     Tidak mengkompresi file backup"
            echo "  --env <path>      Path ke file .env (default: .env di direktori script)"
            echo "  --help, -h        Tampilkan bantuan ini"
            echo ""
            exit 0
            ;;
        *)
            echo -e "${RED}[ERROR] Argumen tidak dikenal: $1${NC}"
            exit 1
            ;;
    esac
done

# ── Fungsi utilitas ─────────────────────────────────────────
log_info()    { echo -e "${GREEN}[INFO]${NC}  $(date '+%H:%M:%S') $1"; }
log_warn()    { echo -e "${YELLOW}[WARN]${NC}  $(date '+%H:%M:%S') $1"; }
log_error()   { echo -e "${RED}[ERROR]${NC} $(date '+%H:%M:%S') $1"; }
log_step()    { echo -e "${CYAN}[STEP]${NC}  $(date '+%H:%M:%S') $1"; }

# ── Fungsi untuk membaca nilai dari .env ────────────────────
get_env_value() {
    local key="$1"
    local default="${2:-}"

    if [[ ! -f "$ENV_FILE" ]]; then
        echo "$default"
        return
    fi

    # Baca value dari .env, handle kasus dengan/tanpa quotes
    local value
    value=$(grep -E "^${key}=" "$ENV_FILE" 2>/dev/null | head -n1 | cut -d'=' -f2- | sed -e 's/^"//' -e 's/"$//' -e "s/^'//" -e "s/'$//" | xargs)

    if [[ -z "$value" ]]; then
        echo "$default"
    else
        echo "$value"
    fi
}

# ── Header ──────────────────────────────────────────────────
echo ""
echo -e "${CYAN}╔══════════════════════════════════════════════╗${NC}"
echo -e "${CYAN}║     Laravel Database Backup Script           ║${NC}"
echo -e "${CYAN}╚══════════════════════════════════════════════╝${NC}"
echo ""

# ── Cek file .env ───────────────────────────────────────────
log_step "Membaca konfigurasi dari: ${ENV_FILE}"

if [[ ! -f "$ENV_FILE" ]]; then
    log_error "File .env tidak ditemukan di: ${ENV_FILE}"
    log_error "Pastikan script dijalankan dari direktori project Laravel"
    exit 1
fi

# ── Baca konfigurasi database dari .env ─────────────────────
DB_CONNECTION=$(get_env_value "DB_CONNECTION" "mysql")
DB_HOST=$(get_env_value "DB_HOST" "127.0.0.1")
DB_PORT=$(get_env_value "DB_PORT" "3306")
DB_DATABASE=$(get_env_value "DB_DATABASE" "")
DB_USERNAME=$(get_env_value "DB_USERNAME" "root")
DB_PASSWORD=$(get_env_value "DB_PASSWORD" "")

# ── Validasi ────────────────────────────────────────────────
if [[ -z "$DB_DATABASE" ]]; then
    log_error "DB_DATABASE tidak ditemukan di .env"
    exit 1
fi

if [[ "$DB_CONNECTION" != "mysql" && "$DB_CONNECTION" != "mariadb" ]]; then
    log_error "Script ini hanya mendukung MySQL/MariaDB. Koneksi saat ini: ${DB_CONNECTION}"
    exit 1
fi

# Cek apakah mysqldump tersedia
if ! command -v mysqldump &> /dev/null; then
    log_error "mysqldump tidak ditemukan. Silakan install mysql-client terlebih dahulu."
    log_error "  Ubuntu/Debian: sudo apt install mysql-client"
    log_error "  CentOS/RHEL:   sudo yum install mysql"
    exit 1
fi

log_info "Database : ${DB_DATABASE}"
log_info "Host     : ${DB_HOST}:${DB_PORT}"
log_info "User     : ${DB_USERNAME}"
log_info "Kompresi : $([ "$COMPRESS" = true ] && echo 'Ya (gzip)' || echo 'Tidak')"
log_info "Retensi  : ${RETENTION_DAYS} hari"

# ── Buat direktori backup ──────────────────────────────────
mkdir -p "$BACKUP_DIR"
log_step "Direktori backup: ${BACKUP_DIR}"

# ── Nama file backup ───────────────────────────────────────
BACKUP_FILENAME="${DB_DATABASE}_${TIMESTAMP}.sql"
BACKUP_FILEPATH="${BACKUP_DIR}/${BACKUP_FILENAME}"

# ── Jalankan mysqldump ──────────────────────────────────────
log_step "Memulai backup database '${DB_DATABASE}'..."

MYSQLDUMP_ARGS=(
    --host="$DB_HOST"
    --port="$DB_PORT"
    --user="$DB_USERNAME"
    --single-transaction
    --routines
    --triggers
    --events
    --quick
    --lock-tables=false
    --set-gtid-purged=OFF
    "$DB_DATABASE"
)

# Tambahkan password jika ada
if [[ -n "$DB_PASSWORD" ]]; then
    MYSQLDUMP_ARGS=(--password="$DB_PASSWORD" "${MYSQLDUMP_ARGS[@]}")
fi

# Jalankan backup
SECONDS=0
if mysqldump "${MYSQLDUMP_ARGS[@]}" > "$BACKUP_FILEPATH" 2>/tmp/backup_error.log; then
    DURATION=$SECONDS

    if [[ "$COMPRESS" = true ]]; then
        log_step "Mengkompresi file backup..."
        gzip "$BACKUP_FILEPATH"
        BACKUP_FILEPATH="${BACKUP_FILEPATH}.gz"
        BACKUP_FILENAME="${BACKUP_FILENAME}.gz"
    fi

    # Hitung ukuran file
    FILE_SIZE=$(du -h "$BACKUP_FILEPATH" | cut -f1)

    echo ""
    log_info "✅ Backup berhasil!"
    log_info "File     : ${BACKUP_FILEPATH}"
    log_info "Ukuran   : ${FILE_SIZE}"
    log_info "Durasi   : ${DURATION} detik"
else
    log_error "❌ Backup gagal!"
    if [[ -f /tmp/backup_error.log ]]; then
        log_error "Detail error:"
        cat /tmp/backup_error.log
    fi
    # Hapus file backup yang gagal
    rm -f "$BACKUP_FILEPATH"
    exit 1
fi

# ── Hapus backup lama (retensi) ─────────────────────────────
if [[ "$RETENTION_DAYS" -gt 0 ]]; then
    log_step "Menghapus backup yang lebih dari ${RETENTION_DAYS} hari..."
    DELETED_COUNT=$(find "$BACKUP_DIR" -name "${DB_DATABASE}_*.sql*" -type f -mtime +"$RETENTION_DAYS" -print -delete 2>/dev/null | wc -l)
    if [[ "$DELETED_COUNT" -gt 0 ]]; then
        log_info "Dihapus: ${DELETED_COUNT} file backup lama"
    else
        log_info "Tidak ada backup lama yang perlu dihapus"
    fi
fi

# ── Tampilkan daftar backup yang ada ────────────────────────
echo ""
log_step "Daftar backup yang tersimpan:"
echo -e "${CYAN}──────────────────────────────────────────────${NC}"
printf "%-40s %10s %s\n" "FILE" "UKURAN" "TANGGAL"
echo -e "${CYAN}──────────────────────────────────────────────${NC}"

find "$BACKUP_DIR" -name "${DB_DATABASE}_*.sql*" -type f -printf "%f %s %TY-%Tm-%Td %TH:%TM\n" 2>/dev/null | \
    sort -r | head -10 | \
    while read -r fname fsize fdate ftime; do
        # Convert bytes to human readable
        if [[ "$fsize" -gt 1073741824 ]]; then
            hsize="$(echo "scale=1; $fsize/1073741824" | bc)G"
        elif [[ "$fsize" -gt 1048576 ]]; then
            hsize="$(echo "scale=1; $fsize/1048576" | bc)M"
        elif [[ "$fsize" -gt 1024 ]]; then
            hsize="$(echo "scale=1; $fsize/1024" | bc)K"
        else
            hsize="${fsize}B"
        fi
        printf "%-40s %10s %s %s\n" "$fname" "$hsize" "$fdate" "$ftime"
    done

echo -e "${CYAN}──────────────────────────────────────────────${NC}"
echo ""
log_info "Selesai! 🎉"
echo ""
