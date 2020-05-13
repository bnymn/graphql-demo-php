<?php
// php -S localhost:8080 ./index.php &
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/data.php';

use GraphQL\GraphQL;
use GraphQL\Utils\BuildSchema;

$result = get_products($_GET['size'] ?? 100);

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);