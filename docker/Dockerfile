FROM composer:2.5.8 AS composer
FROM mlocati/php-extension-installer:2.1.28 AS php-ext-installer

FROM php:8.1.20-fpm

# install php extensions
COPY --from=php-ext-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    mysqli \
    zip \
    pcntl \
    xdebug-3.2.1

# add Composer
ENV COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_NO_INTERACTION=1 COMPOSER_HTACCESS_PROTECT=0
COPY --from=composer /usr/bin/composer /usr/bin/composer

# comment out 'user' and 'group' directives (throws a warning if php-fpm is not running as root)
RUN sed -e '/^user\|^group/s/^/;/' -i /usr/local/etc/php-fpm.d/www.conf

# create non-root user
ARG UNAME=www-data
ARG UID=1000
ARG GID=1000
RUN userdel $UNAME \
    && groupadd -g $GID $UNAME \
    && useradd -ms /bin/bash -u $UID -g $UNAME $UNAME

COPY .bash_aliases /home/$UNAME/.bash_aliases

RUN chown -R $UNAME:$UNAME /home/$UNAME

# enable terminal colors support
ENV TERM=xterm-256color

ENV XDEBUG_MODE=debug
ENV XDEBUG_CONFIG="client_host=host.docker.internal cli_color=1"
ENV PHP_IDE_CONFIG="serverName=relesys"

USER $UNAME
