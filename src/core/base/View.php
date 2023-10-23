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

        //dd($this->layout,0);
        //dd($this->view);

    }

    public function render(array|string $vars): void
    {
        //dd($vars,0);

        if (is_array($vars))
            extract($vars);

        $file_view = APP . "/Views/" . $this->route['controller'] . "/{$this->view}.php";
        //dd($file_view);
        //ob_start();

        if (is_file($file_view)) 
        {
            require $file_view;
        } 
        else 
        {
            echo '<p>Не найден вид <b>' . $this->view . '</b></p>';
        }

        //$content = ob_get_clean();

        /*
        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";

            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo '<p>Не найден шаблон <b>' . $this->layout . '</b></p>';
            }
        }
        */
    }
}
