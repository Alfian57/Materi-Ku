# Use PHP 8.2 with FPM image
FROM php:8.2-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Set Working Directory
WORKDIR /var/www/html

# Install dependencies, including oniguruma for mbstring support
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libonig-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install SQLite3
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Composer files and install dependencies with cache optimization
COPY . .
RUN composer install --optimize-autoloader --no-interaction --prefer-dist

# Create SQLite database file
RUN touch /var/www/html/database/database.sqlite

# Create a new directory named 'assignment' and 'images'
RUN mkdir -p /var/www/html/storage/app/public/assignments
RUN mkdir -p /var/www/html/storage/app/public/images

# Run Laravel storage link
RUN php artisan storage:link

# Set permissions for storage, bootstrap/cache, and public directories
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
    && chmod 664 /var/www/html/database/database.sqlite

# Remove default Nginx configuration file
RUN rm /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Copy Nginx configuration file
COPY ./docker/nginx/default /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
