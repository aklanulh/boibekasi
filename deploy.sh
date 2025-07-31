#!/bin/bash

# Railway deployment script for Laravel BOI Bekasi

echo "🚀 Starting Laravel deployment..."

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Generate application key if not exists
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database if needed
echo "🌱 Seeding database..."
php artisan db:seed --force

# Clear and cache config
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link

echo "✅ Deployment completed successfully!"
