<?php

namespace vendor\core;

//use vendor\core\Registry;
use vendor\core\ErrorHandler;
//use vendor\libs\rb;

class App
{
    public static $app;

    public function __construct()
    {
        //self::$app = Registry::instance();

        new ErrorHandler;

        /*require_once LIBS . '/rb.php';

		\R::setup('mysql:host=localhost;dbname=video_consult;charset=utf8', 'root', '');

		\R::freeze(true);*/
    }
}
