# Example - service translation  with custome file .xlf

### Install

1. Add to the composer autoload new namespace 'Modules'
    ```json
    {
      "autoload": {
        "psr-4": {
            "PrestaShop\\PrestaShop\\": "src/",
            "PrestaShopBundle\\": "src/PrestaShopBundle/",
            "Modules\\": "modules/"
        },
      }
    }
    ```
    composer [more details here](https://getcomposer.org/doc/01-basic-usage.md)
    ###### Info: if for some reason symfony wont see new namespace, execute command:
    ```bash
    composer dump-autoload -o
    ```
1. Copy `examples/ExampleTranslationService` to your root project.
1. Now you got two options to register new translation file .xlf:
      * executing command for example:
        ```bash
        # for one file
        php bin/console lint:xliff app/Resources/translations/en-US/AdminText.en-US.xlf
        # for directory, reload can take more time
        php bin/console lint:xliff app/Resources/translations/
        ```
      * or in admin panel `/admin-dev/index.php/improve/international/translations/settings`  'update or install', select language and click 'add or update language'
1. Enter to the controller by url `/admin-dev/modules/translate` if you go there you will see a form with examples
