FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install intl pdo pdo_mysql \
    && docker-php-ext-enable intl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 8080

# Start Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
    