#!/usr/bin/env bash
set -e

echo "🚀 Starting MeriGarage Build Process..."

# Install composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Create storage directories if they don't exist
echo "📁 Setting up storage directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "🔒 Setting permissions..."
chmod -R 775 storage bootstrap/cache

# Clear any existing cache
echo "🧹 Clearing cache..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

# Run migrations
echo "💾 Running database migrations..."
php artisan migrate --force --no-interaction

# Cache configuration for better performance
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completed successfully!"
