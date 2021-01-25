# Translation add in module (for only Symfony files)

### Recommended module
With this module you can easyer edit translation after generate [click](https://github.com/damian-pm/prestashop_examples/tree/master/examples/ModuleTextTranslate)

### Generate and add translations

* create module or genereate here : https://validator.prestashop.com/generator
* add translations
    ```php
    //php
    $trans          = $this->get('translator.default');
    $trans->trans("Update attribute ended with fails",[],'ModulesDsproduct')
    ```
    ```twig
    {*twig*}
    {{ 'These modules are relative to the product page of your shop.'|trans({}, 'Admin.Catalog.Feature') }}
    ```
* install lib http://jmsyst.com/bundles/JMSTranslationBundle/master/installation
* scan 
	```bash
	phpbc translation:extract en --output-dir=./modules/ds_product/translations/yml/ --dir=./modules/ds_product --output-format=yml
	```
* create methods in module
```php
use  Symfony\Component\Yaml\Yaml;

...
    public function install()
    {
        return parent::install() && $this->addTranslations();
    }
    public function uninstall()
    {
        return parent::uninstall() && $this->removeTranslations();
    }
    public function addTranslations() {
        $sql = "SELECT * FROM "._DB_PREFIX_."lang WHERE iso_code IN ('pl','en')";
        $langs = DB::getInstance()->ExecuteS($sql, 1, 0);

        foreach ($langs as $lang) {
            $file = __DIR__.'/translations/yml/'.$this->domain.'.'.$lang['iso_code'].'.yml';
            if (!file_exists($file)){
                break;
            }
            $contet         = file_get_contents($file);
            $translations   = Yaml::parse($contet);
    
            foreach ($translations as $i => $v) {
                Db::getInstance()->insert('translation', array(
                    'key'           => $i,
                    'id_lang'       => $lang['id_lang'],
                    'domain'        => $this->domain,
                    'translation'   => $v,
                ));
            }
        }
        return true;
    }
    public function removeTranslations(){
        $sql = "DELETE FROM "._DB_PREFIX_."translation where domain='".$this->domain."'";
        DB::getInstance()->Execute($sql, 1, 0);
        return true;
    }
```
