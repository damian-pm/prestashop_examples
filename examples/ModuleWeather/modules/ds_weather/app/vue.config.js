module.exports = {
    // baseUrl: '/progressive-weather-app/',
    baseUrl: '/modules/ds_weather/app/dist/',
    pwa: {
        themeColor: '#6CB9C8',
        msTileColor: '#484F60'
    },
    // chainWebpack: config => {
    //   if(config.plugins.has('extract-css')) {
    //     const extractCSSPlugin = config.plugin('extract-css')
    //     extractCSSPlugin && extractCSSPlugin.tap(() => [{
    //       filename: '[name].css',
    //       chunkFilename: '[name].css'
    //     }])
    //   }
    // },
    css: {
      // extract CSS in components into a single CSS file (only in production)
      // can also be an object of options to pass to extract-text-webpack-plugin
      extract: false,
      // Enable CSS modules for all css / pre-processor files.
      // This option does not affect *.vue files.
      modules: true,
      // enable CSS source maps?
      sourceMap: false,

      loaderOptions: {
          sass:{
              css: 'css-loader',
              'scss':'css-loader | sass-loader'
          }
      }
  },
    configureWebpack: {
      output: {
        jsonpFunction: 'jsonpFunction',
        filename: '[name].js',
        chunkFilename: '[name].js'
      }
    }
}
