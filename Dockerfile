FROM docker-registry.locaweb.com.br/bionic/php-dev:7.2

WORKDIR /var/www/html/app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php && mv composer.phar /usr/bin/composer

ENV PATH ./vendor/bin:$PATH