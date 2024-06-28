# Dockerfile

FROM php:8.1-fpm-alpine

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set up Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.4 /usr/bin/composer /usr/local/bin/composer

# Ensure composer is executable
RUN chmod +x /usr/local/bin/composer

# Copy only composer.json and composer.lock before doing composer install
COPY ./app/composer.* ./
RUN composer install

# Copy application files to the working directory
COPY ./app /var/www/html

# Run composer dump-autoload --optimize
RUN composer dump-autoload --optimize
