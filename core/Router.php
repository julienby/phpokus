<?php

namespace Core;

class Router {
    private $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    private function loadRoutes() {
        $this->routes = require '../config/routes.php';
    }

    public function run() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if ($url !== '/' && strpos($url, '/') !== 0) {
            $url = '/' . $url;
        }

        $routeFound = false;

        foreach ($this->routes as $route => $controllerAction) {
            // Remplace les paramètres dynamiques {param} par des expressions régulières
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route);
            $pattern = '#^' . rtrim($pattern, '/') . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Supprime la correspondance complète

                list($controllerName, $methodName) = explode('@', $controllerAction);
                $controllerPath = '../app/controllers/' . $controllerName . '.php';

                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                    $controllerClass = "App\\Controllers\\" . $controllerName;
                    $controllerObject = new $controllerClass();

                    if (method_exists($controllerObject, $methodName)) {
                        call_user_func_array([$controllerObject, $methodName], $matches);
                        $routeFound = true;
                        break;
                    } else {
                        echo "Method $methodName not found!";
                    }
                } else {
                    echo "Controller $controllerName not found!";
                }
            }
        }

        if (!$routeFound) {
            echo "No route matched.";
        }
    }
}

