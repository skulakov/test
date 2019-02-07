<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 21:30
   */

  namespace controllers;

  //Создание псевдонима имени сласса или функции
  use lib\Controller;
  use lib\Email;

  class Login extends Controller {
    public function __construct() {
      parent::__construct();
    }

    // Вход
    public function login() {
      // Переадресация при авторизированном пользователе
      if (isset($_SESSION['user'])) {
        header('Location: /account');
      }
      // Проверка массива при отправке формы методом POST
      if (!empty($_POST)) {
        // Фильтрация массива
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Проверка заполнения формы класс Validator
        $dataError = $this->validator->login($_POST);
        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError ['errorEmail'])) {
            $data['errorEmail'] = $dataError['errorEmail'][0];
          }
          if (isset($dataError['errorPass'])) {
            $data['errorPass'] = $dataError['errorPass'][0];
          }
        } else {
          // Проверка регистрации
          if ($data['user'] = $this->userModel->checkLoginPass($_POST['email'], $_POST['pass'])) {
            // Открытие Сессии с массивом данных пользователя
            if (!isset($_SESSION)) {
              session_start();
            }
            $_SESSION['user'] = $data['user'];
            // Переадресация при успешной авторизации
            header('Location: /account');
          } else {
            // Вывод ошибок
            $data['errorInfo'] = 'Неверный логин или пароль';
          }
        }
      }
      // Шаблон и страница сайта с переменными
      $data['title'] = 'Вход';
      $this->display('login/login_page', $data);
    }

    // Регистрация
    public function regUser() {
      // Переадресация при авторизированном пользователе
      if (isset($_SESSION['user'])) {
        header('Location: /');
      }
      // Проверка массива полученного методом POST при отправке формы
      if (!empty($_POST)) {
        // Санитанизация массива
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Проверка заполнения формы класс Validator

        $dataError = $this->validator->registry($_POST);
        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError['errorName'])) {
            $data['errorName'] = $dataError['errorName'][0];
          }
          if (isset($dataError['errorEmail'])) {
            $data['errorEmail'] = $dataError['errorEmail'][0];
          }
          if (isset($dataError['errorPass'])) {
            $data['errorPass'] = $dataError['errorPass'][0];
          }
        } else {
          $post = checkInput($_POST);
          // Регистрация
          if ($this->userModel->registryUser($post['name'], $post['email'], $post['pass'])) {
            // Переадресация при успешной регистрации
            header('Location: /login');
          } else {
            $data['errorInfo'] = 'Не правильно заполнены данные';
          }
        }
      }
      // Шаблон и страница сайта с переменными
      $data['title'] = 'Регистрация';
      $this->display('login/reg_page', $data);
    }

    // Напоминание пароля
    public function remind() {
      if (!empty($_POST)) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $dataError = $this->validator->remind($_POST);
        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError['errorEmail'])) {
            $data['errorEmail'] = $dataError['errorEmail'][0];
            $data['errorInfo'] = 'Не правильно заполнена фома';
          }
        } else {
          // Проверка Эл. адреса в БЛ
          if ($user = $this->userModel->checkEmail(trim($_POST))) {
            $to = $user['email'];
            $toName = $user['userName'];
            // Аргумент для обратной ссылки
            $code = passGenerator(NUM_PASS);
            // Изменение пароля в DB
            if ($this->userModel->editUser($user['userName'], $code, $user['id'])) {
              // Отправка сообщения Email() класс /app/lib/Email
              if ($this->email->sendRemind("{$to}", "{$toName}", "{$code}")) {
                if (!$_SESSION) {
                  session_start();
                }
                $_SESSION['info'] = 'На ваш Email выслан новый пароль';
                header('Location: /login');
              }

            } else {
              $data['errorInfo'] = 'Не правильно заполнена фома';
            }
          } else {
            $data['errorInfo'] = 'Не правильно заполнена фома';
          }
        }
      }
      // Шаблон и страница сайта с переменными
      $data['title'] = 'Напоминание пароля';
      $this->display('login/remind_page', $data);
    }

    public function logout() {
      if (session_unset()) {
        header('Location: /');
      }
    }

  }