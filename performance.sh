#!/bin/bash

# Credits
#
# This snippet is published originally in the following link:
#
# https://ops.tips/gists/measuring-http-response-times-curl/
#
# by Ciro S. Costa - Jul 17, 2018

set -o errexit

main () {
  for size in $(seq 100 100 1000); do
    echo "Item Size: $size";
    OUTPUT=$(for i in $(seq 1 10); do
      make_request "$size"
      sleep 1
    done)
    echo "$OUTPUT" | awk '{ total += $1*1000; count++ } END { printf "Avg. Time: %f ms\n", total/count }'
    echo ""
  done
}

make_request () {
  local size=$1

  curl \
    --location --request POST "http://127.0.0.1:8080?size=$size" \
    --header 'Content-Type: application/json' \
    --data-raw "{\"query\":\"query {\n    products {\n        id\n        name\n        price\n        sku\n        related_products {\n            id\n            name\n            price\n            sku\n        }\n    }\n}\",\"variables\":{}}" \
    --write-out "%{time_total}\n" \
    --silent \
    --output /dev/null
}

main "$@"