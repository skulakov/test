<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 09.01.2019
   * Time: 23:28
   */

  namespace lib;


  use models\PostsModel;

  class Pagination {
    protected $postModel;
    protected $countPage;
    protected $data = [];

    public function __construct() {
      $this->postModel = new PostsModel();
    }

    public function pages($page = null) {

      $page = !$page ? $page = 1 : $page;

      $posts = $this->postModel->getPosts();
      if(!$posts){
        return $this->data['content'] = false;
      }
      $countRow = count($posts);

      $numOfRec = $this->getCountPage();
      //
      $start = ($page - 1) * $numOfRec;
      //
      $pageCount = ceil($countRow / $numOfRec);

      //
      $limitRow = $this->postModel->getPosts('', "$start,$numOfRec");
      //
      ////      return [$limitRow, $pageCount];
      $this->data['pageCount'] = $pageCount;
      $this->data['content'] = $limitRow;
      return $this->data;
    }

    /**
     * @return mixed
     */
    public function getCountPage() {
      return $this->countPage;
    }

    /**
     * @param mixed $countPage
     */
    public function setCountPage($countPage) {
      $this->countPage = $countPage;
    }


  }