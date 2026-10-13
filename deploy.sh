#!/usr/bin/env bash
# ==============================================================================
# Modern Jewellery House - Automated Production Deployment Script
# ==============================================================================
set -e

echo "🚀 Starting Modern Jewellery House production deployment..."

# Put application into maintenance mode
php artisan down --render="errors.500" --retry=60 || true

# 1. Pull latest code from main
echo "📥 Pulling latest codebase..."
git pull origin main

# 2. Install/Update Composer Dependencies (No Dev, Optimized Autoloader)
echo "📦 Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 3. Compile Production Front-end Assets
echo "🎨 Building frontend production assets with Vite..."
if command -v npm &> /dev/null; then
    npm ci --prefer-offline || npm install
    npm run build
else
    echo "⚠️ npm not found on server. Ensure public/build assets were generated or pre-built."
fi

# 4. Run Database Migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 5. Link Public Storage
echo "🔗 Ensuring storage symlink exists..."
php artisan storage:link || true

# 6. Optimize Caches for High Performance
echo "⚡ Warming up application caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 7. Restart Queue Workers
echo "🔄 Restarting queue workers..."
php artisan queue:restart || true

# Bring application back up
php artisan up

echo "✅ Modern Jewellery House deployment completed successfully!"
