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

CMD ["sh", "-c", "\
    printf 'APP_NAME=ai-prompt-manager\\nAPP_ENV=production\\nAPP_DEBUG=false\\nAPP_KEY=base64:ZIeZIh28GJrShNHx+c0aDh5gSypaPBASaBiP1p0ckho=\\nAPP_URL=https://ai-prompt-manager-ssxy.onrender.com\\nLOG_CHANNEL=stack\\nLOG_LEVEL=debug\\nDB_CONNECTION=sqlite\\n    DB_DATABASE=/app/database/production.sqlite\\nCACHE_DRIVER=file\\nSESSION_DRIVER=file\\nFILESYSTEM_DRIVER=local\\nQUEUE_CONNECTION=sync\\n' > .env && \
    mkdir -p /app/database && touch /app/database/production.sqlite && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
