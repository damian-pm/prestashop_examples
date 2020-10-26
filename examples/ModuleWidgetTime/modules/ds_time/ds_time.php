<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class ds_time extends Module implements WidgetInterface
{
    private $templateFile;

    public function __construct()
    {
        $this->name = 'ds_time';
        $this->author = 'Damian';
        $this->version = '1.0.0';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->trans('Widget Time', array(), 'Modules.Time.Admin');
        $this->description = $this->trans('Simple Time.', array(), 'Modules.Time.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:ds_time/ds_time.tpl';
    }

    public function install()
    {
        return parent::install() && $this->registerHook('header');
    }
    public function hookDisplayHome(){
        return $this->fetch($this->templateFile);
    }
    public function hookHeader()
    {
        $this->context->controller->registerJavascript('modules-ds-time', 'modules/'.$this->name.'/_dev/assets/dstime.bundle.js', ['position' => 'bottom', 'priority' => 151]);
    }

    public function getWidgetVariables($hookName, array $configuration = [])
    {
        return [];
    }

    public function renderWidget($hookName, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch($this->templateFile);
    }
}