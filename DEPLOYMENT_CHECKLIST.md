# ✅ Deployment Checklist - Server 2GB

## PRE-DEPLOYMENT (Local Machine)

- [ ] **Kode siap**
    - [ ] Semua fitur sudah tested
    - [ ] Tidak ada debug code
    - [ ] Config sudah final

- [ ] **Database**
    - [ ] Migrations lengkap
    - [ ] Seeders ready
    - [ ] No hardcoded credentials

- [ ] **Assets**
    - [ ] `npm run build` dijalankan
    - [ ] Semua CSS/JS ter-compile
    - [ ] Images sudah dioptimasi

- [ ] **Clean Up**
    - [ ] `rm -rf node_modules`
    - [ ] `rm -rf .git`
    - [ ] `rm -rf tests`
    - [ ] `rm -rf .vscode .idea`
    - [ ] `composer install --no-dev --optimize-autoloader`

- [ ] **Laravel Optimize**
    - [ ] `php artisan optimize:clear`
    - [ ] `php artisan cache:clear`
    - [ ] Database ready

## UPLOAD KE SERVER

- [ ] **SSH Access Ready**
    - [ ] Host address: **\_\_\_\_**
    - [ ] Username: **\_\_\_\_**
    - [ ] Password/SSH Key: ✓
    - [ ] Port: **\_\_\_\_** (default: 22)

- [ ] **Upload Method**
    - [ ] Via Git: `git clone` atau `git pull`
    - [ ] Via SCP/SFTP: Semua file terupload
    - [ ] Verify upload: Semua file ada

## SERVER CONFIGURATION

### Folder & Permissions

- [ ] Create project directory
- [ ] `chmod -R 755` project
- [ ] `chmod -R 775 storage bootstrap/cache`
- [ ] `chmod -R 777 storage/app`

### Environment Setup

- [ ] Copy `.env.example` to `.env`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_URL=https://yourdomain.com`
- [ ] Configure Database:
    - [ ] `DB_HOST=`
    - [ ] `DB_DATABASE=`
    - [ ] `DB_USERNAME=`
    - [ ] `DB_PASSWORD=`

### Dependencies & Database

- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] `php artisan key:generate`
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --force` (jika perlu)

### Optimization

- [ ] `php artisan optimize`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`

### Web Server Configuration

- [ ] **Nginx Setup**
    - [ ] Create `/etc/nginx/sites-available/yourdomain.com`
    - [ ] Enable site: `ln -s /etc/nginx/sites-available/yourdomain.com /etc/nginx/sites-enabled/`
    - [ ] Test config: `nginx -t`
    - [ ] Reload: `systemctl reload nginx`

- [ ] **Alternatively Apache**
    - [ ] Enable mod_rewrite: `a2enmod rewrite`
    - [ ] Setup VirtualHost
    - [ ] Restart: `systemctl restart apache2`

### SSL Certificate

- [ ] Install Certbot: `apt install certbot python3-certbot-nginx`
- [ ] Generate cert: `certbot certonly --nginx -d yourdomain.com`
- [ ] Verify: `certbot renew --dry-run`
- [ ] Auto-renewal cronjob enabled

### PHP Configuration

- [ ] Check PHP version: `php -v`
- [ ] Verify extensions: `php -m`
- [ ] Check memory limit: `php -i | grep memory_limit`
- [ ] Enable OPcache in `/etc/php/x.x/fpm/php.ini`

### Database

- [ ] MySQL/MariaDB running
- [ ] Database created
- [ ] User created with proper permissions
- [ ] Test connection: `mysql -u user -p -h localhost database_name`

## POST-DEPLOYMENT

### Testing

- [ ] Site buka di browser tanpa error
- [ ] Homepage loading
- [ ] Links bekerja
- [ ] Forms bisa submit
- [ ] Database queries OK
- [ ] Storage/uploads OK
- [ ] SSL/HTTPS working

### Performance Check

- [ ] Check RAM usage: `free -h`
- [ ] Check Disk usage: `df -h`
- [ ] Check PHP-FPM: `ps aux | grep php-fpm`
- [ ] Check Nginx status: `systemctl status nginx`

### Monitoring Setup

- [ ] Laravel logs monitored: `tail -f storage/logs/laravel.log`
- [ ] Nginx logs: `tail -f /var/log/nginx/error.log`
- [ ] Cron jobs setup (schedule:run)
- [ ] Backup script setup

### Security

- [ ] No `.env` exposed
- [ ] No debug toolbar in production
- [ ] Session storage configured
- [ ] CORS configured if needed
- [ ] Rate limiting enabled
- [ ] Basic auth for admin panel

### Cron Jobs

- [ ] `* * * * * php artisan schedule:run` (every minute)
- [ ] Backup script scheduled
- [ ] Log rotation setup

### Final Checklist

- [ ] Aplikasi berjalan normal
- [ ] Performance acceptable
- [ ] Semua fitur working
- [ ] Error log monitor active
- [ ] Backup schedule active
- [ ] SSL certificate auto-renew active

---

## EMERGENCY CONTACTS

- [ ] Hosting provider support phone/email
- [ ] Database backup location
- [ ] Server SSH key backup location
- [ ] SSL certificate backup

---

## TROUBLESHOOTING QUICK LINKS

| Masalah                   | Solusi                                          |
| ------------------------- | ----------------------------------------------- |
| Permission denied         | `chmod -R 755 .` dan `chmod -R 775 storage`     |
| 502 Bad Gateway           | Restart PHP-FPM: `systemctl restart php8.x-fpm` |
| Out of memory             | Check swap, increase PHP memory_limit           |
| Database connection error | Test MySQL: `mysql -u user -p`                  |
| Slow performance          | Check OPcache, enable caching                   |
| SSL certificate error     | Renew: `certbot renew --force-renewal`          |

---

**Status: **\_\_\_\_** Date: **\_\_\_\_****
