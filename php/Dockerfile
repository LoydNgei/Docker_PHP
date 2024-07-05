# Dockerfile

FROM php:8.1-fpm-alpine as app


# Useful PHP Extension installer image, copy binary into your container
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN set -eux; \
    install-php-extensions pdo pdo_mysql;


# Install PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql

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

# This stage is meant to be target-built into a separate image

FROM app as app_dev

# Xdebug has different modes/functionalities. We can default to 'off'
ENV X-DEBUG_MODE=off

# Copy xdebug config file into container

COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Install xdebug
RUN set -eux; \
    install-php-extensions xdebug
