FROM php:7.4-apache
RUN a2enmod rewrite

RUN echo "chown www-data:www-data Phinx/db/wineDatabase.db"
RUN echo "chown www-data:www-data Phinx/db"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 5000