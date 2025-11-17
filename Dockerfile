# -------------------------------------------------------
# Stage 1: Composer dependencies
# -------------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .        # Copy full project after vendor folder is ready


# -------------------------------------------------------
# Stage 2: Node build (Vite production build)
# -------------------------------------------------------
FROM node:20 AS frontend

WORKDIR /app

COPY package.json ./
RUN npm install
COPY . .
RUN npm run build


# -------------------------------------------------------
# Stage 3: Laravel Production Server (PHP 8.4)
# -------------------------------------------------------
FROM php:8.4-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

WORKDIR /var/www/html

# Copy vendor & public build from previous stages
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Copy rest of the app code
COPY . .

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host 0.0.0.0 --port 8000
