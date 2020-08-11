<?php

class CarControllerCore extends FrontController
{
  public $php_self = 'car';
  // protected $display_header = false; // displate header in template true/false
  // protected $display_footer = false;

  public function initContent()
  {
    parent::initContent();

    // template : themes/my_theme_name/templates/car.tpl
    $this->setTemplate('car');
  }
  public function getBreadcrumbLinks()
  {
      $breadcrumb = parent::getBreadcrumbLinks();

      $breadcrumb['links'][] = [
          'title' => 'sfddf',
          'url' => 'tghtg',
          'language' => 'en'
      ];

      return $breadcrumb;
    }
    public function setMedia()
    {
        parent::setMedia();
        // template : themes/my_theme_name/assets/js/test.js
        $this->registerJavascript('testjs', '/assets/js/test.js', ['position' => 'bottom', 'priority' => 0]);
    }
}