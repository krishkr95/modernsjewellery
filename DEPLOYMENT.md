# Production Deployment Guide — Modern Jewellery House

This document provides complete instructions for deploying the **Modern Jewellery House** Laravel 12 application to production servers (VPS, AWS EC2, DigitalOcean Droplet, Linode, Ubuntu/Debian Linux, or shared cPanel).

---

## 1. Server Prerequisites

Ensure the target server meets the following requirements:

- **OS**: Ubuntu 22.04 / 24.04 LTS (recommended)
- **Web Server**: Nginx (preferred) or Apache 2.4+
- **PHP**: PHP 8.2 or PHP 8.3 with extensions:
  - `php-fpm`, `php-mysql`, `php-xml`, `php-mbstring`, `php-curl`, `php-zip`, `php-bcmath`, `php-intl`, `php-gd`
- **Database**: MySQL 8.0+ or MariaDB 10.6+
- **Node.js**: Node.js 20+ & npm (for building Vite frontend assets)
- **Composer**: Composer 2.7+
- **SSL**: Let's Encrypt / Certbot

---

## 2. Fast Deployment via Script

A production script `deploy.sh` is provided in the repository root.

```bash
chmod +x deploy.sh
./deploy.sh
```

---

## 3. Step-by-Step Manual Deployment

### Step A: Clone the Repository
```bash
cd /var/www
git clone https://github.com/krishkr95/modernsjewellery.git modernjewelleryhouse
cd modernjewelleryhouse
```

### Step B: Configure Environment Variables
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
nano .env
```

Ensure critical production values are set:
```env
APP_NAME="Modern Jewellery House"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_secure_password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=public

# Payment Gateway (Razorpay)
RAZORPAY_KEY_ID=rzp_live_your_key_id
RAZORPAY_KEY_SECRET=your_live_key_secret
RAZORPAY_WEBHOOK_SECRET=your_webhook_secret

# Mailer (SMTP / Mailgun / Postmark / SES)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your_smtp_user
MAIL_PASSWORD=your_smtp_password
MAIL_FROM_ADDRESS="orders@yourdomain.com"
MAIL_FROM_NAME="Modern Jewellery House"
```

### Step C: Install PHP Dependencies
```bash
composer install --no-dev --optimize-autoloader --no-interaction
```

### Step D: Generate App Key
```bash
php artisan key:generate --force
```

### Step E: Database Migrations & Initial Seeding
```bash
# Run migrations
php artisan migrate --force

# (Optional / First-time setup) Seed initial catalog & superadmin
php artisan db:seed --force
```

> **Default Seeded Super Admin Credentials:**
> - Email: `admin@modernjewelleryhouse.com`
> - Password: `Secret@12345`
> *(Change password immediately in the admin panel upon deployment)*

### Step F: Build Frontend Assets
```bash
npm ci
npm run build
```

### Step G: Create Public Storage Symlink
```bash
php artisan storage:link
```

### Step H: Directory Permissions
Ensure Nginx / Apache user (`www-data`) owns writable directories:
```bash
sudo chown -R www-data:www-data /var/www/modernjewelleryhouse
sudo chmod -R 775 /var/www/modernjewelleryhouse/storage
sudo chmod -R 775 /var/www/modernjewelleryhouse/bootstrap/cache
```

### Step I: Production Cache Warming
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 4. Nginx Server Configuration

Create `/etc/nginx/sites-available/modernjewelleryhouse.conf`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;

    root /var/www/modernjewelleryhouse/public;
    index index.php index.html;

    # SSL Certificate paths (Certbot will manage these)
    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

    charset utf-8;
    client_max_body_size 64M;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    # Gzip Compression
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript image/svg+xml;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Static asset caching
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|webp|svg|mp4|woff|woff2|ttf)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
        access_log off;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; # Adjust PHP version if needed
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site & test syntax:
```bash
sudo ln -s /etc/nginx/sites-available/modernjewelleryhouse.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## 5. Background Jobs & Cron Configuration

### Laravel Scheduler (Cron)
Add the following line to `crontab -e`:
```bash
* * * * * cd /var/www/modernjewelleryhouse && php artisan schedule:run >> /dev/null 2>&1
```

### Queue Worker (Supervisor)
Create `/etc/supervisor/conf.d/mjh-worker.conf`:
```ini
[program:mjh-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/modernjewelleryhouse/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/modernjewelleryhouse/storage/logs/worker.log
stopwaitsecs=3600
```

Start supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start mjh-worker:*
```
