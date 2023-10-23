<?php

namespace Oleh\ItMinsk\Controllers;

use Oleh\ItMinsk\core\base\Controller;
use Oleh\ItMinsk\Models\Image;

use Oleh\ItMinsk\Servises\PhotoServise;

class ImageController extends Controller
{
    protected $model;

    public function create(): void
    {
        $this->view = 'new-photo';

        $this->getView();
    }

    public function save(): void
    {
        $file = $_FILES['photo'];

        $name = strip_tags(trim($_POST['name']));

        $description = strip_tags(trim($_POST['description']));

        $album_id = $_POST['album_id'];

        $imgName = PhotoServise::createImageName($file);
       
        if (PhotoServise::uploadPhoto($file, $imgName))
        {
            $this->model = new Image();

            $res = $this->model->saveImage($name, $description, $album_id, $imgName);

            if ($res !== false)
                header('Location: /album/' . $album_id);

            else
                dd('Ошибка записи в БД');
        }        
    }    
}
