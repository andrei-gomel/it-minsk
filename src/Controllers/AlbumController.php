<?php

namespace Oleh\ItMinsk\Controllers;

use Oleh\ItMinsk\core\base\Controller;
use Oleh\ItMinsk\Models\Album;
use Oleh\ItMinsk\Models\Image;

class AlbumController extends Controller
{
    protected $model;
    
    /*
    *  Получаем список изображений в альбоме
    *
    */
    public function view(int $id): void
    {
        if ($_SESSION['login'] == '')
            header('Location: /user/login');         
        
        $_SESSION['album_id'] = $id;
        
        $this->model = new Album();

        $album = $this->model->findOne($id);
        $album = $album[0];

        $user_id = $_SESSION['id'];

        $this->model = new Image();

        $images = $this->model->getImagesByIdAlbum($id);

        $this->view = 'index';

        $this->set(compact('album', 'images', 'user_id'));

        $this->getView();
    }
    
    /*
    *  Создание нового альбома
    *
    */
    public function create(): void
    {
        $this->view = 'new-album';

        $this->getView();
    }
    
    /*
    *  Сохраняем новый альбом
    *
    */
    public function save(): void
    {
        $name = strip_tags(trim($_POST['name']));
        $description = strip_tags(trim($_POST['description']));

        $this->model = new Album();

        $res = $this->model->saveAlbum($name, $description);

        if($res !== false)
            header('Location: /');
        else
            dd('Ошибка записи в БД');       
    }
}
