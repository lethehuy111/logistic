FROM jkaninda/laravel-php-fpm:8.2

COPY . /var/www
# Storage Volume
VOLUME /var/www/storage

WORKDIR /var/www


RUN chown -R www-data:www-data /var/www/storage

RUN chmod -R 775 /var/www/storage

COPY --chown=www:www . /var/www

USER www
