TO_JEST_BLAD_NIE_MA_TAKIEJ_KOMENDY
FROM php:8.1-apache

RUN echo "output_buffering = On" > /usr/local/etc/php/conf.d/output-buffering.ini

# Włączamy moduł rewrite dla plików .htaccess oraz rozszerzenia MySQL dla PHP
RUN a2enmod rewrite \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Nadajemy uprawnienia do folderu roboczego Apache
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
