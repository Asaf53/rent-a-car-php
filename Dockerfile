# Use official PHP image with Apache
FROM php:8.2-apache

# Install dependencies for PDO MySQL and other extensions
RUN apt-get update && apt-get install -y \
    libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Enable Apache mod_rewrite for URL rewriting (if needed)
RUN a2enmod rewrite

# Copy project files into the container
COPY . /var/www/html/

# Set permissions for the project directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default for Apache)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
