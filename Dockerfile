# Use the official PHP image with Apache
FROM php:8.2-apache

# Install necessary PHP extensions and libraries
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . /var/www/html

# Set correct permissions for Apache to access the files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose Apache's default HTTP port
EXPOSE 80

# Start Apache service in the foreground
CMD ["apache2-foreground"]
