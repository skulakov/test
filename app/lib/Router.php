<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 11:26
     *
     * Маршрутиризатор
     */

    namespace lib;
    // Глобальная область видимости


    class Router {
        private $routes; // Массив с маршрутами
        private $segments; // Массив маршрута
        private $fileName; // Имя файла контроллера
        private $file; // Файл контроллера
        private $class; // Класс файла контроллера
        private $classObject; // Объект класса контроллера
        private $method; // Метод класса контроллера
        private $arg; // Аргументы


        public function __construct() {
            // Подключение массива с маршрутами
            $this->routes = require_once APP. '/config/routes.php';

        }

        public function run() {
            $url = $this->getUrl();
            // Если URL совпадает с маршрутом в файле /app/config/routes.php
            if ($this->distPath($url)) {
                // Массив с внутренним маршрутом
                $this->segments = explode('/', $this->distPath($url));
                // Название контроллера (первый элемент массива маршрутов)
                $this->fileName = ucfirst(array_shift($this->segments));
                // Путь к контроллеру
                $this->file = APP.'/controllers/' . $this->fileName . '.php';
            } else {  
                $this->error();
            }

            // Проверка файла контроллера
            if (file_exists($this->file)) {
                // Глобальная область видимости
                $this->class = "\\controllers\\" . $this->fileName;
                
            } else {
                
                // Если файла не существует, вывод ошибки 404
                $this->error();
            }

            // Проверка на существование класса контроллера перед его объявлением
            if (class_exists($this->class)) {
                // Создание объекта класса контроллера
                $this->classObject = new $this->class;
                // Определение метода в классе из массива маршрутов
                $this->method = array_shift($this->segments);
                // Если метод не определен, тогда дефолтный метод (константа в файле /app/config/config.php
                $this->method = !$this->method ? DF_METHOD : $this->method;
            } else {
                // Если класса не существует, вывод ошибки 404
                $this->error();
            }

            // Проверка, существует ли метод класса в объекте $this->classObject
            if (method_exists($this->classObject, $this->method)) {
                // Аргументы
                $this->arg = $this->segments;
            } else {
             
                // Если метода не существует, вывод ошибки 404
               $this->error();
            }

            // Вызываем метод $this->classObject->$this->method с аргументами
            return call_user_func_array([$this->classObject, $this->method], $this->arg);
        }

        /**
         * Returns request string
         * @return string
         *
         * Обрабатка URL запроса
         */
        private function getUrl() {
            // Преобразование строки запроса в массив
            $parser = explode('/', trim($_SERVER['QUERY_STRING'], '/'));
            if ($parser[0] == 'index.php') {
                array_shift($parser);
            }
            return implode('/', $parser);
        }

        /**
         * @param $url
         * @return string|string[]|null
         *
         *  Сравнение и замена мфршрута с внешнего на внутренний
         */
        private function distPath($url) {
            foreach ($this->routes as $urlPattern => $path) {
                // Проверка на соответствие регулярному выражению из массива /app/config/routes.php
                if (preg_match("#$urlPattern#", $url)) {
                    // Поиск и замена по регулярному выражению из массива /app/config/routes.php
                    $internalRoute = preg_replace("#$urlPattern#", $path, $url);
                    return $internalRoute;
                    break;
                }
            }
            return false;
        }

        /**
         * Return error 404
         */
        public function error() {
            header($_SERVER['SERVER_PROTOCOL'] . 'HTML/1.0 404 Not found');
            die('<h2>Ошибка 404</h2><h3>Нет страницы</h3>');
        }

    }