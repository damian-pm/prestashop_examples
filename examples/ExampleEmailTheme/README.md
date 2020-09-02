# Example Email Theme - Basic - Modern Sea - /mails
This is the same theme like classic.

**If you want to send emails, you have to install server SMTP. And configurate it in file ``/app/config/parameters.php``**

### Install
1. Copy example to the root project.

PrestaShop will see automatically new email theme

### Access
You can change new theme in `Admin Panel > Design > Email Theme`
or simple by url:

http://presta.test/admin-dev/index.php/improve/design/mail_theme

### Test
Send email via console:
```bash
php bin/console swiftmailer:email:send
```
