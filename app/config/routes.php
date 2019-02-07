<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 11:25
   *
   * Маршруты
   * Массив: ключ( URL ) => значение ( внутренний путь к контроллеру)
   */

  return [
    //    'vasya/([a-z]+)/([0-9]+)' => 'vasya/view/$1/$2',
    //    'news' => 'news/index',
    // user Account
      'account' => 'account',
      'profile' => 'account/profile',

    // Login
      'login' => 'login/login',
      'registry' => 'login/regUser',
      'remind' => 'login/remind',
      'logout' => 'login/logout',

    // Post
      'edit_post/([0-9])' => 'posts/editPost/$1',
      'delete_post/([0-9])' => 'posts/deletePost/$1',
      'add_post' => 'posts/addPost',
      'post/([0-9])' => 'posts/post/$1',
      'page/([0-9])' => 'posts/index/$1',
      'posts' => 'posts/index',
    // Home
      'gallery' => 'home/gallery',
      'edit_home' => 'home/editHome',
      '' => 'home/index'
  ];