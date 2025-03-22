<?php

require_once('./vendor/autoload.php');
require_once __DIR__ . '/routes/api.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->resolve($method, $uri);
