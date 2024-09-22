<?php

class Router
{
    private $routes = [];

    public function addRoute($method, $uri, $callback)
    {
        $this->routes[] = [
            'method' => (array)$method,
            'uri' => $uri,
            'callback' => $callback
        ];
    }

    public function dispatch()
    {
        $requestedUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestedMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if (in_array($requestedMethod, $route['method']) && $requestedUri == rtrim($route['uri'], '/')) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
    }
}
