# Usa la imagen oficial de PHP con Apache
FROM php:8.1.0-apache

# Copia el contenido de tu proyecto en el directorio raíz del servidor 
WORKDIR /var/www/html


# Establece los permisos adecuados para los archivos copiados
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && a2enmod rewrite
