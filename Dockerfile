# FROM alpine/git:latest
# CMD ["git", "version"]

FROM php:8.2-rc-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libmariadb-dev
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd
RUN a2enmod rewrite
EXPOSE 80