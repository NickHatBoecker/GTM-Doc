FROM php:8.1.2-fpm

##<romaricp>##
RUN apt-get update \
    && apt-get install -y --no-install-recommends vim curl debconf subversion git apt-transport-https apt-utils \
    build-essential locales acl mailutils wget npm zip unzip \
    gnupg gnupg1 gnupg2 openssh-client libmagickwand-dev libmagickcore-dev imagemagick procps libpng-dev libcurl4-openssl-dev

# CFLAGS="$CFLAGS -D_GNU_SOURCE" is a workaround
# https://github.com/docker-library/php/issues/1245
RUN CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install sockets

## Install node 12
RUN curl -fsSL https://deb.nodesource.com/setup_12.x | bash - \
  && apt-get install -y nodejs

# Install Yarn
RUN npm install -g yarn

RUN apt-get install -y libxml2-dev libzip-dev zip zlib1g-dev libicu-dev g++ \
  && docker-php-ext-install curl intl zip pdo pdo_mysql soap mysqli gd
RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug
RUN pecl install imagick
RUN docker-php-ext-enable imagick

COPY php.ini /etc/php/8.1.2/php.ini
COPY php-fpm-pool.conf /etc/php/8.1.2/pool.d/www.conf

RUN echo 'post_max_size = 12M' >> /usr/local/etc/php/conf.d/docker-php-post-size.ini;
RUN echo 'upload_max_filesize = 10M' >> /usr/local/etc/php/conf.d/docker-php-upload-size.ini;

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
	mv composer.phar /usr/local/bin/composer

RUN groupadd dev -g 999
RUN useradd dev -g dev -d /home/dev -m

RUN rm -rf /var/lib/apt/lists/*
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen


WORKDIR /home/wwwroot/
RUN mkdir var
RUN chmod 777 var

RUN mkdir vendor
RUN echo 'alias ll="ls -alF"' >> ~/.bashrc

EXPOSE 9000
CMD ["php-fpm"]
