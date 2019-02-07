<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 15:14
     */

    namespace lib;


    class DB {
        private $_pdo = null;

        protected function db() {
            // Дефолтные опции
            $opt = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];
            // База данных
            $dsn = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            // Подключение к MySQL
            if ($this->_pdo == null) {
                $this->_pdo = new \PDO($dsn, DB_USER, DB_PASS, $opt);
            }
            return $this->_pdo;
        }

        public function selectRow($table, $col, $arg){
            $sql = "SELECT * FROM {$table} WHERE {$col} = ?";
            $sth = $this->db()->prepare($sql);
            $sth->execute([$arg]);
            return $sth->rowCount()?$sth->fetch():false;
        }
    }