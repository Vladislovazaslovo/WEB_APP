FROM php:8.1-apache

RUN apt-get update && apt-get install -y default-mysql-client && docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html/