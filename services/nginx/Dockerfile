FROM nginx:1.17-alpine

ARG USER_ID
ARG GROUP_ID

# Create the user
RUN addgroup --gid ${GROUP_ID} user
RUN adduser -D -g '' --uid ${USER_ID} -G user user
RUN addgroup user tty

# Copy all scripts
RUN mkdir -p /scripts
COPY ./scripts /scripts
RUN chmod +x /scripts/*

# Copy configurations
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./sites-available/default.conf.template /etc/nginx/sites-available/default.conf.template

EXPOSE 80 443