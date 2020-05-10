<?php

function get_product() {
    return [
        'id' => mt_rand(),
        'name' => mt_rand(),
        'price' => mt_rand(),
        'sku' => mt_rand(),
    ];
}

$products = [];
for ($i=0; $i<1000; $i++) {
    $product = get_product();
    for ($k=0; $k<4; $k++) {
        $product['related_products'][] = get_product();
    }
    $products[] = $product;
}

return [
    'products' => function($root, $args, $context) use ($products) {
        return $products;
    },
];
