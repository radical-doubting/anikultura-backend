FROM existenz/webstack:8.1

RUN apk -U --no-cache add \
    php81 \
    php81-phar \
    php81-openssl \
    php81-pdo  \
    php81-pdo_pgsql  \
    php81-pgsql \
    php8-mysqli \
    php81-pdo_mysql  \
    php81-sodium \
    php81-dom \
    php81-tokenizer \
    php81-fileinfo \
    php81-mbstring \
    php81-redis \
    && ln -s /usr/bin/php81 /usr/bin/php 

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY --chown=php:nginx . /www

RUN find /www -type d -exec chmod -R 555 {} \; \
    && find /www -type f -exec chmod -R 444 {} \; \
    && find /www/storage /www/bootstrap/cache -type d -exec chmod -R 755 {} \; \
    && find /www/storage /www/bootstrap/cache -type f -exec chmod -R 644 {} \;

RUN chmod +x setup-agent.sh

RUN composer install --no-dev --no-ansi --no-interaction --no-progress --prefer-dist

EXPOSE 80
EXPOSE 443
