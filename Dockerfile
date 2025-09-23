FROM php:8.2-apache

COPY . /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite \
    && echo '<Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/z-override.conf \
    && a2enconf z-override

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]