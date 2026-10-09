FROM php:8.2-apache

# Extensiones necesarias:
#  - pdo_mysql : acceso a MySQL/MariaDB mediante PDO
#  - mbstring  : manejo correcto de cadenas UTF-8 en las validaciones
RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring \
    && apt-get purge -y --auto-remove libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Módulos de Apache útiles para una app PHP sencilla.
RUN a2enmod rewrite headers

EXPOSE 80
