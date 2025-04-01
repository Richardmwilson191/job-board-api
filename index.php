<?php

require_once('./vendor/autoload.php');
$router = require_once __DIR__ . '/routes/api.php';

$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

if ($uri && $method) {
    $router->resolve($method, $uri);
}
