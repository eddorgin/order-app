FROM php:7.3-cli


# Installing Ubuntu Packages
RUN export DEBIAN_FRONTEND=noninteractive \
    && apt-get update \
    && apt-get install -y --no-install-recommends apt-utils \
    && apt-get install -y gzip git jq \
    && apt-get install -y zip unzip \
    && apt-get install -y libxml2-dev libzip-dev \
    && apt-get install -y libssl-dev libcurl4-openssl-dev pkg-config \
    && apt-get install -y libicu-dev g++ libxml2 \
    && apt-get install -y libbz2-dev zlib1g-dev \
    && apt-get install -y libssh-dev \
    && apt-get install -y librabbitmq-dev \
    && apt-get install -y wait-for-it

# Installing PHP Core Extensions
RUN docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-install -j$(nproc) bcmath \
	&& docker-php-ext-install -j$(nproc) intl \
	&& docker-php-ext-install -j$(nproc) sockets \
	&& docker-php-ext-install -j$(nproc) opcache \
	&& docker-php-ext-install -j$(nproc) calendar \
	&& docker-php-ext-install -j$(nproc) pdo_mysql \
	&& docker-php-ext-install -j$(nproc) zip \
	&& docker-php-ext-install -j$(nproc) pcntl soap curl xml mbstring soap

# Enable PHP Debug
RUN	pecl install xdebug \
	&& docker-php-ext-enable xdebug

# Install PHP composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y gnupg2 \
    && (curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -) \
    && (echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list) \
    && apt update \
    && apt install -y yarn

COPY ./php.ini /usr/local/etc/php/php.ini



