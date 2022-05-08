FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
		libzip-dev \
        zip \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

# Extension zip for laravel & mysql driver for mysql
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
