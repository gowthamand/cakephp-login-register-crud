FROM php:7.4-apache-bullseye
RUN sed -i 's|deb.debian.org|archive.debian.org|; s|security.debian.org|archive.debian.org|' /etc/apt/sources.list \
    && apt-get update && apt-get install -y git unzip libicu-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo_mysql mbstring zip \
    && a2enmod rewrite && rm -rf /var/lib/apt/lists/*
ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf
COPY --from=composer:1 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
