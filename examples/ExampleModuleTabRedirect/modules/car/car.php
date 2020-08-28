<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

class Car extends Module {

    const MODULE_NAME = 'car';

    protected $_html;
    protected $_display;

    function __construct()
    {
        ini_set("display_errors", 0);
        error_reporting(0); //E_ALL
        $this->name = 'car';
        $this->tab = 'front_office_features';
        $this->tabs = [
            [
                'class_name' => 'Demo',
                'visible' => true,
                'name' => 'Link Widget Carrrrr',
                'parent_class_name' => 'AdminParentCustomer',
            ],
        ];
        $this->version = '1.0.1';
        $this->author = 'damian-pm';
        $this->psver = $this->psversion();
        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l('Car Brummm');
        $this->description = $this->l('Show some table with cars written in Symfony');
    }

    public function getContent() {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink('Demo')
        );
    }

   /**
     * The Core is supposed to register the tabs automatically thanks to the getTabs() return.
     * However in 1.7.5 it only works when the module contains a AdminLinkWidgetController file,
     * this works fine when module has been upgraded and the former file is still present however
     * for a fresh install we need to install it manually until the core is able to manage new modules.
     *
     * @return bool
     */
    public function installTab()
    {
        if (Tab::getIdFromClassName('Demo')) {
            return true;
        }

        $tab                = new Tab();
        $tab->active        = 1;
        $tab->class_name    = 'Demo';
        $tab->name          = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Link Car bruum';
        }
        // AdminParentCustomer,AdminParentOrders, AdminParentShipping, AdminParentModules, AdminParentPreferences etc.
        $tab->id_parent     = (int) Tab::getIdFromClassName('AdminParentCustomer');
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

    public function renderResult(){}

    public function AddForm(){}

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

    public function displayForm() {}
}

?>
