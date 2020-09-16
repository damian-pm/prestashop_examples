<?php

class chart extends Module
{
  public function __construct()
  {
    ini_set("display_errors", 0);
    error_reporting(0); //E_ALL  	   
    $this->name = 'chart';
    $this->tab = 'administration';
    $this->version = '1.0.1';
    $this->author = 'damian-pm';
    $this->psver = $this->psversion();
    parent::__construct();
    $this->bootstrap = true;
    $this->displayName = $this->l('Simple js chart');
    $this->description = $this->l('Show chart in hooks');
  }

  public function initContent()
  {
      $this->context->smarty->assign('message', 'hello'); 
      parent::initContent();
  }

  public function install() {
    return (parent::install() && 
      $this->registerHook('displayHome') &&
      $this->registerHook('displayLeftColumn') &&
      $this->registerHook('actionProductOutOfStock') &&
      $this->registerHook('header')
    );
  }

  public function hookDisplayHome() {
    return $this->display(__FILE__, 'chart.tpl');
  }
  public function hookActionProductOutOfStock() {
    return $this->display(__FILE__, 'chart.tpl');
  }
  public function hookDisplayLeftColumn() {
    return $this->display(__FILE__, 'chart.tpl');
  }
  public function hookHeader() {
    $this->context->controller->registerJavascript('modules-chart-js', 'modules/'.$this->name.'/node_modules/chart.js/dist/Chart.min.js', ['position' => 'bottom', 'priority' => 151]);
    $this->context->controller->registerJavascript('modules-chart-utils', 'modules/'.$this->name.'/js/utils.js', ['position' => 'bottom', 'priority' => 151]);
    $this->context->controller->registerJavascript('modules-chart-index', 'modules/'.$this->name.'/js/index.js', ['position' => 'bottom', 'priority' => 151]);
    $this->context->controller->registerStylesheet('modules-chart-style',  'modules/'.$this->name.'/node_modules/chart.js/dist/Chart.min.css', ['position' => 'top', 'priority' => 140]);
  }
  /**
   * Admin panel display text
   */
  public function getContent(){
    return 'Simple text from module';
  }

  public function uninstall()
  {
      if (!parent::uninstall())
          return false;
      return true;
  }

  public static function psversion($part = 1)
  {
      $version = _PS_VERSION_;
      $exp = $explode = explode(".", $version);
      if ($part == 1)
      {
          return $exp[1];
      }
      if ($part == 2)
      {
          return $exp[2];
      }
      if ($part == 3)
      {
          return $exp[3];
      }
  }

}