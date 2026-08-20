#!/bin/sh
set -e

# Cache configuration, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run database migrations automatically on start
php artisan migrate --force

# Storage link
php artisan storage:link || true

# Start Laravel built-in HTTP server
exec php artisan serve --host=0.0.0.0 --port=8000
