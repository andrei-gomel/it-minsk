<?php

namespace Oleh\ItMinsk\Controllers;

use Oleh\ItMinsk\core\base\Controller;
use Oleh\ItMinsk\Models\User;
use Oleh\ItMinsk\Servises\ValidateData;

class UserController extends Controller
{
    protected $model;
    
    public function __construct($route)
    {
        //$this->model = new User();

        //dd($this->model);

        parent::__construct($route);
    }
    
    public function index()
    {
        echo 'UserController<br>';
        //var_dump(__METHOD__);

        dd($this->route);
    }

    public function login(): void
    {
        //echo 'UserController<br>';
        //var_dump(__METHOD__);
        //$this->set(compact('title', 'tickets'));
        //dd($this->view,0);
        $this->getView();
    }

    public function login_process(): void
    {
        $data = $_POST;

        if(ValidateData::checkLoginParams($data))
        {

            $data['password'] = md5($data['password']);

            $user = $this->loginUser($data);
            
            if($user === false)
            {
                $error['loginError'] = 'Не верный логин или пароль';

                $this->route['action'] = 'login';

                $this->view = 'login';

                $this->set($error['loginError']);
                //dd($error['loginError']);
            }
            else
            {

                if(isset($user->login))
                {
                    $_SESSION['login'] = $user->login;

                    $_SESSION['id'] = $user->id;
                }
                

                $this->route['controller'] = 'main';

                $this->route['action'] = '';

                $this->view = 'index';

                //$this->getView();  

                header('Location: /');
            }

                     
        }
        else
        {
            $this->route['action'] = 'login';

            $this->view = 'login';

            $this->set($_SESSION['loginError']);

            unset($_SESSION['loginError']);

            $this->getView();
        }
    }

    public function logout(): void
    {
        unset($_SESSION);

        $this->route['controller'] = 'main';

        $this->route['action'] = '';

        $this->view = 'index';

        $this->getView();
    }
    
    public function register()
    {
        echo 'UserController<br>';
        var_dump(__METHOD__);
    }

    public function register_process()
    {
        echo 'UserController<br>';
        var_dump(__METHOD__);
    }

    public function loginUser(array $data): object|bool
    {
        $this->model = new User();

        $user = $this->model->getUser($data);
        //dd($user);

        return $user;
    }
}
