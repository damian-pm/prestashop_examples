# Widget time
Display real-time watch.

Writed in **Vue.js version 2**

### Install
[How install module look here](https://github.com/damian-pm/prestashop_examples/tree/master/SimpleInstall.md)

### Access
Pin new widget 'ds_time' in ``Admin panel`` > ``Positions`` > ``Translplant a module``.
For example pin it to hook ``displayHome``

OR

Past to any template in themes/ code:
```smarty
  {* for example to file /themes/classic/templates/index.tpl *}
  {widget name="ds_time"}
  {* or *}
  {hook name="ds_time"}
```
