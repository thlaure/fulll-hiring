FROM php:8.0-fpm

RUN apt-get update \
    && apt-get install -y nginx \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y unzip libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY nginx/default /etc/nginx/sites-available/default

WORKDIR /var/www/html

EXPOSE 80

CMD service nginx start && php-fpm
