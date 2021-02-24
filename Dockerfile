FROM php:apache

# install the PHP extensions we need
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libpq-dev git zip unzip libfreetype6-dev libonig-dev \
	&& rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ADD . /app
WORKDIR /app
EXPOSE 80