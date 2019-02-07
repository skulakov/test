<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 16.01.2019
   * Time: 3:06
   */

  namespace models;

  use lib\DB;

  class HomeModel extends DB {
    public function getData() {
      $sql = "SELECT * FROM home";
      $sth = $this->db()->prepare($sql);
      $sth->execute();
      return $sth->rowCount() ? $sth->fetch() : false;
    }

    /**
     * @return bool|mixed
     *
     * Главная страница
     */
    public function getSiteName() {
      $sql = "SELECT site_name FROM home";
      $sth = $this->db()->prepare($sql);
      $sth->execute();
      return $sth->rowCount() ? $sth->fetch() : false;
    }

    public function editHomePage($title, $siteName, $desc, $text, $copy) {

      $sql = "UPDATE home SET title =?, site_name =?, `desc`=?, text=?, copyright=? ";
      $sth = $this->db()->prepare($sql);
      $sth->execute([$title, $siteName, $desc, $text, $copy]);
      return $sth->rowCount() ? true : false;
    }
  }