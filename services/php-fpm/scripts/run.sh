#!/bin/bash
rm -rf /var/www/update \
&& cp -Rfp /tmp/magento_update/update /var/www/ \
&& php /scripts/dbCheck.php \
&& php-fpm
