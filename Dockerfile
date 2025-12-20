# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# 1. Install dependency sistem
# KITA TAMBAHKAN: libicu-dev (Wajib untuk ekstensi intl)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    nodejs \
    npm \
    ca-certificates

# 2. Bersihkan cache apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install ekstensi PHP
# KITA TAMBAHKAN: intl (Wajib untuk Filament)
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# 4. Aktifkan Mod Rewrite
RUN a2enmod rewrite

# 5. Ubah Document Root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# 7. Set working directory
WORKDIR /var/www/html

# 8. Copy source code
COPY . .

# 9. Install dependensi PHP
RUN composer install --no-dev --optimize-autoloader

# 10. Install dependensi Node.js & Build Assets
RUN npm install
RUN npm run build

# 11. Atur hak akses folder storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 12. Expose Port 80
EXPOSE 80

# 13. Jalankan Apache
CMD ["apache2-foreground"]
