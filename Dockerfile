FROM php:8.2-cli

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        curl \
        unzip \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libsqlite3-dev \
        nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm install \
    && npm run production \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

ENTRYPOINT ["sh", "-c", "\
php -r \"\
file_put_contents('.env', \"\
APP_NAME=ai-prompt-manager\\n\
APP_ENV=production\\n\
APP_DEBUG=false\\n\
APP_KEY=base64:ZIeZIh28GJrShNHx+c0aDh5gSypaPBASaBiP1p0ckho=\\n\
APP_URL=https://ai-prompt-manager-ssxy.onrender.com\\n\
LOG_CHANNEL=stack\\n\
LOG_LEVEL=debug\\n\
DB_CONNECTION=sqlite\\n\
DB_DATABASE=/app/database/production.sqlite\\n\
CACHE_DRIVER=file\\n\
SESSION_DRIVER=file\\n\
FILESYSTEM_DRIVER=local\\n\
QUEUE_CONNECTION=sync\\n\
\");\" && \
mkdir -p database && \
touch database/production.sqlite && \
php artisan migrate --force && \
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
