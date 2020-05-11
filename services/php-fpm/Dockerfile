FROM php:7.4-fpm
# FROM devilbox/php-fpm-8.0:latest
ARG USER_ID
ARG GROUP_ID

# Create a new user and group in order to prevent creating files with root
RUN addgroup --gid ${GROUP_ID} user
RUN adduser --disabled-password --gecos '' --uid ${USER_ID} --gid ${GROUP_ID} user

# Install Oniguruma
RUN apt-get update -y \
    && apt-get install -y --no-install-recommends libonig-dev \
    && apt-get clean

# Install mbstring
RUN docker-php-ext-install mbstring

# Install Git
RUN apt-get update -y \
    && apt-get install -y --no-install-recommends git \
    && apt-get clean

# Copy scripts
RUN mkdir -p /scripts
COPY ./scripts /scripts
RUN chmod +x /scripts/*
RUN chown user:user -Rf /scripts

# Install composer
RUN /scripts/install-composer.sh \
    && chown user:user /usr/local/bin/composer \
    && mkdir -p /home/user/.composer \
    && chown -Rf user:user /home/user

USER user
WORKDIR /var/www
EXPOSE 9000