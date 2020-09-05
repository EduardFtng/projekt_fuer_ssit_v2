FROM php:7.4-apache


RUN usermod -u 1000 www-data

# To get needed extensions run this:
RUN apt-get update && apt-get upgrade -y 

RUN apt-get install -y libpq-dev sendmail \
    && docker-php-ext-configure pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini 

RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint

RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoint


# The .conf(this one is for the development) file mapping:
COPY ./apache.conf /usr/local/apache2/conf/httpd.conf

# And clean up the image
RUN rm -rf /var/lib/apt/lists/*
