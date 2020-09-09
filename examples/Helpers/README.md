# Helpers


<details>
  <summary>Turn on Smarty Debugger (front)</summary>

  ```php
      //file: /var/www/presta_test/config/defines.inc.php
      // Smarty profile switch on/off
      if (!defined('_PS_DEBUG_PROFILING_')) {
          if (strpos($_SERVER['PHP_SELF'], 'admin-') === 1) {
              define('_PS_DEBUG_PROFILING_', false);
          } else {
              define('_PS_DEBUG_PROFILING_', true);
          }
      }
  ```
  ```js
  // Optionas will toggle debugger
      $(document).on('click', '#prestashop_profiling a', (e) => {
        $(e.target).closest('.row').find('.table-condensed ').toggle();
    });
    ```
</details>

<details>
  <summary>Var Dump in Smarty Template</summary>
  
  ```html
     <pre>{$menu|@print_r}</pre>
  ```
</details>
