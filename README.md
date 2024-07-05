# Docker PHP Project

This project sets up a PHP application with Nginx and Redis caching using Docker. Follow the instructions below to get the project running on your local environment.

## Prerequisites

Make sure you have the following installed:

- Docker
- Docker Compose

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/yourusername/Docker_PHP.git
    cd Docker_PHP
    ```

2. **Set up the environment variables:**

    Create a `.env` file in the root directory and add your Redis configuration:

    ```dotenv
        MYSQL_PORT: 3306
        MYSQL_PASSWORD: *****
        MYSQL_DATABASE: ******
        MYSQL_USER: user: ******
        REDIS_PORT: 6379
    ```

3. **Build and run the Docker containers:**

    ```sh
    sudo docker-compose up -d --build
    ```

4. **Install Composer dependencies:**

    ```sh
    sudo docker-compose exec php composer install
    ```

5. **Access the application:**

    Open your browser and navigate to `http://localhost`.

## Usage

### Translating a Phrase

1. Open your browser and go to `http://localhost`.
2. Select a language from the dropdown menu.
3. Enter the phrase you want to translate.
4. Click the "Translate" button.

### Example Endpoints

- To translate a phrase, make a POST request to the root URL with `language` and `phrase` parameters.

## Project Configuration

### Docker Compose

The `docker-compose.yaml` file defines the services for this project:

- **php**: The PHP-FPM container.
- **nginx**: The Nginx web server container.

### Dockerfile

The `Dockerfile` sets up the PHP environment:

```Dockerfile
FROM php:7.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install PHP dependencies
RUN composer install

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

```
