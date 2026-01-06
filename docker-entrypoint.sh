#!/bin/bash
set -e

echo "🚀 Iniciando setup de produção..."

# Otimizações do Laravel
echo "🔥 Otimizando cache..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

# Rodar migrações (Force é necessário em produção)
echo "🐘 Rodando migrações do banco..."
php artisan migrate --force

# Iniciar Apache em foreground
echo "🎬 Iniciando servidor..."
apache2-foreground