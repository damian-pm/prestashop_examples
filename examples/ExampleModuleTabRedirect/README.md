# Example - Add Tab (Left side menu bar) and redirect to Symfony module

You will see here:
* how write module in symfony
* how redirect to controller in module
* add route to controller
* add new link in menu admin (tab)

### Install
1. Copy content of example to the root project
1. Install vendors from module:
  ```bash
  cd modules/car
  # generate vendor without vendors namespace will not be  visible
  composer i
  ```
1. Execute command:
  ```bash

  php bin/console prestashop:module install car
    # or reset if is installed
  php bin/console prestashop:module reset car

    # last thing clear cache
  php bin/console cache:clear

  # OPTIONAL:
  # refresh mapped namespace
  composer dump-autoload -o
  ```
### Details
Position tab in menu you can choose pasing name of class for example 'AdminParentCustomer'
```php
// file: car.php
// AdminParentCustomer, AdminParentOrders, AdminParentShipping, AdminParentModules, AdminParentPreferences etc.
$tab->id_parent = (int) Tab::getIdFromClassName('AdminParentCustomer');
```
