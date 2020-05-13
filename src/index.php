<?php
// php -S localhost:8080 ./index.php &
require_once __DIR__ . '/vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Utils\BuildSchema;

$result = include __DIR__ . '/RootValue.php';
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);