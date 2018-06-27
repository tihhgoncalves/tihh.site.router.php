<?php

class tihh_router{

  private $gets;
  public $levels = array();
  public $page;

  function __construct(){

    if(!isset($_GET['url']) || empty($_GET['url']))
      $this->gets = 'index';
    else
      $this->gets = $_GET['url'];

    $this->levels = explode('/', $this->gets);
    $this->page = array_shift($this->levels);

  }

  function get_level($num){
    return @$this->levels[$num-1];
  }

}

?>