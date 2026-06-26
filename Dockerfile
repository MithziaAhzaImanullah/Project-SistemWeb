FROM php:8.3-apache

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies dan build Vite assets
RUN npm install && npm run build

# Buat file SQLite database
RUN mkdir -p /var/data \
    && touch /var/data/database.sqlite \
    && chmod -R 775 /var/data

# Set permission storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Konfigurasi Apache arahkan ke folder public Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Buat .env dari .env.example
RUN cp .env.example .env

# Script start: generate key, migrate, lalu jalankan Apache
CMD php artisan key:generate --force \
    && php artisan migrate --force \
    && php artisan storage:link \
    && php artisan config:cache \
    && php artisan route:cache \
    && apache2-foreground

EXPOSE 80