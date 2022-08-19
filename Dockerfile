FROM php:8.2-rc-apache

# ARG uid

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libmariadb-dev
RUN docker-php-ext-install mysqli

# RUN usermod -u ${uid} www-data && groupmod -g ${uid} www-data;

RUN mkdir -p /var/www/html/foo

RUN a2enmod rewrite

EXPOSE 80
# EXPOSE 443