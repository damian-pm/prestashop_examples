# Example Module

### Car module

* Copy content of full ExampleModule directory to root directory of your project.
* Second thing you have to do is to register this module by executing command:
  * > php bin/console prestashop:module install car

### Few definitions
 * executing method in module/car.php 'function install', it works only if you dont have it yet installed
> ... prestashop:module install car

* call method install in car class even if it is installed module
> ... prestashop:module reset car

* call method uninstall in car class
> ... prestashop:module uninstall car
