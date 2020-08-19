<?php


class textTranslator extends Module
{
    const MODULE_NAME = 'textTranslator';

    protected $_html;
    protected $_display;

    function __construct()
    {
        ini_set("display_errors", 0);
        error_reporting(0); //E_ALL
        $this->name = 'textTranslator';
        $this->tab = 'administration';
        $this->version = '1.0.1';
        $this->author = 'damian-pm';
        $this->psver = $this->psversion();
        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l('Text Translator');
        $this->description = $this->l('Translate any text from prestashop');
    }

    public function getContent() {
        return 'hello text translator';
    }

    public function hookDisplayCar(array $params)
    {
        return 'Car Hook text';
    }
    function install()
    {
        if (parent::install() == false)
        {
            return false;
        }
        return true;
    }
    public function uninstall(){
        if (parent::uninstall() == false)
        {
            return false;
        }
        $sql = 'DROP TABLE IF EXISTS ps_car_test';
        if (Db::getInstance()->execute($sql)){
            return true;
        }
        return false;
    }

    public function renderResult()
    {

    }

    public function AddForm()
    {

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

    public function displayForm() {}
}

?>