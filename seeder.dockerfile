FROM php:7.2-apache
MAINTAINER Sean Morris <sean@seanmorr.is>

COPY . /app

RUN apt-get update \
	&& docker-php-ext-install pdo_mysql \
	&& apt-get install -y --no-install-recommends git zip \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN	cd /app \
	&& chmod 777 bootstrap/cache\
	&& chmod -R 777 storage \
	&& mkdir -p storage/data

RUN cd /app \
	&& composer install --prefer-source --no-interaction

RUN cd /app \
	&& curl -o storage/data/mlb_log.csv https://seanmorr.is/mlb_log.csv \
	&& curl -o storage/data/mlb_team_data.csv https://seanmorr.is/mlb_team_data.csv \
	&& curl -o storage/data/mlb_park_data.csv https://seanmorr.is/mlb_park_data.csv

CMD cd /app \
	&& echo "Setting environment vars..." \
	&& php .env.gen.php > .env \
	&& php artisan key:generate \
	&& ./wait-for-it.sh database:3306 \
	&& echo "Running migrations..." \
	&& composer dump-autoload \
	&& php artisan migrate:fresh \
	&& echo "Seeding DB..." \
	&& php artisan db:seed \
	&& echo "Done." \
	&& apache2-foreground
