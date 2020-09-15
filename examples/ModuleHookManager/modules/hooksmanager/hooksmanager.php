<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

class hooksmanager extends Module
{
    function __construct()
    {
        // ini_set("display_errors", 0);
        // error_reporting(0); //E_ALL  	   
        $this->name         = 'hooksmanager';
        $this->tab          = 'administration';
        $this->version      = '1.0.0';
        $this->author       = 'DamianS';
        $this->psver        = $this->psversion();
        $this->bootstrap    = true;
        $this->displayName  = $this->l('Hooks Manager');
        $this->description  = $this->l('Manage hooks location themes > Hooks manager. You can edit delete and add hooks');
        parent::__construct();
    }

    public function installTab()
    {
        if (Tab::getIdFromClassName('Hooksmanager')) {
            return true;
        }

        $tab                = new Tab();
        $tab->active        = 1;
        $tab->class_name    = 'Hooksmanager';
        $tab->name          = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Hooks manager';
        }
        // AdminParentCustomer,AdminParentThemes,AdminParentOrders, AdminParentShipping, AdminParentModules, AdminParentPreferences etc.
        $tab->id_parent     = (int) Tab::getIdFromClassName('AdminParentThemes');
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
        if (parent::install() == false){
            return false;
        }
        if (!$this->installTab()) {
            $this->uninstall();
            return false;
        }
        return true;
    }

    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink('Hooksmanager'));
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