FROM php:7.2-fpm

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

RUN apt-get install -y \
    git \
    zip \
    sudo \
    nano \
    wget \
    unzip \
    dialog \
    apt-utils \
    apt-utils \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    python3-pip \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    build-essential \
    libfreetype6-dev \
    libcurl4-openssl-dev \
    g++

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install xdebug
RUN pecl install xdebug-2.7.2
RUN docker-php-ext-enable xdebug

# Other PHP7 Extensions
RUN apt-get -y install libsqlite3-dev libsqlite3-0 default-mysql-client
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli

RUN docker-php-ext-install curl
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install json
RUN docker-php-ext-install fileinfo

RUN apt-get -y install zlib1g-dev
RUN docker-php-ext-install zip

RUN apt-get -y install libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN docker-php-ext-install mbstring

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

# Get gmp extension
RUN apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install gmp
RUN docker-php-ext-install sockets
RUN docker-php-ext-install mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www
#CMD php artisan migrate
