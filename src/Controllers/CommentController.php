<?php

namespace Oleh\ItMinsk\Controllers;
use Oleh\ItMinsk\core\base\Controller;
use Oleh\ItMinsk\Models\Comment;
use Oleh\ItMinsk\Models\Image;

class CommentController extends Controller
{
    protected $model;
    
    public function view(int $id)
    {
        $this->model = new Image();

        $image = $this->model->findOneWithAutor($id);

        $this->model = new Comment();

        $comments = $this->model->findCommentByImageId($id);

        $this->view = 'index';

        $this->set(compact('image', 'comments'));

        $this->getView();

    }
    
    public function save()
    {
        $image_id = $_POST['image_id'];

        $user_id = $_POST['user_id'];

        $text = strip_tags(trim($_POST['text']));

        $this->model = new Comment();
        
        $res = $this->model->saveComment($image_id, $user_id, $text);

        if ($res !== false)
            header('Location: /comment/' . $image_id);
        else
            dd('Ошибка записи в БД');
    }
}
