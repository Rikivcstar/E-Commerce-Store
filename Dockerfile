FROM php:8.2-cli-alpine

# Install system packages & required PHP extensions
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql zip intl mbstring bcmath opcache

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy all application files
COPY . .

# Install composer packages & build frontend assets
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm ci \
    && npm run build \
    && rm -rf node_modules

# Ensure entrypoint is executable
RUN chmod +x /app/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/app/docker-entrypoint.sh"]
