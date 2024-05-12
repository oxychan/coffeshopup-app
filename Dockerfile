FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libxslt-dev \
    libicu-dev \
    libpq-dev \
    libmemcached-dev \
    libmagickwand-dev --no-install-recommends

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-interaction

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

COPY .env.example .env

RUN php artisan key:generate
RUN php artisan cache:clear
RUN php artisan optimize
RUN php artisan storage:link

EXPOSE 9000
CMD ["php-fpm"]