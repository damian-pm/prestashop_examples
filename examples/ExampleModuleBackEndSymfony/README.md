# Example - Module backend in Symfony

### Install - 3 steps
1. ##### Edit file composer.json in root project dir, add code:
    ` ... "Modules\\": "modules/" ...`

      In my project it looks like this:

      ```json
      "autoload": {
        "psr-4": {
              "PrestaShop\\PrestaShop\\": "src/",
              "PrestaShopBundle\\": "src/PrestaShopBundle/",
              "Modules\\": "modules/"
          },
          "classmap": [
              "app/AppKernel.php",
              "app/AppCache.php"
          ]
          },
      ```
      Importent here is to show Symfony new namespace 'Modules'

1. ##### Edit file app/config/config.yml to add new doctrine mapping directory, add code:
    ```yml
    mappings:  # define custom mapping
      SomeEntityNamespace:
          type: annotation
          dir: '%kernel.project_dir%/modules/car/src/Entity'
          is_bundle: false
          prefix: Modules\Car\Entity
          alias: AppCar
    ```
    In my project it looks like this:
    ```yml
    # Doctrine Configuration
      doctrine:
          dbal:
              default_connection: default

              connections:
                  default:
                    ...
          orm:
              auto_generate_proxy_classes: "%kernel.debug%"
              # naming_strategy: doctrine.orm.naming_strategy.underscore
              naming_strategy: prestashop.database.naming_strategy
              auto_mapping: true
              dql:
                  string_functions:
                      regexp: DoctrineExtensions\Query\Mysql\Regexp
              mappings:  # define custom mapping
                  SomeEntityNamespace:
                      type: annotation
                      dir: '%kernel.project_dir%/modules/car/src/Entity'
                      is_bundle: false
                      prefix: Modules\Car\Entity
                      alias: AppCar
    ```
1. ##### Copy content of example from repo `examples/ExampleModulesBackEndSymfony` to your root project
