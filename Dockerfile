FROM php:8.2-apache

WORKDIR /var/www/html

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Configurar Apache
RUN a2enmod rewrite
RUN echo '<Directory /var/www/html/public>\n    AllowOverride All\n</Directory>' > /etc/apache2/sites-available/000-default.conf

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["apache2-foreground"]