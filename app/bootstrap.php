<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 10:56
     * Загрузчик
     */

  // Подключение ошибок
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if (!isset($_SESSION)) {
        session_start();
    }

    require_once 'config/config.php';
    require_once 'lib/fnc.php';

    spl_autoload_register(function ($class) {

        $file = APP. '/' . str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        }
    });

// Подключение класса Router
    $router = new \lib\Router();
    $router->run();

