FROM php:5.6-apache

RUN apt-get update && \
    apt-get install -y \
      mysql-client \
      libmysqlclient-dev \
      wget \
      vim && \
    apt-get clean

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

ADD hoosk.dev.conf /etc/apache2/sites-enabled/

USER root
WORKDIR /var/www/html/
ADD .htaccess ./
RUN chown -R www-data: /var/www/html/
EXPOSE 80