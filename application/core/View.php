<?php

namespace application\core;

class View
{
  public $route;
  public $layout = 'application/view/layout/default.php';
  public $logout = false;
  public $adminpanel = false;

  public function __construct($route)
  {
    $this->route = $route;
    if ($_SESSION['admin'] ?? false) {
      $this->logout = 'application/view/admin/logout.php';
      $this->adminpanel = 'application/view/admin/adminpanel.php';
      $this->layout = 'application/view/layout/admin.php';
    }
  }

  public function render($title, $vars = [])
  {
    extract($vars);
    $path = 'application/view/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';
    ob_start();
    require $path;
    $content = ob_get_clean();
    require  $this->layout;
  }

  static public function errorView($number)
  {
    $vars = [
      'number' => $number
    ];
    require 'application/view/errors/error.php';
  }
}
