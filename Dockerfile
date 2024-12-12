# Utilisez une image PHP de base (ajustez la version selon vos besoins)
FROM php:8.2-fpm

# Installez les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip

# Installez Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiez le répertoire de votre projet dans le conteneur
WORKDIR /var/www/html
COPY . .

# Installez les dépendances Composer
RUN composer install

# Exposez le port PHP-FPM
EXPOSE 9000
