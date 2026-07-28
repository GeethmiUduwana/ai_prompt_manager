#!/bin/sh
set -e

cd /app

php -r "
\$key = 'base64:' . rtrim(base64_encode(random_bytes(32)));
file_put_contents('.env', implode(PHP_EOL, [
    'APP_NAME=ai-prompt-manager',
    'APP_ENV=production',
    'APP_DEBUG=false',
    'APP_KEY=' . \$key,
    'APP_URL=http://localhost',
    'LOG_CHANNEL=stack',
    'LOG_LEVEL=debug',
    'DB_CONNECTION=sqlite',
    'DB_DATABASE=/tmp/database.sqlite',
    'CACHE_DRIVER=file',
    'SESSION_DRIVER=file',
    'FILESYSTEM_DRIVER=local',
    'QUEUE_CONNECTION=sync',
    '',
]));
"

mkdir -p /tmp
touch /tmp/database.sqlite

php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
