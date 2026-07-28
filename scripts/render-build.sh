#!/usr/bin/env bash
set -e

export PATH="/tmp:/usr/local/bin:/usr/bin:/bin:$PATH"

PHP_BIN=""
for candidate in php /usr/bin/php /usr/local/bin/php; do
  if [ -x "$candidate" ]; then
    PHP_BIN="$candidate"
    break
  fi
done

if [ -z "$PHP_BIN" ]; then
  echo "PHP binary not found in the build environment" >&2
  exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
  echo "Composer not found. Installing Composer..."
  curl -sS https://getcomposer.org/installer | "$PHP_BIN" -- --install-dir=/tmp --filename=composer
fi

if [ ! -f /tmp/database.sqlite ]; then
  touch /tmp/database.sqlite
fi

composer install --no-dev --optimize-autoloader --no-interaction
"$PHP_BIN" artisan config:cache
"$PHP_BIN" artisan route:cache
"$PHP_BIN" artisan view:cache
