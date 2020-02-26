#!/bin/sh

cd /app || exit
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port="$APP_PORT"
