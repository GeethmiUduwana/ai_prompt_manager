#!/bin/sh
set -e

cat > .env << EOF
APP_NAME=ai-prompt-manager
APP_ENV=production
APP_DEBUG=false
APP_KEY=${APP_KEY:-base64:ZIeZIh28GJrShNHx+c0aDh5gSypaPBASaBiP1p0ckho=}
APP_URL=https://ai-prompt-manager-ssxy.onrender.com
LOG_CHANNEL=stack
LOG_LEVEL=debug
CACHE_DRIVER=file
SESSION_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync

DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite
EOF

touch /tmp/database.sqlite
php artisan migrate --force
php artisan db:seed --force

exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
