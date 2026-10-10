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

# Copia la aplicación dentro de la imagen.
#  - En desarrollo, docker-compose monta ./ sobre /var/www/html y sobreescribe
#    esta capa (recarga de cambios en caliente).
#  - En producción (p. ej. Render) la imagen queda autocontenida y sirve el
#    código sin necesidad de volúmenes.
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Arranque que respeta la variable PORT (10000 en Render; 80 en local).
COPY docker/start-apache.sh /usr/local/bin/start-apache
RUN chmod +x /usr/local/bin/start-apache

EXPOSE 80

CMD ["start-apache"]
