<?php

namespace Oleh\ItMinsk\Controllers;

use Oleh\ItMinsk\core\base\Controller;
use Oleh\ItMinsk\Models\Album;
use Oleh\ItMinsk\Models\Image;

class MainController extends Controller
{
    protected $model;

    public function index()
    {
        if($_SESSION['login'])
        {
            $this->model = new Album();

            $albums = $this->model->getAlbumsWithAutor();

            $this->model = new Image();

            $this->view = 'index';

            $this->set(compact('albums'));

            $this->getView();
        }
        else
        {
            header('Location: /user/login');
        }
    }
}