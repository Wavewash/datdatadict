#!/bin/sh
composer install
php -S 0.0.0.0:8000 -t /app
wget -qO- localhost/createdb/ &> /dev/null
wget -qO- localhost/createtables/ &> /dev/null