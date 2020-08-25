# Example - webservice api
Simple webservice api writed in clear php it is write according to version 1.6 so old... but it works for 1.7.6.x version.

### Step 1 - Install

1. Register namespace 'Modules' like in this example (only first step is required): [Example - Simple Allegro Module ](https://github.com/damian-pm/prestashop_examples/tree/master/examples/ExampleModuleAllegro)
1. Copy this example ``(ExampleWebserviceApi)`` to the root of your project
1. Install module 'callme':
    ```bash
    php bin/console prestashop:module install callme
    ```

1. Clear cache
  ```bash
  php bin/console cache:clear
  ```

### Step 2 - Register webservice

Before we will get access to the new webservice api we have to generate new api key.

1. In admin panel prestashop, main menu go to
``Advanced Parameters >  Webservice``:
  * Enable options:
    * Enable PrestaShop's webservice
    * Enable CGI mode for PHP

  * next find button ``Add new webservice key``.
    * Key - click generate or write your custome text
    * Permissions - find in table webservice 'callme' and give full access

    ... and save

### Step 3 - Access from browser
Now on we can have access to the api by url /api/callme
in example :``http://presta.test/api/callme``.

After that browser will ask you for login and password. Go again to the ``Advanced Parameters >  Webservice`` copy new created api key in my example was 'JMEKRA1GY635KXG4C2W577WA6SR6519I'.

So now we can go back to the login panel and past api key to the login input, password we leave empty. Click login and now you get xml response, list of customers.

### Details

The most importent file is ``/classes/webservice/WebserviceSpecificManagementCallme.php`` and there method called ``manage(){}``. I past there a few tips:
  ```php
  ...
  $fieldsToDisplay  = 'full'; // 'minimum', 'full'
  $schema           = ''; // 'synopsis' - show customer column details, 'blank', null
  $deep             = 0; // depth for the tree diagram output
  $viewList         = WebserviceOutputBuilder::VIEW_LIST; //  ::VIEW_LIST , ::VIEW_DETAILS
  $override         = false;

  $this->output    .= $this->webServiceBuilder->getContent($objects_products, $schema, $fieldsToDisplay, $deep, $viewList, $override);
  ```
