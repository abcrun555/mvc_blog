<?php

namespace application\model;

use application\core\Model;

class Admin extends Model
{

    public function loginValidate()
    {
        $admin = require 'application/config/admin.php';
        if ($admin['password'] == $_POST['password'] && $admin['user'] == $_POST['user']) {
            return true;
        } 
        return false;
    }

    public function deletePost($id)
    {
        $params = [
            'id' => $id
        ];

        $this->query('DELETE FROM posts WHERE id=:id', $params);
    }

    public function updatePost($id)
    {
        $params = [
            'id' => $id,
          
            'text' => $_POST['update'],
        ];
        $stop = $this->query('UPDATE posts  SET 
        text = :text  WHERE id=:id ', $params);
    }

    public function approvePost($id){
        $params = ['id' => $id,'approve'=>true];
        $this->query('UPDATE posts  SET approve=:approve WHERE id = :id',$params);

    }
}
