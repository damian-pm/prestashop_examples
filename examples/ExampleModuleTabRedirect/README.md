# Example - Add Tab (Left side menu bar) and redirect to Symfony module

You will see here:
* how write module in symfony
* how redirect to controller in module
* add route to controller
* add new link in menu admin (tab)

### Install
1. Copy content of example to the root project
1. Check if you have registered namespace 'Modules', if not check how it do in previousle example: [here only first step required](https://github.com/damian-pm/prestashop_examples/tree/master/examples/ExampleModuleBackEndSymfony)
1. Execute command:
  ```bash
  php bin/console prestashop:module install car
    # or reset if is installed
  php bin/console prestashop:module reset car

    # last thing clear cache
  php bin/console cache:clear
  ```
