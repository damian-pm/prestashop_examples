<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

// if (file_exists(__DIR__ . '/vendor/autoload.php')) {
//     require_once __DIR__ . '/vendor/autoload.php';
// }

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class ds_productthumbnail extends Module implements WidgetInterface
{
    private $templateFile;

    public function __construct()
    {
        $this->name = 'ds_productthumbnail';
        $this->author = 'Damian';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->INSTALL_SQL_FILE = 'commands.sql';

        parent::__construct();

        $this->displayName = $this->trans('DS Product thumbnail', array(), 'Modules.Comment.Admin');
        $this->description = $this->trans('Show me weather', array(), 'Modules.Comment.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:ds_productthumbnail/ds_productthumbnail.tpl';
    }

    public function install()
    {
        return parent::install() && 
        // $this->installSql() && 
        $this->registerHook('header');
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
    public function hookDisplayFooterProduct(){
        return $this->fetch($this->templateFile);
    }
    public function hookDisplayAfterProductThumbs($product){
        $this->smarty->assign([
            'test'=> $product
        ]);
        return $this->fetch($this->templateFile);
    }
    public function hookHeader()
    {
        $this->context->controller->registerJavascript('modules-ps-manifest', 'modules/'.$this->name.'/app/dist/chunk-vendors.js', ['position' => 'bottom', 'priority' => 151]);
        $this->context->controller->registerJavascript('modules-ps-vendor', 'modules/'.$this->name.'/app/dist/app.js', ['position' => 'bottom', 'priority' => 151]);
        // $this->context->controller->registerJavascript('modules-ps-template', 'modules/'.$this->name.'/app/dist/app.js', ['position' => 'bottom', 'priority' => 151]);
        // $this->context->controller->registerStylesheet('modules-ps-template-style','modules/'.$this->name.'/app/dist/css/app.css');
    }

    public function getWidgetVariables($hookName, array $configuration = [])
    {
        return [
            'test' => 'test zmiennej'
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
            // 'product' => $params['product']
        ));
    }
}