<?php

namespace Oleh\ItMinsk\core\base;

class View
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $view = '', $layout = '')
    {
        $this->route = $route;
        $this->view = $view;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render(array|string $vars): void
    {
        if (is_array($vars))
            extract($vars);

        $file_view = APP . "/Views/" . $this->route['controller'] . "/{$this->view}.php";

        if (is_file($file_view)) 
        {
            require $file_view;
        } 
        else 
        {
            echo '<p>Не найден вид <b>' . $this->view . '</b></p>';
        }
    }
}
