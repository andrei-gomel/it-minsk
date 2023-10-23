<?php

namespace Oleh\ItMinsk\core;

class Router
{
    private $routes;
    private $route = [];

    public function __construct()
    {
        $this->routes = include ROOT . '/config/routes.php';
    }

    private function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) 
                {
                    if (is_string($key)) 
                    {
                        $route[$key] = $value;
                    }
                }

                if (!isset($route['action']))
                {
                    $route['action'] = 'index';
                }

                self::$route = $route;

                return true;
            }
        }
        return false;
    }

    public function run(): void
    {
        // Получаем строку запроса
        $uri = rtrim($this->getURI(), '?');

        //dd($uri);

        foreach ($this->routes as $uriPattern => $path) 
        {
            if (preg_match("~$uriPattern~", $uri)) 
            {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определяем какой контроллер и action обрабатывают запрос

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments);

                $this->route['controller'] = $controllerName;

                $controllerName = ucfirst($controllerName) . 'Controller';
              
                $actionName = ucfirst(array_shift($segments));

                $this->route['action'] = lcfirst($actionName);
            
                $parameters = $segments;

                //dd($parameters);

                // Подключаем файл класса-контроллера
                $controllerFile = 'Oleh\ItMinsk\\Controllers\\' . $controllerName . '.php';

                if (file_exists(APP . '/Controllers/' . $controllerName . '.php'))
                {
                    $controllerName = 'Oleh\ItMinsk\\Controllers\\' . $controllerName;

                    $controllerObject = new $controllerName($this->route);
                }

                // Создаем объект, вызываем метод(action)

                if(!empty($parameters[0]))
                $parameters = $parameters[0];
                //dd($parameters);

                $res = $controllerObject->$actionName($parameters);

                //$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                return;
            }
        }
    }
}
