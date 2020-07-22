FROM php:fpm-alpine
COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
RUN apk add --no-cache  \
    git \
    openssh \
    vim \
    $PHPIZE_DEPS \
    libxml2-dev \
    zlib-dev \
    libmemcached-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev && \
    pecl install memcached && docker-php-ext-enable memcached && \
    pecl install xdebug && docker-php-ext-enable xdebug
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm
EXPOSE 9000
