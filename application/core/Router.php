<?php

namespace application\core;

use application\core\Controller;
use application\core\View;

class Router
{
    public $parameters;
    public $routes;

    public function __construct()
    {
        $this->routes = require 'application/config/routes.php';
    }

    public function match()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $param) {
            if (preg_match($route, $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        if (is_numeric($value)) {
                            $value = (int)$value;
                            $param[$key] = $value;
                        }
                    }
                }
                $this->parameters = $param;
                return true;
            }
        }
        return false;
    }


    public function run()
    {

        if ($this->match()) {
            $controller = 'application\controllers\\' . ucfirst($this->parameters['controller']) . 'Controller';
            if (class_exists($controller)) {
                $action = $this->parameters['action'] . 'Action';
                if (method_exists($controller, $action)) {
                    $controller = new $controller($this->parameters);
                    $controller->$action();
                } else {
                    View::errorView(404);
                }
            } else {
                View::errorView(405);
            }
        } else {;
            View::errorView(406);
        }
    }
}

