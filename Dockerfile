# ============================================
# Stage 1: Build Frontend Assets
# ============================================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources/ resources/
COPY vite.config.js postcss.config.js tailwind.config.js ./
RUN npm run build

# ============================================
# Stage 2: PHP Application
# ============================================
FROM php:8.2-fpm-alpine AS app

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    zip unzip \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy application code
COPY . .

# Copy built frontend assets from stage 1
COPY --from=frontend /app/public/build public/build

# Run post-install scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Copy Supervisor config
COPY docker/supervisord.conf /etc/supervisord.conf

# Create storage link script
RUN php artisan storage:link 2>/dev/null || true

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
