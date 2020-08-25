<?php

use PrestaShopBundle\Entity\Lang;

class car extends Module
{
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
        $this->description = $this->l('Show some table with cars');
    }

    function install()
    {
        if (parent::install() == false)
        {
            return false;
        }
        $sql = 'CREATE TABLE if not exists car (
            id int AUTO_INCREMENT PRIMARY KEY,
            name varchar(255),
            model varchar(255),
            description varchar(255),
            state bool
        );';
        $sql .= 'INSERT INTO car (name,model,description,state) values ("Audi", "A4", "Greate car brumm", true);';
        $sql .= 'INSERT INTO car (name,model,description,state) values ("Renault", "C4", "Greate car brumm", false);';
        $sql .= 'INSERT INTO car (name,model,description,state) values ("Fiat", "126p", "Greate mini car brumm", true);';
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
        $sql = 'DROP TABLE IF EXISTS car';
        if (Db::getInstance()->execute($sql)){
            return true;
        }
        return false;
    }

    public function renderResult()
    {

        // Select all available extra info tabs
        $sql = 'SELECT id,name, model,description, state as position FROM car ORDER BY id DESC';

        if ($result = Db::getInstance()->ExecuteS($sql))
        {
            $this->fields_list = array(
                'name' => array(
                    'title' => $this->l('Name'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'model' => array(
                    'title' => $this->l('Model'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'description' => array(
                    'title' => $this->l('Description'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'position' => array(
                    'title' => $this->l('Visible'),
                    'width' => 'auto',
                    'type' => 'bool',
                    'icon' => array(
                        '0' => 'disabled.gif',
                        '1' => 'enabled.gif'
                    )
                )
            );

            $helper = new HelperList();
            $helper->className = 'NewCar';
            $helper->simple_header = true;
            $helper->identifier = 'id';
            $helper->actions = array(
                // 'edit',
                'delete'
            );
            $helper->show_toolbar = true;
            $helper->title = $this->l('Car collection');
            $helper->table = 'car';
            $helper->token = Tools::getAdminTokenLite('AdminModules');
            $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
            return ($helper->generateList($result, $this->fields_list));
        }
    }

    public function AddForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Add new car'),
                    'icon' => 'icon-plus-square'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Car name'),
                        'name' => 'car_name',
                        'class' => 'fixed-width-lg',
                        'required' => true,
                        'desc' => $this->l('Hook name is the most important thing. It must be unique.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Model'),
                        'name' => 'car_model',
                        'class' => 'fixed-width-lg',
                        'required' => false,
                        'desc' => $this->l('Hook title appears in back office (for your eyes only)'),
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->l(' Description'),
                        'name' => 'car_description',
                        'class' => 'fixed-width-lg',
                        'required' => false,
                        'desc' => $this->l('Define short description of the Hook'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('State'),
                        'name' => 'car_state',
                        'class' => 'fixed-width-lg',
                        'required' => false,
                        'desc' => $this->l('Visibility of the hook on Hooks list in your modules > positions section'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                ),
                'submit' => array('title' => $this->l('Add new car'),)
            ),
        );
      
        $helper = new HelperForm();
        $helper->submit_action = 'addNewCar';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        return $helper->generateForm(array($fields_form));
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

    public function getContent() {

        if (Tools::getValue('deletecar', 'false') != 'false') {
            if (Db::getInstance()->execute("delete from car where id=".Tools::getValue('id')." limit 1")) {
                $this->context->controller->confirmations[] = $this->l("Car removed!");
            } else {
                $this->context->controller->errors[] = $this->l("Module can't remove this hook");
            }
        }
        if (Tools::getValue('updatehook', 'false') != 'false') {
            $this->context->controller->errors[] = $this->l("You can't edit the hook. Please remove it and add new one.");
        }
        
        if (Tools::isSubmit('addNewCar')) {
            $sql = 'INSERT INTO car (name,model,description,state) values (
                "'.Tools::getValue('car_name').'", 
                "'.Tools::getValue('car_model').'", 
                "'.Tools::getValue('car_description').'", 
                "'.Tools::getValue('car_state').'");';
            if (Db::getInstance()->execute($sql)) {
                $this->context->controller->confirmations[] = $this->l("Car created properly!");
            } else {
                $this->context->controller->errors[] = $this->l("Module can't add this hook");
            }
        }

        return $output . $this->displayForm();
    }

    public function displayForm()
    {
        return $this->AddForm() . $this->renderResult();
    }
}

?>