#!/bin/bash

# Credits
# 
# This snippet is published originally in the following link:
# 
# https://ops.tips/gists/measuring-http-response-times-curl/
# 
# by Ciro S. Costa - Jul 17, 2018


# Set the `errexit` option to make sure that
# if one command fails, all the script execution
# will also fail (see `man bash` for more 
# information on the options that you can set).
set -o errexit

# This is the main routine of our bash program.
# It makes sure that we've supplied the necessary
# arguments, then it prints a CSV header and then
# keeps making requests and printing their responses.
#
# Note.: because we're calling `curl` each time in
#        the loop, a new `curl` process is created for 
#        each request. 
#       
#        This means that a new connection will be made 
#        each time.
#       
#        Such property might be useful when you're testing
#        if a given load-balancer in the middle might be
#        messing up with some requests.
main () {
  for i in `seq 1 10`; do
    make_request
    sleep 1
  done
}

# This method does nothing more that just print a CSV
# header to STDOUT so we can consume that later when
# looking at the results.
# print_header () {
#   # echo "code,time_total,time_connect,time_appconnect,time_starttransfer"
# }

# Make request performs the actual request using `curl`. 
# It specifies those parameters that we've defined before,
# taking a given `url` as its parameter.
# --write-out "%{http_code},\"%{time_total}\",\"%{time_connect}\",\"%{time_appconnect}\",\"%{time_starttransfer}\"\n" \
make_request () {
  curl \
    --location --request POST 'http://127.0.0.1:8080' \
    --header 'Content-Type: application/json' \
    --data-raw '{"query":"query {\n    products {\n        id\n        name\n        price\n        sku\n        related_products {\n            id\n            name\n            price\n            sku\n        }\n    }\n}","variables":{}}' \
    --write-out "%{time_total}\n" \
    --silent \
    --output /dev/null
}

main "$@"