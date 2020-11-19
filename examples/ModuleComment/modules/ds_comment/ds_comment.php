<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class ds_comment extends Module implements WidgetInterface
{
    private $templateFile;

    public function __construct()
    {
        $this->name = 'ds_comment';
        $this->author = 'Damian';
        $this->version = '1.0.1';
        $this->need_instance = 0;
        $this->INSTALL_SQL_FILE = 'dscomment_tables.sql';

        parent::__construct();

        $this->displayName = $this->trans('DS Comment Product', array(), 'Modules.Comment.Admin');
        $this->description = $this->trans('Simple module comment product.', array(), 'Modules.Comment.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:ds_comment/ds_comment.tpl';
    }

    public function install()
    {
        return parent::install() && $this->installSql() && $this->registerHook('header');
    }
    public function uninstall($keep = true)
    {
        if (!parent::uninstall() || ($keep && !$this->deleteTables()))
        {
            return false;
        }

        return true;
    }
    public function deleteTables()
    {
        return true;
        
        // return Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'dscomment`');
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
    public function hookDisplayHome(){
        return $this->fetch($this->templateFile);
    }
    public function hookHeader()
    {
        $this->context->controller->registerJavascript('modules-ds-comment', 'modules/'.$this->name.'/app/dist/main.bundle.js', ['position' => 'bottom', 'priority' => 151]);
        $this->context->controller->registerStylesheet('modules-ds-comment-style','modules/'.$this->name.'/app/dist/css/app.css');
    }

    public function getWidgetVariables($hookName, array $configuration = [])
    {
        return [
            'test' => $this->context->link->getModuleLink('ds_comment')
        ];
    }

    public function renderWidget($hookName, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch($this->templateFile);
    }
    public function hookDisplayProductListReviews($params)
    {
        $this->smarty->assign(array(
            'product' => $params['product']
        ));
    }
}