#!/bin/sh
set -e

cd /app

# Create .env using PHP to avoid shell escaping issues
php -r "
\$env = [
    'APP_NAME' => 'ai-prompt-manager',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_URL' => 'http://localhost',
    'LOG_CHANNEL' => 'stack',
    'LOG_LEVEL' => 'debug',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => '/tmp/database.sqlite',
    'CACHE_DRIVER' => 'file',
    'SESSION_DRIVER' => 'file',
    'FILESYSTEM_DRIVER' => 'local',
    'QUEUE_CONNECTION' => 'sync',
];
\$content = '';
foreach (\$env as \$key => \$value) {
    \$content .= \$key . '=' . \$value . PHP_EOL;
}
file_put_contents('.env', \$content);
"

# Generate APP_KEY
php artisan key:generate --force

# Create SQLite database
mkdir -p /tmp
touch /tmp/database.sqlite

# Run migrations
php artisan migrate --force

# Start server
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
