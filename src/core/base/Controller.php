<?php

namespace Oleh\ItMinsk\core\base;

abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        
        $this->view = $route['action'];
        //include APP . "/views/". ucfirst($route['controller']) . "/{$this->view}.php";
    }

    public function getView()
    {
        $viewObj = new View($this->route, $this->view, $this->layout);
        $viewObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}
