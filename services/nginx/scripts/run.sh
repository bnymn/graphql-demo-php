#!/bin/sh

envsubst '${APP_DOMAIN}' < /etc/nginx/sites-available/default.conf.template > /etc/nginx/sites-available/default.conf && nginx