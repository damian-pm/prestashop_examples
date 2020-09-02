# Example - Theme Email in Module
This theme is like classic example theme.

### Install
You have 2 options to create email theme in module:
1. Just copy example to the root project

  or

1. Make example from previousle task [click here](https://github.com/damian-pm/prestashop_examples/tree/master/examples/ExampleEmailTheme), this will be a skeleton for **PrestaShop generator** and it will copy it to the dir `themes/sea/mails`, if you dont have directory `mails` in themes/ this wont generate theme.

  PrestaShop can generate theme in `Admin Panel > Design > Email Theme`.
  * Slect theme, are only dirs from `/mails`
  * select lang
  etc.
  click 'generate' and vua la you have new email theme in `themes/`

### Error - Bug 'CssToAttributeConverter' - how fix it
In version 1.7.6.7 is not fixed yet.

file : /src/Core/MailTemplate/Transformation/CSSInlineTransformation.php
```php
$converter = new CssToAttributeConverter($templateContent);
// replace with this
$converter = CssToAttributeConverter::fromHtml($templateContent);
```
