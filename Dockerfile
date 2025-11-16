FROM php:8.2-apache
COPY . /var/www/html
WORKDIR /var/www/html
RUN a2enmod rewrite
EXPOSE 80
CMD ["apache2-foreground"]
