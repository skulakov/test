<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 08.01.2019
     * Time: 21:04
     */

    // // Транслитерация
    function rus2translit($string) {
        $converter = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '\'',
            'ы' => 'y',
            'ъ' => '\'',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ь' => '\'',
            'Ы' => 'Y',
            'Ъ' => '\'',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',

//            ' ' => '_',
//            ',' => '',
//            '(' => '_',
//            ')' => '_',
        ];
        return mb_strtolower(strtr($string, $converter));
    }

    /**
     * @param $str
     * @return string|string[]|null
     *
     * Транслит заголовка в URL
     */
    function str2url($str) {
        // переводим в транслит
        $str = rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "_"
        $str = preg_replace('/[^-a-z0-9_]+/u', '_', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    //
    /**
     * @param $array
     * @return array
     *
     * Санитанизация массива данных формы
     */
    function checkInput($array) {
        $post = [];
        foreach ($array as $key => $value) {
            $post[$key] = htmlspecialchars(trim($value));
        }
        return $post;
    }


    /**
     * @param $num
     * @return bool|string
     *
     * Генератор паролей
     */
    function passGenerator($num) {
        $str = '01234567890123456789';
        $str .='BCDFGHJKLMNPQRSTVWXYZAEIOU';
        $str .='01234567890123456789';
        $str .=mb_strtolower('BCDFGHJKLMNPQRSTVWXYZAEIOU');
        $a = strlen($str) - $num;
        return substr(str_shuffle($str),$a);
    }

    function preData($data){
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

  /**
   *Переадресация на /login, если пользователь не авторизировался
   */
  function checkSessUser(){
      if (!isset($_SESSION['user'])) {
        header('Location: /login');
      }
    }

  /**
   * @param $date
   * @return false|string
   *
   * Фомат даты d-m-Y H:i
   */
  function allDateFormat($date) {
    $date = date_create($date);
    return date_format($date, "d-m-Y H:i");
  }
  /**
   * @param $date
   * @return false|string
   *
   * Фомат даты d-m-Y
   */
  function dmyDateFormat($date) {
    $date = date_create($date);
    return date_format($date, "d-m-Y");
  }
  /**
   * @param $date
   * @return false|string
   *
   * Фомат даты d-m
   */
  function dmDateFormat($date) {
    $date = date_create($date);
    return date_format($date, "d-m");
  }