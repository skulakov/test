<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 21:49
     */

    namespace models;


    use lib\DB;

    class UsersModel extends DB {

      /**
       * @param $email
       * @return bool|mixed
       *
       * Проверка Email, вывод всех данных
       */
      public function checkEmail($email) {
            $sql = "SELECT * FROM users WHERE email = ?";
            $sth = $this->db()->prepare($sql);
            $sth->execute([$email]);
            return $sth->rowCount()?$sth->fetch():false;
        }

      /**
       * @param $email
       * @param $pass
       * @return bool|mixed
       *
       * Проверка Email, пароля, вывод всех данных
       */
      public function checkLoginPass($email, $pass) {
            if($this->checkEmail($email)){
                $result = $this->checkEmail($email);
                $hash = $result['pass'];
                return password_verify($pass, $hash) ? $result : false;
            }
            return false;
        }

      /**
       * @param $name
       * @param $email
       * @param $pass
       * @return bool
       *
       * Регистрация пользователя
       */
      public function registryUser($name, $email, $pass) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (userName, email, pass) VALUES (?, ?, ?)";
            $sth = $this->db()->prepare($sql);
            $sth->bindParam(1, $name, \PDO::PARAM_STR);
            $sth->bindParam(2, $email, \PDO::PARAM_STR);
            $sth->bindParam(3, $pass, \PDO::PARAM_STR);
            $sth->execute([$name, $email, $pass]);
            return $sth->rowCount() ? true : false;
        }

      /**
       * @param $name
       * @param $id
       * @return bool
       *
       * Изменение имени пользователя
       */
      public function editUserName($name, $id ){
            $sql = "UPDATE users SET userName = ? WHERE id = ?";
            $sth = $this->db()->prepare($sql);
            $sth->bindParam(1, $name, \PDO::PARAM_STR);
            $sth->bindParam(2, $id, \PDO::PARAM_INT);
            $sth->execute([$name, $id]);
            return $sth->rowCount() ? true : false;
        }

      /**
       * @param $pass
       * @param $id
       * @return bool
       *
       * Изменение пароля пользователя
       */
      public function editUserPass($pass, $id ){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET pass = ? WHERE id = ?";
        $sth = $this->db()->prepare($sql);
        $sth->bindParam(1, $pass, \PDO::PARAM_STR);
        $sth->bindParam(2, $id, \PDO::PARAM_INT);
        $sth->execute([$pass, $id]);
        return $sth->rowCount() ? true : false;
      }
    }