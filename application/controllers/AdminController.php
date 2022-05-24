<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;
use application\model\Main;

class AdminController extends Controller
{
public function __construct($route)
{
    parent::__construct($route);
    $this->view->style='admin';
}

    public function deleteAction()
    {
        $this->model->deletePost($this->route['id']);
        unlink("application/pic/".$this->route['id'].".jpg");
        unlink("application/pic/picture_".$this->route['id'].".jpg");
        header("location:/");
    }

    private function updateValidation($post)
    {
        if (!isset($post['update']) || iconv_strlen($post['update']) < 5 || !isset($post['update'])) {
            return "Размер публикации  должен быть не больше десяти тысяч символов и не меньше ста символов";
        }
    }

    public function updateAction()
    {
       $this->model->updatePost($this->route['id']);
        header("Location:/main/post/".$this->route['id']);
        
    }

    public function logoutAction()
    {
        
        $_SESSION = [];
        unset($_COOKIE[session_name('admin')]);
        session_destroy();
        header("location:/");
    }

    public function approveAction()
    {
        $this->model->approvePost($this->route['id']);
        header("location:/");                 
    }
}

