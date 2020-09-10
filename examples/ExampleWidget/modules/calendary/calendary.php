<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Calendary extends Module implements WidgetInterface
{
    private $templateFile;

    public function __construct()
    {
        $this->name = 'calendary';
        $this->author = 'Damian';
        $this->version = '2.0.1';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->trans('Widget calendary', array(), 'Modules.Calendary.Admin');
        $this->description = $this->trans('Simple calendary.', array(), 'Modules.Calendary.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:calendary/calendary.tpl';
    }

    public function install()
    {
        return parent::install() && $this->registerHook('header');
    }

    public function hookHeader()
    {
        $this->context->controller->registerStylesheet('modules-calendary-sm', 'modules/'.$this->name.'/_dev/dist/simple-calendar.css', ['position' => 'top', 'priority' => 140]);
        $this->context->controller->registerStylesheet('modules-calendary-demo', 'modules/'.$this->name.'/_dev/assets/demo.css', ['position' => 'top', 'priority' => 150]);
        $this->context->controller->registerJavascript('modules-calendary-jq', 'modules/'.$this->name.'/_dev/dist/jquery.simple-calendar.js', ['position' => 'bottom', 'priority' => 151]);
        $this->context->controller->registerJavascript('modules-calendary', 'modules/'.$this->name.'/calendary.js', ['position' => 'bottom', 'priority' => 152]);
    }

    public function getWidgetVariables($hookName, array $configuration = [])
    {
        $widgetVariables = array(
            'search_controller_url' => $this->context->link->getPageLink('search', null, null, null, false, null, true),
        );

        if (!array_key_exists('search_string', $this->context->smarty->getTemplateVars())) {
            $widgetVariables['search_string'] = '';
        }

        return $widgetVariables;
    }

    public function renderWidget($hookName, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch($this->templateFile);
    }
}
