#!/bin/sh
set -e
echo "Deploying application ..."
# Enter maintenance mode
(php artisan down --message 'The app is being updated. Please try again later.') || true
    # Update codebase
    git fetch origin deploy
    git reset --hard origin/deploy
    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader
    # Migrate database
    php artisan migrate --force
    #  Restart  queue workers
    sudo supervisorctl reload
    sudo service supervisor restart
    #  Restart  cron
    sudo service cron restart
    # Clear cache
    php artisan optimize
    # Reload PHP to update opcache
    echo "" | sudo -S service php8.1-fpm reload
# Exit maintenance mode
php artisan up
echo "Application deployed!"
