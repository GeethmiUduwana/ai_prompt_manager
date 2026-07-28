#!/usr/bin/env bash
set -e

export PATH="/tmp:$PATH"

if ! command -v composer >/dev/null 2>&1; then
  echo "Composer not found. Installing Composer..."
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/tmp --filename=composer
fi

if [ ! -f /tmp/database.sqlite ]; then
  touch /tmp/database.sqlite
fi

composer install --no-dev --optimize-autoloader --no-interaction
php artisan config:cache
php artisan route:cache
php artisan view:cache
