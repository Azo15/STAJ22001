FROM node:22-bookworm-slim AS frontend
WORKDIR /app
COPY package*.json vite.config.js postcss.config.js tailwind.config.js ./
COPY resources resources
RUN npm ci && npm run build

FROM php:8.3-apache
RUN apt-get update && apt-get install -y --no-install-recommends libsqlite3-dev unzip \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
COPY --from=frontend /app/public/build public/build
ENV APP_ENV=production APP_DEBUG=false DB_CONNECTION=demo_sqlite SESSION_DRIVER=array CACHE_STORE=array
RUN composer install --no-interaction --prefer-dist \
    && touch database/demo.sqlite \
    && php artisan migrate --force \
    && php artisan db:seed --class=GenreSeeder --force \
    && php artisan db:seed --class=BooksSeeder --force \
    && chmod 0444 database/demo.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\nAllowOverride All\n</Directory>\n' > /etc/apache2/conf-enabled/laravel.conf
ENV DEMO_MODE=true
