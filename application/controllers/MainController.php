<?php

namespace application\controllers;

use application\model\Main;
use application\lib\Pagination;
use application\core\Controller;

class MainController extends Controller
{

    public function aboutAction()
    {
        $this->view->render('О нас');
    }
    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->postsCount());
        $pagination = $pagination->getLinks();
        $list = $this->model->postList($this->route);
        
        $vars = ['list' => $list, 'pagination' => $pagination];
        $this->view->render('Главная', $vars);
    }

    public function contactAction()
    {
        $this->view->render('Контакты');
    }

    public function postAction()
    {
        $panel = NULL;
        if (@$_SESSION['admin']) {
            $panel = 'application/view/admin/adminpanel.php';
        }
        $post =  $this->model->getPost($this->route['id'])[0];
        $vars = [
            'panel' => $panel,
            'post'  => $post,
        ];
        $this->view->render('Пост', $vars);
    }


    public function loginAction()
    {
        if ($_SESSION['admin'] ?? false) {
            header('Location:/');
        } else {
            if (isset($_POST['password'])) {
                $admin = require 'application/config/admin.php';
                if (($_POST['login'] == $admin['login'])    &&  ($_POST['password'] == $admin['password'])) {
                    $_SESSION['admin'] = true;
                    header('Location:/');
                } else {
                    header('Location:/');
                }
            } else {
                $this->view->render('Логин');
            }
        }
    }

    private function validatePost($post)
    {
        $errors = array();
        if (iconv_strlen($post['name']) < 5 || !isset($post['name'])) {
            $errors['name'] = "имя должно состоять не меньше, чем из пяти символов";
        }
        if (iconv_strlen($post['description']) < 5 || iconv_strlen($post['description']) > 100 || !isset($post['description'])) {
            $errors['description'] = "описание должно состоять не меньше, чем из пяти симовлов и не больше, чем из ста символов";
        }
        if (iconv_strlen($post['text']) < 100 || iconv_strlen($post['text']) > 10000 || !isset($post['text'])) {
            $errors['text'] = "Размер публикации  должен быть не больше десяти тысяч символов и не меньше ста символов";
        }
        if (!$_FILES['pic']['tmp_name']) {
            $errors['picture'] = "Пожалуйста, загрузите иллюстрацию";
        }
        return $errors;
    }

    public function sendAction()
    {
        if ($_POST['send'] ?? false) {
            if ($errors = $this->validatePost($_POST)) {
                $vars = ['errors' => $errors];
                $this->view->render("Сделать пост", $vars);
            } else {
                $params = [
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'text' => trim($_POST['text']),
                ];
                $this->model->sendPost($params);
                $id = $this->model->getLastId();
                $this->model->uploadPicture($_FILES['pic']['tmp_name'], $id);
                $_SESSION['sent'] = true;
                header('Location:/');
            }
        } else {
            $this->view->render("Сделать пост");
        }
    }
}

