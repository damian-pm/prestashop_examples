# Example - Module backend in Symfony

### Install

1. Copy example to your root dir project.
1. Install module vendors/
    ```bash
    cd modules/car
    composer i
    ```
1. Install module for PrestaShop
    ```bash
    php bin/console prestashop:module install car
    ```
1. (optional) Refresh mapping namespace, cache:
```bash
composer dump-autoload -o
php bin/console cache:clear
```

### Access
* you can enter to the module directly by url
`http://presta.test/admin-dev/modules/test`

* or by panel 'module manager'
`http://presta.test/admin-dev/improve/modules/manage`
