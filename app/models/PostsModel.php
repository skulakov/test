<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 15:56
   */

  namespace models;

  use lib\DB;

  class PostsModel extends DB {

    // Все посты
    public function getPosts($where = null, $limit = null) {

      $sql = "SELECT p.*, u.userName author, u.id user_id FROM posts p JOIN users u ON p.user_id = u.id";
      if ($where) {
        $sql .= " WHERE u.id = ?";
      }
      $sql .= " ORDER BY p.id DESC";
      if ($limit) {
        $sql .= " LIMIT $limit";
      }
      $sth = $this->db()->prepare($sql);
      if ($where) {
        $sth->execute([$where]);
      } else {
        $sth->execute();
      }

      return $sth->rowCount() ? $sth->fetchAll() : false;
    }

    public function lastPosts($limit) {
      $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT ?";
      $sth = $this->db()->prepare($sql);
      $sth->bindParam(1, $limit, \PDO::PARAM_INT);
      $sth->execute();
      return $sth->rowCount() ? $sth->fetchAll() : false;
    }

    // Один пост
    public function getOnePost($arg) {
      $sql = "SELECT p.*, u.userName author, u.id user_id FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ?";
      $sth = $this->db()->prepare($sql);
      $sth->execute([$arg]);
      return $sth->rowCount() ? $sth->fetch() : false;
    }

    // Добавление поста
    public function addPost($title, $text, $file, $user_id) {
      $sql = "INSERT INTO posts (title, text, file, user_id) VALUES (?, ?, ?, ?)";
      $sth = $this->db()->prepare($sql);
      $sth->execute([$title, $text, $file, $user_id]);
      return $sth->rowCount() ? true : false;
    }


    // Редактирование поста
    public function editPost($title, $text, $id) {

      $sql = "UPDATE posts SET title = ?, text = ?  WHERE id = ?";
      $sth = $this->db()->prepare($sql);
      $sth->execute([$title, $text, $id]);
      return $sth->rowCount() ? true : false;
    }

    // Удаление поста
    public function deletePost($id) {
      $sql = "DELETE FROM posts WHERE id = ?";
      $sth = $this->db()->prepare($sql);
      $sth->execute([$id]);
      return $sth->rowCount() ? true : false;
    }


  }