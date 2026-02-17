FROM php:8.5-apache

# Extensions nécessaires (PDO MySQL + mysqli)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# (Optionnel) Activer mod_rewrite si tu fais un router via .htaccess
RUN a2enmod rewrite

# PHP.ini de dev
COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-dev.ini

COPY docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf

