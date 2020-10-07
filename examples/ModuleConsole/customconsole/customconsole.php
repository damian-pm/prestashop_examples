<?php
/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the GNU General Public License, version 3 (GPL-3.0).
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * @author    emarketing www.emarketing.com <integrations@emarketing.com>
 * @copyright 2019 easymarketing AG
 * @license   https://opensource.org/licenses/GPL-3.0 GNU General Public License version 3
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once(dirname(__FILE__) . '/vendor/autoload.php');

/**
 * Class Console
 */
class CustomConsole extends Module
{
    /**
     * Emarketing constructor.
     */
    public function __construct()
    {
        $this->name = 'customconsole';
        $this->tab = 'custom_console';
        $this->version = '1.0';
        $this->author = 'damians';
        // $this->module_key = 'f28d5933d349ca55af63ed0b10f6ca33';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array(
            'min' => '1.7.0',
            'max' => _PS_VERSION_
        );
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Custom console');
        $this->description = $this->l('Simple custom command console');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    /**
     * @return bool
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    public function install()
    {
        if (!parent::install()) {
            return false;
        }

        Configuration::updateValue('CUSTOM_CONSOLE_ENTITY_PATH', 'src/PrestaShopBundle/Entity');
        Configuration::updateValue('CUSTOM_CONSOLE_ENTITY_NAMESPACE', 'PrestaShopBundle\Entity');

        return true;
    }

    /**
     * @return bool
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        // $this->uninstallTab();

        return true;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function hookDisplayHeader()
    {
        $serviceFrontendHeader = new \Emarketing\Service\FrontendHeader;
        $html = $serviceFrontendHeader->buildHtml();

        return $html;
    }

    /**
     *
     */
    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCss($this->_path . 'views/css/menuTabIcon.css');
    }
    
    /**
     * @return mixed
     */
    public function getContent()
    {

        // Tools::redirectAdmin($this->context->link->getAdminLink('ConsoleCommand'));
        $output = $this->display(__FILE__, 'customconsole.tpl');

        if (Tools::isSubmit('submit'.$this->name)) {
            $entityPath = strval(Tools::getValue('CUSTOM_CONSOLE_ENTITY_PATH'));
            $entityNamespace = strval(Tools::getValue('CUSTOM_CONSOLE_ENTITY_NAMESPACE'));
    
            if (
                !$entityPath ||empty($entityPath) || !Validate::isGenericName($entityPath) ||
                !$entityNamespace ||empty($entityNamespace) || !Validate::isGenericName($entityNamespace)
            ) {
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            } else {
                Configuration::updateValue('CUSTOM_CONSOLE_ENTITY_PATH', $entityPath);
                Configuration::updateValue('CUSTOM_CONSOLE_ENTITY_NAMESPACE', $entityNamespace);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        
        return $output.$this->displayForm();
    }
    public function displayForm()
    {
        // Get default language
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');
    
        // Init Fields form array
        $fieldsForm[]['form'] = [
            'legend' => [
                'title' => $this->l('Default settings - create:entity'),
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Default entity path'),
                    'name' => 'CUSTOM_CONSOLE_ENTITY_PATH',
                    'size' => 200,
                    'required' => true
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Default entity namespace'),
                    'name' => 'CUSTOM_CONSOLE_ENTITY_NAMESPACE',
                    'size' => 200,
                    'required' => true
                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ];
    
        $helper = new HelperForm();
    
        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
    
        // Language
        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = $defaultLang;
    
        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ],
            'back' => [
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ]
        ];
    
        // Load current value
        $helper->fields_value['CUSTOM_CONSOLE_ENTITY_PATH'] = Tools::getValue('CUSTOM_CONSOLE_ENTITY_PATH', Configuration::get('CUSTOM_CONSOLE_ENTITY_PATH'));
        $helper->fields_value['CUSTOM_CONSOLE_ENTITY_NAMESPACE'] = Tools::getValue('CUSTOM_CONSOLE_ENTITY_NAMESPACE', Configuration::get('CUSTOM_CONSOLE_ENTITY_NAMESPACE'));
    
        return $helper->generateForm($fieldsForm);
    }
}
