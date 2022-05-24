<?php

namespace application\core;

use application\core\View;

class Controller
{
    public $view;
    public $route;
    private $acs;

    public function __construct($params)
    {
        $this->route = $params;
        $this->acs = require 'application/access/' . $this->route['controller'] . '.php';
        if (!$this->access()) {
          
            exit("<h2>Error: 404</h2>");
        }
            $this->view = new View($params);
            $this->model = $this->loadModel($this->route['controller']);
        
    }

    public function loadModel($modelname)
    {

        $class = 'application\model\\' . ucfirst($modelname);
        return new $class;
    }

    public function access()
    {
        if ($this->isAccessed('all')) {
            return true;
        }
        if ($this->isAccessed('guest') &&  (@ !$_SESSION['admin'] )) {
            return true;
        }
        if ($this->isAccessed('admin') && $_SESSION['admin']) {
            return true;
        }
        return false;
    }
    public function isAccessed($key)
    {
        if (in_array($this->route['action'], $this->acs[$key])) {
            return true;
        }
        return false;
    }
}

