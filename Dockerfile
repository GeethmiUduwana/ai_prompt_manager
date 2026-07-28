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

RUN rm -f .env && \
    php -r "file_put_contents('.env', 'APP_NAME=ai-prompt-manager'.PHP_EOL.'APP_ENV=production'.PHP_EOL.'APP_DEBUG=false'.PHP_EOL.'APP_KEY=base64:'.rtrim(base64_encode(random_bytes(32))).PHP_EOL.'APP_URL=https://ai-prompt-manager-ssxy.onrender.com'.PHP_EOL.'LOG_CHANNEL=stack'.PHP_EOL.'LOG_LEVEL=debug'.PHP_EOL.'DB_CONNECTION=sqlite'.PHP_EOL.'DB_DATABASE=/tmp/database.sqlite'.PHP_EOL.'CACHE_DRIVER=file'.PHP_EOL.'SESSION_DRIVER=file'.PHP_EOL.'FILESYSTEM_DRIVER=local'.PHP_EOL.'QUEUE_CONNECTION=sync'.PHP_EOL);" && \
    cat .env && \
    mkdir -p /tmp && touch /tmp/database.sqlite && \
    composer install --no-dev --optimize-autoloader --no-interaction && \
    npm install && \
    npm run production && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    php artisan migrate --force

EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
