# Use official PHP image with Apache
FROM php:8.2-apache

# Copy project files into the container
COPY . /var/www/html/

# Set permissions for the project directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default for Apache)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
