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
        $this->tab = 'administration';
        $this->version = '1.0.1';
        $this->author = 'damian-pm';
        $this->psver = $this->psversion();
        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l('Car Brummm');
        $this->description = $this->l('Show some table with cars written in Symfony');
    }

    public function getContent() {
        header('Location: /admin-dev/modules/test');
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
        $this->registerHook('displayCar');

        $sql = 'CREATE TABLE if not exists ps_car_test (
            id int AUTO_INCREMENT PRIMARY KEY,
            name varchar(255),
            model varchar(255),
            description varchar(255),
            state bool
        );';
        $sql .= 'INSERT INTO ps_car_test (name,model,description,state) values ("Audi", "A4", "Greate car brumm", true);';
        $sql .= 'INSERT INTO ps_car_test (name,model,description,state) values ("Renault", "C4", "Greate car brumm", false);';
        $sql .= 'INSERT INTO ps_car_test (name,model,description,state) values ("Fiat", "126p", "Greate mini car brumm", true);';
        if (Db::getInstance()->execute($sql)){
            return true;
        }
        return false;
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
