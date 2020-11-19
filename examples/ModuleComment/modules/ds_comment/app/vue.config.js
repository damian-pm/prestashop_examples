// vue.config.js
module.exports = {
    configureWebpack: {
      // No need for splitting
      optimization: {
        splitChunks: false
      }
    },
    configureWebpack: {
        entry:{
          'main': './src/main.js',
        },
        output: {
          filename: '[name].bundle.js'
        },
        optimization: {
          splitChunks: false
        },
      },
      filenameHashing: false
  }
