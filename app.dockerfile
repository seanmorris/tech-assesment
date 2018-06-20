FROM php:7.2-apache
MAINTAINER Sean Morris <sean@seanmorr.is>

COPY . /app

RUN a2enmod rewrite \
	&& apt-get update \
	&& docker-php-ext-install pdo_mysql \
	&& apt-get install -y --no-install-recommends git zip \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN	chmod 775 /app \
	&& rm -rf /var/www/html \
	&& ln -s /app/public /var/www/html \
	&& cd /app \
	&& chmod 777 bootstrap/cache\
	&& chmod -R 777 storage \
	&& mkdir -p storage/data

RUN cd /app \
	&& composer install --prefer-source --no-interaction

CMD cd /app \
	&& echo "Setting environment vars..." \
	&& php .env.gen.php > .env \
	&& php artisan key:generate \
	&& ./wait-for-it.sh database:3306 \
	&& apache2-foreground
