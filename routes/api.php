<?php

use app\Core\Router;

$router = new Router();

// user routes
$router->add('GET', 'user', 'UserController', 'index');
$router->add('POST', 'user', 'UserController', 'store');
$router->add('GET', 'user/show/{id}', 'UserController', 'show');
$router->add('PATCH', 'user/update/{id}', 'UserController', 'update');
$router->add('DELETE', 'user/delete/{id}', 'UserController', 'delete');

// role routes
$router->add('GET', 'role', 'RoleController', 'index');
$router->add('POST', 'role', 'RoleController', 'store');
$router->add('GET', 'role/show/{id}', 'RoleController', 'show');
$router->add('PATCH', 'role/update/{id}', 'RoleController', 'update');
$router->add('DELETE', 'role/delete/{id}', 'RoleController', 'delete');
