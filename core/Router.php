<?php

namespace Core;

class Router
{
    protected $routes = [];

    // Register GET route
    public function get($uri, $controllerAction)
    {
        $this->addRoute('GET', $uri, $controllerAction);
    }

    // Register POST route
    public function post($uri, $controllerAction)
    {
        $this->addRoute('POST', $uri, $controllerAction);
    }

    // Add a route to the routes array
    private function addRoute($method, $uri, $controllerAction)
    {
        $this->routes[$method][$this->normalizeUri($uri)] = $controllerAction;
    }

    // Normalize the URI by removing the trailing slash
    private function normalizeUri($uri)
    {
        return rtrim($uri, '/');
    }

    // Dispatch the request
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $this->normalizeUri($_SERVER['REQUEST_URI']);

        $routeMatched = false;

        foreach ($this->routes[$requestMethod] as $route => $controllerAction) {
            $pattern = preg_replace('/\{([^\/]+)\}/', '([^\/]+)', $route); // Replace {param} with a regex pattern
            if (preg_match("#^$pattern$#", $requestUri, $matches)) {
                array_shift($matches); // Remove the full match from the matches array
                $this->callAction($controllerAction, $matches);
                $routeMatched = true;
                break;
            }
        }

        if (!$routeMatched) {
            $this->sendNotFoundResponse();
        }
    }

    // Call the specified controller action
    private function callAction($controllerAction, $params = [])
    {
        [$controller, $action] = $controllerAction;

        if (class_exists($controller)) {
            $controllerObject = new $controller;

            if (method_exists($controllerObject, $action)) {
                // Call the action and pass the params
                call_user_func_array([$controllerObject, $action], $params);
            } else {
                $this->sendNotFoundResponse("Action $action not found");
            }
        } else {
            $this->sendNotFoundResponse("Controller $controller not found");
        }
    }

    // Send a 404 Not Found response
    private function sendNotFoundResponse($message = 'Route not found')
    {
        http_response_code(404);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['error' => $message]);
    }
}
