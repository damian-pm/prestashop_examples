# Module - Translation manager
Very simple manager, you can sort them by text or by language. On the 'Custom translate' you can override existing translations.
After added one, you can use them by passing in template.

### Required
* Bootstrap 4
* JQuery-ui

![alt text](screen.png "translate manager")


Watch out for naming domain. ShopThemeActions work only in themes/
### Usage
#### Smarty:
```smarty
# EmailsBody
{l s='Contact' d='Admin.Navigation.Footer'}
```
#### Twig:
```twig
# AdminNavigationFooter
{{'Hi {firstname} {lastname},'|trans({}, 'Emails.Body')}}
```

**Remember to clear cache! Sometimes PS not caching changes.**

### Install
[install module - look here](https://github.com/damian-pm/prestashop_examples/tree/master/SimpleInstall.md)


