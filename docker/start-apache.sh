#!/bin/sh
#
# Arranque de Apache respetando la variable de entorno PORT.
#
# - En desarrollo (docker-compose) PORT no está definida, así que se usa el 80
#   y el mapeo 8080:80 del compose sigue funcionando igual.
# - En Render, PORT la define la plataforma (por defecto 10000) y Apache debe
#   escuchar en ese puerto para recibir el tráfico.
#
set -e

PUERTO="${PORT:-80}"

sed -i "s/^Listen 80$/Listen ${PUERTO}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PUERTO}>/" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground
