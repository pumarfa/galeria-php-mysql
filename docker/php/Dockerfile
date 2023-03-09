ARG php_version

FROM php:${php_version}

RUN docker-php-ext-install mysqli pdo pdo_mysql

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd

RUN a2enmod rewrite
