FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev git \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www
