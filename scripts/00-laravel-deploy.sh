#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Clearing existing config caches"
php artisan config:clear

echo "Clearing existing route caches"
php artisan route:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running in-development migrations"
php artisan migrate --force

#echo "Running npm build..."
#npm run build --prefix /var/www/html

#echo "Running migrations..."
#php artisan migrate --force
