<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
/**
 * texttranslate class
 */
class texttranslate extends Module
{
    const MODULE_NAME = 'texttranslate';

    protected $_html;
    protected $_display;

    function __construct()
    {
        ini_set("display_errors", 0);
        error_reporting(0); //E_ALL
        $this->name = 'texttranslate';
        $this->tab = 'administration';
        $this->version = '1.1.0';
        $this->author = 'damian-pm';
        $this->psver = $this->psversion();
        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l('Translation manager');
        $this->description = $this->l('Custom text translate');
    }

    public function getContent() {
        // Redirect to controller
        // Tools::redirectAdmin($this->context->link->getAdminLink('AdminTranslateAction'));

        $url = $this->context->link->getAdminLink('AdminTranslateAction',true, [], []);
        $this->context->smarty->assign('url', $url);

        return $this->display(__FILE__, 'texttranslate.tpl');
    }
    public function installTab()
    {
        if (Tab::getIdFromClassName('AdminTranslateAction')) {
            return true;
        }

        $tab                = new Tab();
        $tab->active        = 1;
        $tab->class_name    = 'AdminTranslateAction';
        $tab->name          = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Translation manager';
        }
        // AdminParentCustomer,AdminParentThemes,AdminParentOrders, AdminParentShipping, AdminParentModules, AdminParentPreferences etc.
        $tab->id_parent     = (int) Tab::getIdFromClassName('AdminInternational');
        $tab->module        = $this->name;

        return $tab->add();
    }
    public function enable($force_all = false)
    {
        if (!$this->installTab()) {
            return false;
        }

        return parent::enable($force_all);
    }
    function install()
    {
        if (parent::install() == false)
        {
            return false;
        }
        if (!$this->installTab()) {
            $this->uninstall();
            return false;
        }
        return true;
    }

    public function uninstall(){
        if (parent::uninstall() == false)
        {
            return false;
        }

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

?>