FROM php:8.0-cli

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list

RUN apt update \
    && apt install -y zlib1g-dev g++ git zip libzip-dev libicu-dev zip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt install symfony-cli
RUN git config --global user.email "you@example.com" \
    && git config --global user.name "Your Name"

WORKDIR /var/www/GSB-Medecins

ENTRYPOINT ["bash"]