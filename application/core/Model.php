<?php

namespace application\core;

use PDO;

class Model
{

    protected $db;
    public function __construct()
    {
        $config = require 'application/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password']);
       
    }

    public function query($sql, $params = [])
    {
        $state = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $state->bindValue(':' . $key, $value, $type);
            }
        }
        $state->execute();
        return $state; 
    }

    public function row($sql, $params = [])
    {
        $state = $this->query($sql, $params);

        return $state->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $state = $this->query($sql, $params);
        return  $state->fetchColumn();
    }
    
}
