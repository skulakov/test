<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 11:25
   *
   * Дочерний класс класса Controller
   * Вывод всех постов, вывод одного поста, добавление, редактирование, удаление постов
   */

  namespace controllers;


  use lib\Controller; //Создание псевдонима имени

  class Posts extends Controller {

    // Вывод всех постов
    public function index($page = null) {

      $this->pagination->setCountPage(3);
      if ($dataPgn = $this->pagination->pages($page)) {
        $data['posts'] = $dataPgn['content'];
        $data['pageCount'] = $dataPgn['pageCount'];
        $data['pageNum'] = !$page?1:$page;
      }
      $data['lastPosts'] = $this->postModel->lastPosts(4);
      $data['title'] = 'Posts';


      $this->display('posts/posts_page', $data);
    }

    // Вывод одного поста
    public function post($id) {
      if(!$data['post'] = $this->postModel->getOnePost($id)){
        header('Location: /posts');
      }
      $data['post'] = $this->postModel->getOnePost($id);
      $data['title'] = $data['post']['title'];
      $data['lastPosts'] = $this->postModel->lastPosts(4);
      $this->display('posts/post_page', $data);
    }

    // Добавление поста
    public function addPost() {
      checkSessUser();
      $data['user'] = $_SESSION['user'];

      if (!empty($_POST)) {
        //
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //

        $dataError = $this->validator->createPost($_POST);

        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError['errorTitle'])) {
            $data['errorTitle'] = $dataError['errorTitle'][0];
          }
          if (isset($dataError['errorText'])) {
            $data['errorText'] = $dataError['errorText'][0];
          }
          if (isset($dataError['errorFile'])) {
            $data['errorFile'] = $dataError['errorFile'][0];
          }

        } else {
          //
          $post = checkInput($_POST);
          // Загрузка файла
          if ($file = $this->file->fileUpload(900, 450)) {
            // Добавить в DB
            if ($this->postModel->addPost("{$post['title']}", "{$post['text']}", "{$file}", "{$data['user']['id']}")) {
              header('Location: /account');
            }
            echo 'Yes';
          }

        }
      }
      $data['title'] = 'Create Post';
      $this->display('posts/add_post_page', $data);
    }

    // Редактирование поста
    public function editPost($id) {
      checkSessUser();
      $data['user'] = $_SESSION['user'];
      $data['post'] = $this->postModel->getOnePost($id);
      if (!empty($_POST)) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dataError = $this->validator->editPost($_POST);
        // Вывод ошибок при заполнении формы
        if (!empty($dataError)) {
          if (isset($dataError['errorTitle'])) {
            $data['errorTitle'] = $dataError['errorTitle'][0];
          }
          if (isset($dataError['errorText'])) {
            $data['errorText'] = $dataError['errorText'][0];
          }
          if (isset($dataError['errorId'])) {
            $data['errorId'] = $dataError['errorId'][0];
          }
        } else {
          //
          $post = checkInput($_POST);
          // Добавить в DB
//preData($post);
          if ($this->postModel->editPost($post['title'], $post['text'], $post['id'])) {
            header('Location: /account');
          }else{
            $data['errorInfo'] = 'Данные не обновились';
          }
        }
      }
      $data['title'] = 'Добавить пост';
      $this->display('posts/edit_post_page', $data);
    }

    //Удаление поста
    public function deletePost($id) {
      checkSessUser();
      $data['user'] = $_SESSION['user'];
      if ($post = $this->postModel->getOnePost($id)) {
        // Проверка на право удаления

          // Удаление записи из базы
          if ($this->postModel->deletePost($id)) {
            $file = ROOT . '/img/upload/' . $post['file'];
            $fileTmb = ROOT . '/img/upload/tmb/' . $post['file'];
            // Удаление файла из папки
            if (file_exists($file)) {
              unlink($file);
            }
            if (file_exists($fileTmb)) {
              unlink($fileTmb);
            }
            header('Location: /account');
        } else {
          header('Location: /account');
        }
      } else {
        header('Location: /account');
      }
    }
  }