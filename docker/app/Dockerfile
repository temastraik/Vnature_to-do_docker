FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Устанавливаем расширения PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Создаем пользователя www-data (стандартный для FPM)
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www && \
    chown -R www:www /var/www

# Копируем файлы проекта
COPY --chown=www:www ./backend /var/www/backend

WORKDIR /var/www/backend

# Конфигурация PHP-FPM
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    echo "pm.max_children = 20" >> /usr/local/etc/php-fpm.d/zz-docker.conf && \
    echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf

USER www

EXPOSE 9000
CMD ["php-fpm"]