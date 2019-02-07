<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 23:16
   *
   * Дочерний класс класса Controller
   * Главная страница, фото галерея
   */

  namespace controllers;


  use lib\Controller;

  class Home extends Controller {
   // Главная
    public function index(){
      $data['title'] = 'Home';
      $data['home'] = $this->homeModel->getData();
      $data['posts'] = $this->postModel->lastPosts(4);
      $this->display('home/home_page', $data);
      
    }
    public function editHome(){
      checkSessUser();
      $data['user'] = $_SESSION['user'];
      $data['home'] = $this->homeModel->getData();
      if($data['user']['status_id'] !== 1){
        header('Location: /account');
      }
      if (!empty($_POST)) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dataError = $this->validator->editHome($_POST);
        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError['errorTitle'])) {
            $data['errorTitle'] = $dataError['errorTitle'][0];
          }
        } else {
          //
          $post = checkInput($_POST);
          // Добавить в DB
          //preData($post);
          if ($this->homeModel->editHomePage($post['title'], $post['siteName'], $post['desc'], $post['text'], $post['copy'])) {
            header('Location: /account');
          }else{
            $data['errorInfo'] = 'Данные не обновились';
          }
        }
      }
      $data['title'] = 'Edit home page';
      $this->display('home/edit_home_page', $data);
    }
    // Галерея
    public function gallery(){
      $data['title'] = 'Oops ):';
      $this->display('home/gallery_page', $data);
    }

  }

