# Koristi PHP Apache sliku
FROM php:8.1-apache

# Kopiraj sve fajlove u direktorijum gde Apache posluje
COPY . /var/www/html

# Instaliraj PHP ekstenzije za rad sa MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktiviraj mod_rewrite za Apache
RUN a2enmod rewrite

# Postavi radni direktorijum
WORKDIR /var/www/html
