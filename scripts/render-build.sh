#!/usr/bin/env bash
set -e

export PATH="/tmp:/usr/local/bin:/usr/bin:/bin:$PATH"
export DEBIAN_FRONTEND=noninteractive

PHP_BIN=""
for candidate in php /usr/bin/php /usr/local/bin/php; do
  if [ -x "$candidate" ]; then
    PHP_BIN="$candidate"
    break
  fi
done

if [ -z "$PHP_BIN" ]; then
  echo "PHP binary not found. Installing PHP runtime..."
  apt-get update
  apt-get install -y --no-install-recommends php-cli php-curl php-xml php-mbstring php-sqlite3 php-zip unzip git curl
  for candidate in php /usr/bin/php /usr/local/bin/php; do
    if [ -x "$candidate" ]; then
      PHP_BIN="$candidate"
      break
    fi
  done
fi

if [ -z "$PHP_BIN" ]; then
  echo "PHP binary still not available after installation" >&2
  exit 1
fi

if ! command -v node >/dev/null 2>&1 || ! command -v npm >/dev/null 2>&1; then
  echo "Node.js not found. Installing Node.js..."
  apt-get install -y --no-install-recommends nodejs npm
fi

if ! command -v composer >/dev/null 2>&1; then
  echo "Composer not found. Installing Composer..."
  curl -sS https://getcomposer.org/installer | "$PHP_BIN" -- --install-dir=/tmp --filename=composer
  export PATH="/tmp:$PATH"
fi

if [ ! -f /tmp/database.sqlite ]; then
  mkdir -p /tmp
  touch /tmp/database.sqlite
fi

composer install --no-dev --optimize-autoloader --no-interaction
"$PHP_BIN" artisan config:cache
"$PHP_BIN" artisan route:cache
"$PHP_BIN" artisan view:cache
npm install
npm run production
