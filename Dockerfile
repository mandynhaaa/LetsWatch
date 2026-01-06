# --- Stage 1: Build do Frontend (Node/Vite) ---
FROM node:20 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- Stage 2: Dependências do Backend (Composer) ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
# Instala dependências de produção, sem dev, otimizadas
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --ignore-platform-reqs \
    --optimize-autoloader \
    --no-scripts

# --- Stage 3: Imagem Final de Runtime (PHP + Apache) ---
FROM php:8.3-apache

# Instalar dependências do sistema e extensões PHP necessárias para Laravel + Postgres
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip intl opcache

# Habilitar mod_rewrite do Apache (essencial para rotas do Laravel)
RUN a2enmod rewrite

# Configurar DocumentRoot para /public (padrão Laravel)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurações de Otimização do PHP para Produção
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos da aplicação
COPY . .

# Copiar vendor gerado no Stage 2
COPY --from=vendor /app/vendor/ ./vendor/

# Copiar build do frontend gerado no Stage 1
COPY --from=frontend /app/public/build/ ./public/build/

# Ajustar permissões (O Render roda como usuário arbitrário às vezes, mas www-data é o padrão do Apache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80
EXPOSE 80

# Script de entrada para rodar migrações e cache
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]