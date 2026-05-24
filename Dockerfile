FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --optimize-autoloader

COPY . .
RUN composer dump-autoload --no-dev --optimize


FROM node:22-bookworm-slim AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build


FROM php:8.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV PORT=10000

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        libpq-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        bcmath \
        opcache \
        pdo_pgsql \
        pgsql \
        zip \
    && a2enmod headers rewrite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/apache/ports.conf /etc/apache2/ports.conf
COPY docker/render-start.sh /usr/local/bin/render-start

RUN mkdir -p \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/smarty/cache \
        storage/framework/smarty/templates_c \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chmod +x /usr/local/bin/render-start \
    && chown -R www-data:www-data storage bootstrap/cache

CMD ["render-start"]
