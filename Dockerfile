FROM php:8.2-cli

ARG CACHEBUST=2

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

RUN rm -f .env \
    && echo "APP_NAME=\"AI Prompt Manager\"" > .env \
    && echo "APP_ENV=production" >> .env \
    && echo "APP_DEBUG=false" >> .env \
    && echo "APP_KEY=" >> .env \
    && echo "APP_URL=http://localhost" >> .env \
    && echo "LOG_CHANNEL=stack" >> .env \
    && echo "LOG_LEVEL=debug" >> .env \
    && echo "DB_CONNECTION=sqlite" >> .env \
    && echo "DB_DATABASE=/tmp/database.sqlite" >> .env \
    && echo "CACHE_DRIVER=file" >> .env \
    && echo "SESSION_DRIVER=file" >> .env \
    && echo "FILESYSTEM_DRIVER=local" >> .env \
    && echo "QUEUE_CONNECTION=sync" >> .env \
    && mkdir -p /tmp \
    && touch /tmp/database.sqlite \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && npm install \
    && npm run production \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8000

CMD ["sh", "-c", "mkdir -p /tmp && touch /tmp/database.sqlite && php artisan key:generate --force && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
