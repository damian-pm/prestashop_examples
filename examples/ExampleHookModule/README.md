# Example - Hook module

What you will see:
* attached module to hook
* hook called in template


### Install
1. Copy example to the root project
1. Register new module
      ```bash
      php bin/console prestashop:module install callme
      # or reset existed module
      php bin/console prestashop:module reset callme
      ```

### Details
**hookDisplayFooter**
 this method will be attached to the hook ``displayFooter`` and rendered with other modules.

**Change position modules in hook**
Go to ``Admin Panel > Design > Positions`` using searching find displayFooter, you will see 4 modules attached to hook you can change them position and remove them.
If you want add module go to ``Transplant a module``

**Order rendered template**
I past template to themes/sea/modules/callme/callme_dist.tpl this template if u change file name to callme.tpl will be higher priority for PS and rendered instead template callme.tpl in /modules/callme
