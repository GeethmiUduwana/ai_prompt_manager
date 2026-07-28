#!/usr/bin/env bash
set -euo pipefail

export PATH="/tmp:$PATH"

if ! command -v composer >/dev/null 2>&1; then
  echo "Composer not found. Installing Composer..."
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/tmp --filename=composer
fi

composer --version

if [ ! -f /tmp/database.sqlite ]; then
  touch /tmp/database.sqlite
fi

npm install
npm run production
composer install --no-dev --optimize-autoloader --no-interaction
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
