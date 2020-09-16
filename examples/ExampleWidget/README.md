# Example - Widget - Simple calendary
Displayed calendary js

Example is writen in JQuery
Source: https://www.jqueryscript.net/time-clock/animated-event-calendar.html

### Install
1. Copy example to project
1. Run command:
    ```bash
    php bin/console prestashop:module install calendary
    ```
1. Now you can past to any template in themes/ code:
    ```smarty
    {* for example to file /themes/StarterTheme/templates/index.tpl *}
    {widget name="calendary"}
    {* or *}
    {hook name="calendary"}

    ```
