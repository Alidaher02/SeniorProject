# ==========================
# Stage 1 - Build Frontend
# ==========================
FROM node:22 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build


# ==========================
# Stage 2 - Laravel Backend
# ==========================
FROM php:8.4-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    bcmath


# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# Laravel directory
WORKDIR /var/www/html


# Copy Laravel project
COPY . .


# Copy Vite production files
COPY --from=frontend /app/public/build ./public/build


# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction


# Configure Apache for Laravel
RUN a2enmod rewrite

RUN sed -ri \
    -e 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf


# Laravel optimization
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear


# Render uses HTTP port
EXPOSE 80


# Start Apache server
CMD ["apache2-foreground"]