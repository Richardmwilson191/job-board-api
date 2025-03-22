<?php

namespace app\Core;

class Router
{
    private $routes = [];
    private $controllerNamespace = "app\\Controllers\\";

    // register route
    public function add($method, $route, $controller, $action)
    {
        $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);

        $this->routes[strtoupper($method)][$routePattern] = ['controller' => $controller, 'action' => $action, 'params' => $route];
    }

    // change controller namespace
    public function changeControllerNamespace($controllerNamespace)
    {
        $this->controllerNamespace = $controllerNamespace;
    }

    // resolve route
    public function resolve($method, $uri)
    {
        $method = strtoupper($method);
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        foreach ($this->routes[$method] as $routePattern => $route) {
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match

                $controllerName = $this->controllerNamespace . $route['controller'];
                $action = $route['action'];

                if (!class_exists($controllerName)) {
                    die("Controller $controllerName not found.");
                }

                $controller = new $controllerName();

                if (!method_exists($controller, $action)) {
                    die("Method $action not found in controller $controllerName.");
                }

                // Pass dynamic parameters to the controller method
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        // If no route matched, return 404
        http_response_code(404);
        echo json_encode(['error' => '404 Not Found']);
    }
}
