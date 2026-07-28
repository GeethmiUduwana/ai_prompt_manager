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

CMD ["php", "-r", "$key='base64:'.rtrim(base64_encode(random_bytes(32)));file_put_contents('.env',\"APP_NAME=ai-prompt-manager\\nAPP_ENV=production\\nAPP_DEBUG=false\\nAPP_KEY=$key\\nAPP_URL=http://localhost\\nLOG_CHANNEL=stack\\nLOG_LEVEL=debug\\nDB_CONNECTION=sqlite\\nDB_DATABASE=/tmp/database.sqlite\\nCACHE_DRIVER=file\\nSESSION_DRIVER=file\\nFILESYSTEM_DRIVER=local\\nQUEUE_CONNECTION=sync\\n\");exec('mkdir -p /tmp && touch /tmp/database.sqlite && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port='.getenv('PORT')?:'8000');"]
