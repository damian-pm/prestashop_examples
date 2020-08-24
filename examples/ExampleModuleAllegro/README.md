# Example - simple module allegro
Module will display
### Install

1. Check if you have autoloaded namespace 'Modules' if not copy this to composer.json:
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
1. Copy this example to the root project
1. Register new module in ps:
    ```bash
        php bin/console prestashop:module install allegro
    ```
1. [Geting start with allegro - tutorial](https://developer.allegro.pl/getting_started/#jak-zarejestrowa%c4%87-now%c4%85-aplikacj%c4%99), you wil get there API access.
  Steps from tutorial:
  * create account if you dont have [create acc](https://allegro.pl.allegrosandbox.pl/rejestracja)
  * register - [register api](https://apps.developer.allegro.pl.allegrosandbox.pl/new)
1. Replace clientId and clientSercert in AllegroController.ph with your new created API

### Access:
Through admin panel or in example by url: /admin-dev/modules/allegro

###  [Allegro API - documentation](https://developer.allegro.pl/documentation)
