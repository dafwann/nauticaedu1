#!/bin/bash

# Install PHP dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node dependencies
npm install

# Build frontend
npm run build

# Run migrations (optional) – aktifkan jika perlu
# php artisan migrate --force

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
