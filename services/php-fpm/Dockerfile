FROM php:7.3-fpm
ARG USER_ID
ARG GROUP_ID
ARG BUILD_ENV

# Create a new user and group in order to prevent creating files with root
RUN addgroup --gid ${GROUP_ID} user
RUN adduser --disabled-password --gecos '' --uid ${USER_ID} --gid ${GROUP_ID} user

# Install mbstring
RUN docker-php-ext-install mbstring

USER user

WORKDIR /var/www

EXPOSE 9000