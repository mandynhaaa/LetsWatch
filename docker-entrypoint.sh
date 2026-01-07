set -e

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

php artisan migrate:fresh --force

apache2-foreground