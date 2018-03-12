# Reactron

To start:

```bash
$ npm install
```

To develop:

You need 3 terminals or tabs

```bash
# First tab: build the web app
$ npm run dev

# Second tab: build the electron app
$ npm run dev-electron
# or
$ webpack --config webpack-electron.config.js

# third tab: run the electron app
$ npm run app
```

To build for production:

1. change `Config.DEBUG` to false
2. set environment NODE_ENV=production
3. webpack
4. webpack --config webpack-electron.config.js
5. electron-packager.cmd . Wechat  --platform=win32 --arch=x64
