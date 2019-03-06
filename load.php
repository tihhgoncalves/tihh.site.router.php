<?php

class tihh_router{

  private $gets;
  public $levels = array();
  public $page;
  public $version;  //localhost, beta, production

  function __construct(){

    global $uri, $config;

    if(!isset($_GET['url']) || empty($_GET['url']))
      $this->gets = 'index';
    else
      $this->gets = $_GET['url'];

    $this->levels = explode('/', $this->gets);
    $this->page = array_shift($this->levels);

    $url_base = $uri->Host() . '/' . $uri->scriptName();

    //verifica versão do site
    if(strpos($config->get('site_localhost_url'), $url_base) > 0) {
      $this->version = 'localhost';
      $config->set('site_url', $config->get('site_localhost_url'));
    }
    if(strpos($config->get('site_beta_url'), $url_base) > 0) {
      $this->version = 'beta';
      $config->set('site_url', $config->get('site_beta_url'));
    }
    if(strpos($config->get('site_production_url'), $url_base) > 0) {
      $this->version = 'production';
      $config->set('site_url', $config->get('site_production_url'));
    }

  }

  function get_level($num){
    return @$this->levels[$num-1];
  }

  function is_localhost(){
    return ($this->version == 'localhost');
  }
  function is_beta(){
    return ($this->version == 'beta');
  }
  function is_production(){
    return ($this->version == 'production');
  }

}

?>
