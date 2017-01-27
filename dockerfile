FROM composer

RUN mkdir /web

ADD composer.json /web/composer.json
RUN cd /web && composer install 

EXPOSE 8080