<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use \Configuration as Config;

class ds_chat extends Module implements WidgetInterface
{
    private $templateFile;
    public function __construct()
    {
        $this->name = 'ds_chat';
        $this->author = 'Damian';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->INSTALL_SQL_FILE = 'dschat_table.sql';

        parent::__construct();

        $this->displayName = $this->trans('DS chat', array(), 'Modules.Comment.Admin');
        $this->description = $this->trans('Simple messanger', array(), 'Modules.Comment.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:ds_chat/ds_chat.tpl';
    }

    public function install()
    {
        Config::updateGlobalValue('DS_CHAT_MESSAGE_OWNER_ID', '1');
        return parent::install() && 
        $this->installSql() && 
        $this->registerHook('header') &&
        $this->registerHook('displayFooterBefore');
    }
    public function uninstall($keep = true)
    {
        Config::deleteByName('DS_CHAT_MESSAGE_OWNER_ID');

        if (!parent::uninstall() || ($keep && !$this->deleteTables()))
        {
            return false;
        }

        return true;
    }
    public function deleteTables()
    {
        // WARNING: permamently remove table
        return Db::getInstance()->execute('
            DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'ds_chat_messages`;
            DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'ds_chat_bot_messages`;
            ');
        return true;
        
    }
    public function reset()
    {
        if (!$this->uninstall(false)){
            return false;
        }
        if (!$this->install(false)){
            return false;
        }

        return true;
    }
    /**
     * Install SQL file
     *
     * @return boolen
     */
    public function installSql() {
        if (!file_exists(dirname(__FILE__) . '/' . $this->INSTALL_SQL_FILE)){
            return false;
        } elseif (!$sql = file_get_contents(dirname(__FILE__) . '/' . $this->INSTALL_SQL_FILE)) {
            return false;
        }
        $sql = str_replace(['PREFIX_','ENGINE_TYPE'], [_DB_PREFIX_,_MYSQL_ENGINE_], $sql);
        $sql = preg_split("/;\s*[\r\n]+/", trim($sql));

        foreach ($sql as $query) {
            if (!Db::getInstance()->execute(trim($query))) {
                return false;
            }
        }
        return true;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink('dschat_index'));
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function hookDisplayFooterBefore(){
        $this->smarty->assign([
            'url_get_all'=> $this->context->link->getModuleLink('ds_chat', 'GetMessages'),
            'url_send'=> $this->context->link->getModuleLink('ds_chat', 'SendMessage')
        ]);
        return $this->fetch($this->templateFile);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function hookHeader()
    {
        $this->context->controller->registerJavascript('modules-ps-template', 'modules/'.$this->name.'/app/dist/main.bundle.js', ['position' => 'bottom', 'priority' => 151]);
        $this->context->controller->registerStylesheet('modules-ps-template-style','modules/'.$this->name.'/app/dist/css/app.css');
    }
    /**
     * Undocumented function
     *
     * @param [type] $hookName
     * @param array $configuration
     * @return void
     */
    public function getWidgetVariables($hookName, array $configuration = [])
    {
        return [
            'test' => $this->context->link->getModuleLink('ds_chat'),
            'msg'=> ''
        ];
    }
    /**
     * Undocumented function
     *
     * @param string $hookName
     * @param array $configuration
     * @return void
     */
    public function renderWidget($hookName, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch($this->templateFile);
    }
    /**
     * Undocumented function
     *
     * @param [type] $params
     * @return void
     */
    public function hookDisplayProductListReviews($params)
    {
        $this->smarty->assign(array(
            'product' => $params['product']
        ));
    }
}