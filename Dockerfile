FROM php:7.2-apache
MAINTAINER Sean Morris <sean@seanmorr.is>

RUN a2enmod rewrite \
	&& apt-get update \
	&& docker-php-ext-install pdo_mysql \
	&& apt-get install -y --no-install-recommends git zip \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

COPY . /app

RUN	chmod -R 775 /app \
	&& cd /app \
	&& composer install --prefer-source --no-interaction \
	&& rm -rf /var/www/html \
	&& ln -s /app/public /var/www/html \
	&& php artisan key:generate \
	&& chmod -R 777 storage \
	&& chmod 777 bootstrap/cache
