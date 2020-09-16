# Install module
### Manual
1. Copy example to your project
1. run command:
    ```bash
    php bin/console prestashop:module install module_name
    # example
    php bin/console prestashop:module install hooksmanager
    ```
1. Optional - sometimes help
    ```bash
    # cache
    php bin/console cache:clear
    # namespace mapping
    composer dump-autoload -o
    ```
### From admin panel
1. Zip module dir.
    Like in this example :[ ModuleHookManager is prepared zip]()
1. Go to AdminPanel `` Modules > module manager`` find button 'upload a module'
