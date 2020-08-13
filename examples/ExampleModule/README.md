# Example Module

### Car module

* Copy content of full **ExampleModule** directory to root directory of your project.
* Second thing you have to do is to register this module by executing command:\
`php bin/console prestashop:module install car`
* Now you can find your new module on the list of modules manager (admin panel), http://presta.test/admin-dev/index.php/improve/modules/manage
### Other commands
* executing method in module/car.php 'function install', it works only if you dont have it yet installed\
 `... prestashop:module install car`

* call method 'install' in 'car class' even if module is installed \
 `... prestashop:module reset car`

* call method uninstall in car class\
`... prestashop:module uninstall car`
