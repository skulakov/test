<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 10:55
     * Конфигуратор сайта
     */

    // Константы
    define('DF_METHOD', 'index'); // Метод в контроллере по умолчанию
    define('VIEWS', dirname(dirname(__DIR__)) . '/app/views/');
    
    
    define('SITE_URL', 'http://asdf.local');
    

    // Path
    define('ROOT', dirname(dirname(__DIR__)));
    define('APP', dirname(dirname(__DIR__)).'/app');
    // Подключение к базе данных
    define('DB_DRIVER', 'mysql'); // (EXC SUBSQL)
    define('DB_HOST', 'localhost'); // Хост
    define('DB_NAME', 'cms'); // Имя ДБ
    define('DB_CHARSET', 'utf8'); // Кодировка ДБ
    define('DB_USER', 'root'); // Пользователь
    define('DB_PASS', ''); // Пароль

// SMTP
    define('SMTP_HOST', 'smtp.mail.ru'); // Укажите основной и резервный SMTP-серверы
    define('SMTP_USER', 'kuseal64@mail.ru'); // SMTP username
    define('SMTP_PASS', 'Fvthbrfytw1964'); // SMTP password
    define('SMTP_PORT', 587);

    define('NUM_PASS', 7); // Колличество символов для восстановления пароля


