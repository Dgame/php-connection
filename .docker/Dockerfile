FROM php:7.4-fpm-alpine

ARG USER_ID=1000

#--quiet
RUN apk update && \
    apk add --no-cache bash git shadow openssh openssl-dev
#    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev && \
#    apk del .build-deps

RUN mkdir -p /var/www/.ssh/ && \
    touch /var/www/.ssh/known_hosts && \
    ssh-keyscan github.com >> /var/www/.ssh/known_hosts

WORKDIR .
COPY . .

COPY --chown=www-data:www-data --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN usermod -u $USER_ID www-data && chown -R www-data:www-data /var/www/ .
USER www-data

CMD ["php-fpm"]
