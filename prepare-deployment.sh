#!/bin/bash
# Script persiapan deployment ke production
# Jalankan: bash prepare-deployment.sh

echo "🚀 Mempersiapkan project untuk deployment..."
echo "================================================"

# 1. Bersihkan file tidak perlu
echo "📁 Membersihkan file tidak perlu..."
rm -rf node_modules 2>/dev/null
rm -rf .git 2>/dev/null
rm -rf tests 2>/dev/null
rm -rf .vscode .idea .fleet 2>/dev/null
rm -f npm-debug.log yarn-error.log .editorconfig 2>/dev/null

# 2. Bersihkan Laravel cache
echo "🧹 Clearing Laravel caches..."
php artisan optimize:clear 2>/dev/null

# 3. Install production dependencies
echo "📦 Installing production dependencies..."
composer install --no-dev --optimize-autoloader --no-progress --no-suggest

# 4. Build frontend
echo "🎨 Building frontend assets..."
npm run build

# 5. Hapus node modules (sudah di-build)
echo "💾 Removing node_modules (already built)..."
rm -rf node_modules package-lock.json

# 6. Generate keys & optimize
echo "🔑 Generating keys dan optimizing application..."
php artisan key:generate --force 2>/dev/null
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Report
echo ""
echo "✅ Persiapan selesai!"
echo "================================================"
echo "📊 Ukuran project sekarang:"
du -sh .
echo ""
echo "Folder terbesar:"
du -sh */ | sort -rh | head -5
echo ""
echo "🎯 Siap untuk di-upload ke server 2GB!"
echo "Gunakan SCP atau SFTP untuk upload ke server."
