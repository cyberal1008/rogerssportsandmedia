FROM php:8.5-fpm-alpine

# Install required extensions
RUN apk add --no-cache \
    curl \
    wget \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    $PHPIZE_DEPS

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    zip \
    exif \
    bcmath

# Install PECL extensions
RUN pecl install redis && docker-php-ext-enable redis

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set PHP configuration
RUN echo "upload_max_filesize = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/memory.ini

# Set working directory
WORKDIR /var/www/html

# Create www-data user symlink (Alpine uses different structure)
RUN addgroup -g 82 -S www-data 2>/dev/null || true \
    && adduser -S -D -H -u 82 -h /var/www/html -s /sbin/nologin -c "www-data" -G www-data www-data 2>/dev/null || true

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
