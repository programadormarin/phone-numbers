FROM php:8.0.2-fpm-alpine3.13 as development

RUN apk --update add --no-cache --virtual .build-deps $PHPIZE_DEPS sqlite-dev sqlite-libs \
    && pecl install xdebug-3.0.2 \
    && apk del .build-deps

# Need to install composer and npm
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk --update add npm

WORKDIR /app

FROM php:8.0.2-fpm-alpine3.13 as production

COPY --from=dev /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=dev /usr/lib /usr/lib
COPY --from=dev /usr/local/lib /usr/local/lib

COPY . /app

RUN /usr/bin/sqlite3 /app/docker/sqlite/sample.db

CMD ["php-fpm"]