## Install source backend

    cd backend/

    ./composer-install.sh 

    docker network create sail

    ./vendor/bin/sail up -d
        cp .env.example .env

   # Note: open file .env and update 

   # DB_CONNECTION=mysql
   # DB_HOST=logistic-mysql
   # DB_PORT=3306
   # DB_DATABASE=app
   # DB_USERNAME=app
   # DB_PASSWORD=secret    

   # Storage permision issue

    ./vendor/bin/sail exec php-fpm /bin/bash

    php artisan key:gen

    chown -R www-data:www-data /var/www/storage

    chmod -R 775 /var/www/storage

    exit

## Start source frontend 

    cd frontend/

    npm run dev
    
