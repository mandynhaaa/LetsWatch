#!/bin/bash
set -e

php artisan config:cache
php artisan db:wipe --force
php artisan migrate --force

apache2-foreground