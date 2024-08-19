<?php

class Router {
    private $routes = [];

    public function __construct() {
        $this->routes = require '../config/routes.php';
    }

    public function run() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';
        $url = filter_var($url, FILTER_SANITIZE_URL);

        echo "URL requested: " . $url . "<br>";

        foreach ($this->routes as $route => $controllerAction) {
            // Si la route est '/', on la fait correspondre explicitement
            if ($route === '/') {
                $pattern = '#^/$#';
            } else {
                $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([a-zA-Z0-9-_]+)', $route);
                $pattern = '#^' . rtrim($pattern, '/') . '$#';
            }

            echo "Checking route: " . $route . " against pattern: " . $pattern . "<br>";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                list($controller, $method) = explode('@', $controllerAction);

                echo "Route matched! Controller: " . $controller . ", Method: " . $method . "<br>";

                if (file_exists('../app/controllers/' . $controller . '.php')) {
                    require_once '../app/controllers/' . $controller . '.php';
                    $controllerObject = new $controller();

                    if (method_exists($controllerObject, $method)) {
                        call_user_func_array([$controllerObject, $method], $matches);
                        return;
                    } else {
                        echo "Method $method not found!";
                        return;
                    }
                } else {
                    echo "Controller $controller not found!";
                    return;
                }
            }
        }

        echo "No route matched.";
    }
}
