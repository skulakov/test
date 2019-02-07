<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 09.01.2019
   * Time: 0:18
   */

  namespace lib;


  class Validator {
    protected $data = [];
    private $db;
    protected $file;

    public function __construct() {
      $this->db = new DB();
      $this->file = new FileUpload();
    }

    public function login($array) {

      if (!$this->required(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email бязательно';
      }
      if (!$this->email(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email некорректный';
      }
      if (!$this->required(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Пароль обязательно';
      }
      if (!$this->minLength(trim($array['pass']), 6)) {
        $this->data['errorPass'][] = 'Не менее 6 символов';
      }
      if (!$this->alphaNum(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Только буквы и цифры латинский алфавит';
      }

      return $this->data;
    }

    public function registry($array) {
      if (!$this->required(trim($array['name']))) {
        $this->data['errorName'][] = 'Имя бязательно';
      }
      if (!$this->latCyr(trim($array['name']))) {
        $this->data['errorName'][] = 'Только буквы';
      }
      if (!$this->minLength(trim($array['name']), 2)) {
        $this->data['errorName'][] = 'Не менее 2 букв';
      }
      if (!$this->required(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email бязательно';
      }
      if (!$this->email(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email некорректный';
      }
      if (!$this->unique('users', 'email', trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email занят';
      }
      if (!$this->required(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Пароль обязательно';
      }
      if (!$this->minLength(trim($array['pass']), 6)) {
        $this->data['errorPass'][] = 'Не менее 6 символов';
      }
      if (!$this->alphaNum(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Только буквы и цифры латинского алфавита';
      }
      return $this->data;
    }

    public function remind($array) {

      if (!$this->required(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email бязательно';
      }
      if (!$this->email(trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email некорректный';
      }
      if (!$this->checked('users', 'email', trim($array['email']))) {
        $this->data['errorEmail'][] = 'Email не зарегтстрирован';
      }

      return $this->data;
    }

    public function createPost($array) {
      if (!$this->required(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Название бязательно';
      }
      if (!$this->latCyrNum(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Только буквы и цифры';
      }
      if (!$this->minLength(trim($array['title']), 2)) {
        $this->data['errorName'][] = 'Не менее 2 букв';
      }
      if (!$this->required(trim($array['text']))) {
        $this->data['errorText'][] = 'Текст бязательно';
      }
      if (!$this->file->requiredFile()) {
        $this->data['errorFile'][] = 'Файл обязательно';
      }
      if (!$this->file->checkExt()) {
        $this->data['errorFile'][] = 'Только JPG, PNG, GIF файлы';
      }
      if (!$this->file->checkSize()) {
        $this->data['errorFile'][] = 'Файл не более 5мб';
      }
      if (!$this->file->checkError()) {
        $this->data['errorFile'][] = 'Выбирете другой файл';
      }
      return $this->data;
    }

    public function editPost($array) {
      if (!$this->required(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Название бязательно';
      }
      if (!$this->latCyrNum(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Только буквы и цифры';
      }
      if (!$this->minLength(trim($array['title']), 2)) {
        $this->data['errorName'][] = 'Не менее 2 букв';
      }
      if (!$this->required(trim($array['text']))) {
        $this->data['errorText'][] = 'Текст бязательно';
      }
      if (!$this->num(trim($array['id']))) {
        $this->data['errorId'][] = 'Ошибка загрузки формы';
      }

      return $this->data;
    }

    public function editName($array) {

      if (!$this->required(trim($array['name']))) {
        $this->data['errorName'][] = 'Имя бязательно';
      }
      if (!$this->latCyr(trim($array['name']))) {
        $this->data['errorName'][] = 'Только буквы';
      }
      if (!$this->minLength(trim($array['name']), 2)) {
        $this->data['errorName'][] = 'Не менее 2 букв';
      }

      return $this->data;
    }

    public function editPass($array) {

      if (!$this->required(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Пароль обязательно';
      }
      if (!$this->minLength(trim($array['pass']), 6)) {
        $this->data['errorPass'][] = 'Не менее 6 символов';
      }
      if (!$this->alphaNum(trim($array['pass']))) {
        $this->data['errorPass'][] = 'Только буквы и цифры латинского алфавита';
      }
      if (!$this->required(trim($array['confirm']))) {
        $this->data['errorConfirm'][] = 'Повторить пароль';
      }
      if ($array['pass'] !== $array['confirm']){
        $this->data['errorConfirm'][] = 'Пароли не совпадают';
      }
      return $this->data;
    }

    public function editHome($array){
      if (!$this->required(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Название бязательно';
      }
      if (!$this->latCyrNum(trim($array['title']))) {
        $this->data['errorTitle'][] = 'Только буквы и цифры';
      }
      if (!$this->minLength(trim($array['title']), 1)) {
        $this->data['errorName'][] = 'Не менее 2 букв';
      }

      return $this->data;
    }





    /* ************************************************************************* */
    // Правила
    protected function required($array) {
      return !empty($array) ? true : false;
    }

    protected function num($array) {
      return ctype_digit($array) ? true : false;
    }

    protected function alpha($array) {
      return ctype_alpha($array) ? true : false;
    }

    protected function email($array) {
      return filter_var($array, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    protected function alphaNum($array) {
      return ctype_alnum($array) ? true : false;
    }

    protected function minLength($array, $arg) {
      return strlen($array) >= $arg ? true : false;
    }

    protected function maxLength($array, $arg) {
      return strlen($array) <= $arg ? true : false;
    }

    protected function latCyr($array) {
      return preg_match('/^[a-zA-Zа-яА-Я ]*$/u', $array) ? true : false;
    }

    protected function latCyrNum($array) {
      return preg_match('/^[a-zA-Zа-яА-Я0-9- ]*$/u', $array) ? true : false;
    }

    protected function unique($table, $col, $array) {
      return !$this->db->selectRow($table, $col, $array) ? true : false;
    }

    protected function checked($table, $col, $array) {
      return $this->db->selectRow($table, $col, $array) ? true : false;
    }

  }