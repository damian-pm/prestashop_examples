# Example - Api "Beer"- Backend

### Install
1. Copy content of this exampel to the root project.
1. Add new routing, passing below code for example to this file:\
  ``/src/PrestaShopBundle/Resources/config/routing/api/features.yml``
  ```yml
  api_stock_list_beer:
    path: /beer
    methods: [GET]
    defaults:
        _controller: prestashop.core.api.beer.controller:indexAction

  ```
1. Register new controller, adding code for example here:\
  ```/src/PrestaShopBundle/Resources/config/services/bundle/controller.yml```
  ```yml
    services:
      _defaults:
          public: true
       ...
      prestashop.core.api.beer.controller:
          class: PrestaShopBundle\Controller\Api\BeerController
          parent: prestashop.core.api.controller
          public: true
  ```

### Access
Now you can get access to this route by url on my server it looks like this:

``presta.test/admin-dev/api/features/beer``

### Helper
Route list
  ```bash
  php bin/console debug:route
  ```
Clear cache
  ```bash
  php bin/console cache:clear
  ```
