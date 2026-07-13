FROM php:8.1-apache

# Enable Apache mod_rewrite for URL routing if needed
RUN a2enmod rewrite

# Install mysqli extension for database connection
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy all project files to the apache root
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
