FROM php:8.3-cli

# Instalar dependências de sistema necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
  && docker-php-ext-install pdo_mysql mbstring zip \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

# Mantém o container pronto; inicia o servidor se o Laravel já existir
CMD ["bash", "-lc", "if [ -f artisan ]; then php artisan serve --host=0.0.0.0 --port=8000; else echo 'Laravel app not found. Please run composer create-project laravel/laravel .'; tail -f /dev/null; fi"]