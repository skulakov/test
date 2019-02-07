<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 08.01.2019
   * Time: 11:24
   *
   * Родительский класс контроллеров
   */

  namespace lib;
  //Определение пространств имен


  use models\HomeModel;
  use models\PostsModel;
  use models\UsersModel;

  class Controller {
    private $tmpl = 'site_tmpl'; // Текущий шаблон сайта
    protected $page; // Текущая страница сайта
    protected $userModel;
    protected $postModel;
    protected $homeModel;
    protected $validator;
    protected $email;
    protected $file;
    protected $pagination;

    public function __construct() {
      $this->userModel = new UsersModel();
      $this->postModel = new PostsModel();
      $this->validator = new Validator();
      $this->homeModel = new HomeModel();
      $this->email = new Email();
      $this->file = new FileUpload();
      $this->pagination = new Pagination();
    }

    /**
     * @param $page
     * @param array $data
     * @return mixed
     *
     * Подключение HTML шаблона с переменными
     */
    public function display($page, $data = []) {
      // Путь к шаблону сайта
      $template = VIEWS . $this->getTmpl() . '.php';
      // Ключи ассоциативного массива в качестве имен переменных
      $data['site'] = $this->homeModel->getSiteName();

      extract($data);

      // Путь к текущей странице сайта (вызывается в шаблоне сайта)
      $this->page = VIEWS . 'pages/' . $page . '.php';
      // Подключение шаблона
      require_once $template;
      return;
    }

    /**
     * @return mixed
     *
     * Вывод шаблонв сайта
     */
    public function getTmpl() {
      return $this->tmpl;
    }

    /**
     * @param mixed $tmpl
     *
     * Смена шаблона сайта
     */
    public function setTmpl($tmpl) {
      $this->tmpl = $tmpl;
    }

  }