FROM php:5.6.13-apache

VOLUME /var/www/html/

RUN apt-get update -y
RUN apt-get install -y libgmp-dev gettext re2c libmhash-dev libmcrypt-dev file openssl gettext
RUN docker-php-ext-configure mcrypt
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-configure gettext
RUN docker-php-ext-install gettext
