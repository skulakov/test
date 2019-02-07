<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 10.01.2019
   * Time: 1:17
   */

  namespace controllers;


  use lib\Controller;

  class Account extends Controller {
    public $user = [];

    public function __construct() {
      parent::__construct();
      // Проверка на авторизацию
      checkSessUser();
    }

    public function index() {
      $data['title'] = 'Account';
      $data['user'] = $this->userModel->checkEmail($_SESSION['user']['email']);
      $data['home'] = $this->homeModel->getData();
      // Вызов постов пользователя
      $data['posts'] = $this->postModel->getPosts($data['user']['id']);
      $this->display('acc/acc_page', $data);
    }

    public function admin() {

    }

    //Профиль
    public function profile() {
      $data['title'] = 'Профиль';
      $data['user'] = $this->userModel->checkEmail($_SESSION['user']['email']);
$data['home'] = $this->homeModel->getData();
      if (!empty($_POST)) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $post = checkInput($_POST);
        if (isset($_SESSION['info'])) {
          unset($_SESSION['info']);
        }


        switch ($_POST['edit']) {

          case 'name':

            $dataError = $this->validator->editName($_POST);
            if (!empty($dataError)) {
              if (isset($dataError['errorName'])) {
                $data['errorName'] = $dataError['errorName'][0];
              }
            } else {
              if ($this->userModel->editUserName($post['name'], $data['user']['id'])) {
                $_SESSION['info'] = 'Имя изменено успешно';
                $data['info'] = $_SESSION['info'];
              }
            }
            break;
          case 'pass':
            $dataError = $this->validator->editPass($_POST);
            if (!empty($dataError)) {
              if (isset($dataError['errorPass'])) {
                $data['errorPass'] = $dataError['errorPass'][0];
              }
              if (isset($dataError['errorConfirm'])) {
                $data['errorConfirm'] = $dataError['errorConfirm'][0];
              }
            } else {
              if ($this->userModel->editUserPass($post['pass'], $data['user']['id'])) {
                $_SESSION['info'] = 'Пароль изменен успешно';
                $data['info'] = $_SESSION['info'];
              }
            }
            break;
        }
      }
      $this->display('acc/acc_profile_page', $data);
    }


    // Удаление профиля
    public function deleteProfile() {

    }
  }