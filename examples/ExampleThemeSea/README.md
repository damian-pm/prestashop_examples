# Example - Basic Theme classic/sea

### Install

1. Copy `/examples/ExampleThemeSea` to your root project dir.
1. Install package npm if node_modules not exists:
  ```bash
  cd themes/sea/_dev
  npm i
  ```
1. After that you can swtich your theme in `Design > Theme & Logo` under this page you will see your new theme. Switch it and thats all.

### Details
**Changing code js or scss**

To compile new changes from js (All files are compiled to dir **/themes/sea/assets**). For example you added code in file ../_dev/js/theme.js run:
```bash
cd /themes/sea/_dev

# This command will build style scss. In primary version PS this dont work with js
npm run build
```
To **compile js files** add new command for npm
```bash
# ../_dev/package.json
"scripts": {
  "build-wb": "webpack --progress --colors --debug --display-chunks"
},

npm run build-wb
# OR watch for real-time changing
npm run watch
```
