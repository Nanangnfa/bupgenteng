# 🚀 Panduan Deployment ke Server

## 📋 Persiapan di Local (Sebelum Upload)

### 1. Bersihkan Project

```bash
# Hapus file tidak perlu
rm -rf node_modules
rm -rf .git
rm -rf tests
rm -rf storage/logs/*
rm -rf storage/framework/cache/*
rm -rf .vscode .idea .fleet

# Bersihkan Laravel
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
```

### 2. Install Dependencies Production-Only

```bash
# Install PHP dependencies tanpa dev packages
composer install --no-dev --optimize-autoloader --no-progress

# Build frontend assets
npm run build

# Hapus npm dependencies (sudah tidak perlu)
rm -rf node_modules
rm package-lock.json
```

### 3. Build Laravel untuk Production

```bash
# Generate APP_KEY jika belum
php artisan key:generate

# Optimize aplikasi
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. File Structure yang Akan Di-Upload

```
bupgenteng/
├── app/                          (~2MB)
├── bootstrap/                    (~0.5MB)
├── config/                       (~0.5MB)
├── database/
│   ├── migrations/              (~0.5MB)
│   └── seeders/                 (~0.2MB)
├── public/                       (~100-300MB - terbesar)
│   ├── build/                   (built assets)
│   ├── template-admin/
│   ├── template-landing/
│   └── index.php
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                   (~5MB)
├── routes/                       (~0.5MB)
├── storage/                      (empty dir, ~10MB saat runtime)
├── vendor/                       (~400-500MB - terbesar)
├── .env                          (di-create di server)
├── .env.example
├── artisan
├── composer.json
└── composer.lock
```

---

## 🖥️ Setup Server 2GB

### 1. SSH ke Server & Buat Directory

```bash
mkdir -p /home/username/domains/yourdomain.com
cd /home/username/domains/yourdomain.com

# Set permission
chmod 755 .
```

### 2. Upload Project

```bash
# Dari local, gunakan SCP atau SFTP
scp -r bupgenteng/* username@server:/home/username/domains/yourdomain.com/

# Atau gunakan git clone
git clone https://github.com/Nanangnfa/bupgenteng.git .
```

### 3. Setup Storage & Permissions

```bash
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/uploads

chmod -R 775 storage bootstrap/cache
chmod -R 777 storage/app/uploads
```

### 4. Setup Environment

```bash
cp .env.example .env

# Edit .env dengan production settings
nano .env
```

**`.env` Production Settings:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=bupgenteng
DB_USERNAME=root
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Disable Laravel Telescope & Debugbar di production
```

### 5. Install Composer & Database

```bash
# Install PHP dependencies (production only)
composer install --no-dev --optimize-autoloader

# Generate key
php artisan key:generate

# Database migration & seeding
php artisan migrate --force
php artisan db:seed --force

# Cache optimization
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ⚡ Optimasi Server 2GB untuk Performance

### 1. PHP Configuration (`/etc/php/8.2/fpm/php.ini`)

```ini
# Memory limit untuk request
memory_limit = 256M

# Maximum file upload
post_max_size = 50M
upload_max_filesize = 50M

# Execution time
max_execution_time = 30

# OPcache (SANGAT PENTING!)
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.revalidate_freq=0

# Session
session.gc_maxlifetime = 86400
```

### 2. Nginx Configuration (Web Server)

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /home/username/domains/yourdomain.com/public;
    index index.php index.html index.htm;

    # Gzip compression (reduce bandwidth)
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
    gzip_min_length 1000;

    # Cache static assets (1 tahun)
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # Deny access to sensitive files
    location ~ /\. {
        deny all;
    }

    location ~ /\.env {
        deny all;
    }

    # Laravel routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_buffers 8 16k;
        fastcgi_buffer_size 32k;
    }
}
```

### 3. Database Optimization (MySQL)

```sql
-- di /etc/mysql/my.cnf atau my.cnf.d/mysqld.cnf
[mysqld]
max_connections = 100
default_storage_engine = InnoDB
innodb_buffer_pool_size = 512M
innodb_log_file_size = 100M
query_cache_type = 1
query_cache_size = 64M
```

### 4. Enable Swap Memory (Jika Diperlukan)

```bash
# Cek swap yang ada
free -h

# Jika swap 0, buat swap 2GB
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile

# Permanent (di /etc/fstab)
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

---

## 🛡️ Security & Maintenance

### 1. SSL Certificate (HTTPS)

```bash
# Menggunakan Let's Encrypt (FREE)
sudo certbot certonly --nginx -d yourdomain.com
```

### 2. Daily Cron Jobs

```bash
# Edit crontab
crontab -e

# Tambahkan untuk Laravel scheduler
* * * * * cd /home/username/domains/yourdomain.com && php artisan schedule:run >> /dev/null 2>&1

# Backup database (daily at 2 AM)
0 2 * * * mysqldump -u root -p'password' bupgenteng > /home/username/backups/db_$(date +\%Y\%m\%d).sql

# Clear old logs (weekly)
0 3 * * 0 find /home/username/domains/yourdomain.com/storage/logs -name "*.log" -mtime +7 -delete
```

### 3. Monitoring Memory & Disk

```bash
# Cek penggunaan memory real-time
free -h

# Cek disk usage
df -h

# Cek top processes consuming memory
top -b -n 1 | head -20
```

---

## 📊 Estimasi Penggunaan Disk 2GB

```
/ Total              : 2GB (100%)
├── OS + PHP-FPM     : 300-400MB
├── Nginx            : 50MB
├── MySQL            : 100-200MB
├── Project Root     : 400-500MB
│   ├── vendor/      : 300-400MB ⚠️ Terbesar
│   ├── public/      : 100MB
│   └── app/         : 10MB
├── Storage/Uploads  : 200-500MB (bisa berkembang)
├── Database Files   : 200-300MB
└── Free Space       : 200-300MB (buffer)
```

**Kesimpulan:** Dengan 2GB, Anda masih punya ruang untuk ~200-300MB upload user.

---

## ⚠️ Tips Menghemat Space

1. **Kompres Public Assets**
    - Minify JS/CSS di Webpack/Vite (sudah default)
    - Compress images (gunakan TinyPNG/ImageOptim)

2. **Hapus Unused Packages**

    ```bash
    composer remove package/name
    ```

3. **External Storage**
    - Upload besar (gambar, dokumen) → Cloud Storage (Google Drive, AWS S3)
    - Database besar → Managed Database Service

4. **Regular Cleanup**

    ```bash
    # Hapus cache lama
    php artisan cache:clear
    php artisan view:clear

    # Hapus logs lama
    find storage/logs -mtime +7 -delete
    ```

---

## ✅ Monitoring Production

### 1. Error Logs

```bash
# Real-time logs
tail -f storage/logs/laravel.log

# Nginx logs
tail -f /var/log/nginx/error.log
```

### 2. Uptime Monitoring

- Gunakan free service: UptimeRobot, Pingdom, atau Uptime.com

### 3. Performance Monitoring

- New Relic (free tier)
- Datadog (free trial)
- SPM (free plan)

---

## 🔄 Update & Deployment

### Untuk Update Code:

```bash
cd /home/username/domains/yourdomain.com

# Pull latest code
git pull origin main

# Install dependencies jika ada perubahan
composer install --no-dev --optimize-autoloader

# Run migrations jika ada
php artisan migrate --force

# Clear caches
php artisan optimize:clear
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

**Dengan strategi ini, project Laravel Anda bisa berjalan stabil di server 2GB!** ✨
