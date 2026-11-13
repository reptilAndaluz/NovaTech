FROM php:8.3-apache

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd bcmath exif \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Apache sirve /public, no la raíz del proyecto (evita exponer .env, vendor, etc.)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
        /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
        /etc/apache2/conf-available/*.conf

# Usuario no-root con tu UID/GID para que los ficheros del bind mount sean tuyos
RUN groupadd -g ${GID} appuser && useradd -u ${UID} -g ${GID} -m appuser
ENV APACHE_RUN_USER=appuser APACHE_RUN_GROUP=appuser

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html