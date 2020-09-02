<?php

class callme extends Module
{
  public function __construct()
  {
    ini_set("display_errors", 0);
    error_reporting(0); //E_ALL  	   
    $this->name = 'callme';
    $this->tab = 'administration';
    $this->version = '1.0.1';
    $this->author = 'damian-pm';
    $this->psver = $this->psversion();
    parent::__construct();
    $this->bootstrap = true;
    $this->displayName = $this->l('Call me');
    $this->description = $this->l('Show some table with call');
  }

  public function initContent()
  {
      $this->context->smarty->assign('message', 'hello'); 
      parent::initContent();
  }

  public function install() {
    return (parent::install() && 
      $this->registerHook('addWebserviceResources') &&
      $this->registerHook('displayFooter') &&
      $this->registerHook('displayCallMeText')
    );
  }
  /**
   * Hook attached to hook displayFooter
   */
  public function hookDisplayFooter()
  {
    $this->context->smarty->assign(
        array('some_data' => 'Special template for callme')
    );
    return $this->display(__FILE__, 'callme.tpl');
  }
  /**
   * Hook used in template
   */
  public function hookDisplayCallMeText(array $params)
  {
      return 'Call me someday';
  }
  /**
   * Admin panel display text
   */
  public function getContent(){
    return 'Simple text from module';
  }

  public function uninstall()
  {
      if (!parent::uninstall() || !Configuration::deleteByName('chequemodule'))
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
  public function hookAddWebserviceResources() {
   /**
    * register new web service api
    */
    return array(
        'callme' => array(
          'description'           => 'Knowband Custom Customer',
          'specific_management'   => true,
      ),
    );
  }
}