#!/bin/bash
# Script setup di server setelah upload
# Jalankan di server: bash setup-server.sh

echo "🖥️  Setup Project di Server"
echo "======================================"

# 1. Setup permissions
echo "🔐 Setting up permissions..."
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
chmod -R 777 storage/app

# 2. Create directories if not exist
echo "📁 Creating directories..."
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/uploads

# 3. Setup .env
echo "⚙️  Setting up .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env created from .env.example"
    echo "⚠️  EDIT .env dengan database credentials Anda!"
else
    echo "✅ .env sudah ada"
fi

# 4. Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# 5. Generate key
echo "🔑 Generating application key..."
php artisan key:generate --force

# 6. Database setup
echo "🗄️  Setup database..."
read -p "Jalankan migration? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    read -p "Jalankan seeding? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        php artisan db:seed --force
    fi
fi

# 7. Optimization
echo "⚡ Optimizing application..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Report
echo ""
echo "✅ Setup selesai!"
echo "======================================"
echo "📊 Disk usage:"
df -h | grep -E "^/dev/|^Filesystem"
echo ""
echo "💾 Project size:"
du -sh .
echo ""
echo "🎯 Next steps:"
echo "1. Setup Nginx configuration"
echo "2. Setup SSL certificate (Let's Encrypt)"
echo "3. Configure cron jobs"
echo "4. Test aplikasi di browser"
