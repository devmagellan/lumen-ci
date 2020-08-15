FROM php:7.3-fpm

MAINTAINER Roberto Arruda <robertoarruda@gmail.com>
MAINTAINER Andrey Lopushansky <dev.magellan@gmail.com>
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt update -yqq \
    && apt full-upgrade -y \
    && pecl channel-update pecl.php.net

RUN apt install --no-install-recommends -y sudo \
    && groupadd -g 1000 docker \
    && useradd -m -u 1000 -g docker docker -G sudo \
    && echo 'docker:docker' | chpasswd \
    #
    #
    && apt install --no-install-recommends -y git ssh-client python-setuptools python-pip \
    && pip install supervisor \
    && mkdir /etc/supervisor \
    && echo_supervisord_conf > /etc/supervisor/supervisord.conf \
    #
    #
    && apt install --no-install-recommends -yqq apt-utils libzip-dev zip unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && php -m | grep -q 'zip' \
    #
    #
    && apt install --no-install-recommends -y libbz2-dev \
    && docker-php-ext-install bz2 \
    #
    #
    && apt install --no-install-recommends -y libpng-dev \
    && docker-php-ext-install gd \
    #
    #
    && apt install --no-install-recommends -y libssh2-1-dev \
    && pecl install -a ssh2-1.2 \
    && docker-php-ext-enable ssh2 \
    #
    #
    && rm /etc/apt/preferences.d/no-debian-php \
    && apt install --no-install-recommends -y libxml2-dev php-soap \
    && docker-php-ext-install soap \
    #
    #
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    #
    #
    && yes | apt install --no-install-recommends -y php-phpdbg \
    #
    #
    && pecl install -o -f redis \
    && docker-php-ext-enable redis \
    #
    #
    && apt install --no-install-recommends -y cmake libcurl4-openssl-dev libssl-dev \
    && curl -L -o /tmp/rabbitmq-c.tar.gz https://github.com/alanxz/rabbitmq-c/archive/master.tar.gz \
    && mkdir -p rabbitmq-c \
    && tar -C rabbitmq-c -zxvf /tmp/rabbitmq-c.tar.gz --strip 1 \
    && cd rabbitmq-c/ \
    && mkdir _build && cd _build/ \
    && cmake .. \
    && cmake --build . --target install \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && docker-php-ext-install sockets \
    #
    #
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli \
    #
    #
    && docker-php-ext-install pcntl \
    #
    #
    && docker-php-ext-install bcmath \
    #
    #
    && apt install --no-install-recommends -y libmemcached-dev \
    && pecl install memcached-3.1.3 \
    && docker-php-ext-enable memcached \
    #
    #
    && docker-php-ext-install opcache \
    #
    #
    && apt install --no-install-recommends -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    #
    #
    && apt install --no-install-recommends -y libldap2-dev \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    #
    #
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    #
    #
    && apt install --no-install-recommends -y libyaml-dev \
    && pecl install yaml \
    && docker-php-ext-enable yaml \
    #
    #
    && apt install --no-install-recommends -y sshpass \
    #
    #
    && apt install --no-install-recommends -y libsqlite3-dev sqlite3 \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-enable pdo_sqlite \
    #
    #
    && apt install --no-install-recommends -y libsodium-dev \
    && pecl install -f libsodium \
    && docker-php-ext-enable sodium \
    #
    #
    && apt install --no-install-recommends -y libuuid1 uuid-dev \
    && pecl install uuid \
    && docker-php-ext-enable uuid

RUN apt autoremove -y \
    && apt autoclean -y \
    && apt clean -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    #
    #
    && mkdir /home/docker/.ssh \
    && touch /home/docker/.ssh/known_hosts \
    && ssh-keyscan github.com >> /home/docker/.ssh/known_hosts \
    && ssh-keyscan gitlab.com >> /home/docker/.ssh/known_hosts \
    && ssh-keyscan bitbucket.org >> /home/docker/.ssh/known_hosts \
    && echo 'alias ll="ls -la --color=auto"' >> /home/docker/.bashrc

COPY ./docker/supervisor/local /etc/supervisor/conf.d
COPY ./ /var/www/wgtcrm/
RUN chmod +x /var/www/wgtcrm/
# Install Composer.
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
#    && ln -s $(composer config --global home) /root/composer
#ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1
#ENV COMPOSER_VERSION 1.10.10
#ENV COMPOSER_ALLOW_SUPERUSER 1
#ENV COMPOSER_MEMORY_LIMIT -1
#ENV COMPOSER_HOME /var/www/wgtcrm/
WORKDIR /var/www/wgtcrm/

# Install prestissimo (composer plugin). Plugin that downloads packages in parallel to speed up the installation process
# After release of Composer 2.x, remove prestissimo, because parallelism already merged into Composer 2.x branch:
# https://github.com/composer/composer/pull/7904
#RUN composer global require hirak/prestissimo

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# RUN set -xe \
#  && php -d memory_limit=-1 /usr/bin/composer update --no-dev --no-scripts --no-suggest --no-interaction --prefer-dist --optimize-autoloader
#USER docker
RUN php -d memory_limit=-1 /usr/local/bin/composer install -d /var/www/wgtcrm
COPY ./ /var/www/wgtcrm/
RUN chmod -R o+w /var/www/wgtcrm/storage
#RUN sudo chown -R docker:docker storage bootstrap
CMD ["php-fpm", "--nodaemonize"]
# Start php-fpm server
#ENTRYPOINT ["sh", "/usr/local/etc/php/entrypoint.sh"]
