<?php

namespace application\model;
use Imagick;
use application\core\Model;

class Main extends Model
{
    public function postsCount()
    {
        if (@$_SESSION['admin']) {
            return $this->column('SELECT COUNT(id) FROM posts WHERE time > NOW() - INTERVAL 12 HOUR AND approve = 0');
        } else {
            return $this->column('SELECT COUNT(id) FROM posts WHERE time < NOW() - INTERVAL 12 HOUR OR approve = 1');
        }
    }

    public function postList($route)
    {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max)
        ];
   
       if (@$_SESSION['admin']) {
            return $this->row('SELECT * FROM posts   WHERE time > NOW() - INTERVAL 12 HOUR AND approve = 0 ORDER BY id DESC LIMIT :start, :max', $params);
       }
        return $this->row('SELECT * FROM posts   WHERE time < NOW() - INTERVAL 12 HOUR OR  approve = 1 ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function sendPost($params)
    {
        $state = $this->query('INSERT INTO posts (name, description, text, time) VALUES (:name, :description, :text, NOW() )',  $params);

    }

    public function getPost($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->row('SELECT * FROM posts WHERE id = :id',  $params);
    }

    public function uploadPicture($files, $id) {
		$img = new Imagick($files);
       
		$img->cropThumbnailImage(800, 560);
		$img->setImageCompressionQuality(80);
		$img->writeImage('application/pic/'.$id.'.jpg');
        $img->cropThumbnailImage(200, 140);
		$img->setImageCompressionQuality(100);
		$img->writeImage('application/pic/picture_'.$id.'.jpg');

	}
    public function getLastId()
    {
      return  $this->db->lastInsertId();
    }

}
