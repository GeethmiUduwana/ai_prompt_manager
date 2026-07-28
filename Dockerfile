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

COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]
