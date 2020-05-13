<?php

function get_product() {
    return [
        'id' => mt_rand(),
        'name' => mt_rand(),
        'price' => mt_rand(),
        'sku' => mt_rand(),
    ];
}

function get_products($size)
{
    $products = [];
    for ($i=0; $i<$size; $i++) {
        $product = get_product();
        for ($k=0; $k<4; $k++) {
            $product['related_products'][] = get_product();
        }
        $products[] = $product;
    }
    return $products;
}

$products = get_products($_GET['size'] ?? 100);

return [
    'products' => function($root, $args, $context) use ($products) {
        return $products;
    },
];
