FROM php:8.0.10-fpm-bullseye

RUN apt update \
 && apt upgrade -y \
 && apt install -y git postgresql postgresql-server-dev-all libxml2 libbz2-dev \
 curl libicu-dev libc-client2007e-dev libkrb5-dev libldap2-dev libonig-dev \
 libsodium-dev libssl-dev libxslt1-dev autoconf gcc make g++ libzip-dev supervisor \
 tzdata unzip nano procps

RUN cp /usr/share/zoneinfo/Europe/Kiev /etc/localtime \
&& echo "Europe/Kiev" > /etc/timezone

COPY php.ini $PHP_INI_DIR/php.ini

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl

RUN docker-php-ext-install bz2 intl imap ldap mysqli \
 pdo_mysql pdo_pgsql pgsql soap bcmath sockets \
 xsl ftp zip pcntl opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install -o -f redis \
&& rm -rf /tmp/pear \
&& docker-php-ext-enable redis

RUN pecl install xdebug \
&& docker-php-ext-enable xdebug
COPY xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

RUN addgroup www-data root

COPY www.conf /usr/local/etc/php-fpm.d

WORKDIR /var/www

CMD php-fpm -R

EXPOSE 9000
