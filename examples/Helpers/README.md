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
</details>

<details>
  <summary>Var Dump in Smarty Template</summary>
  ```smarty
       <pre>{$menu|@print_r}</pre>
  ```
</details>
