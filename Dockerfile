FROM php:8.2-fpm

WORKDIR /app

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]