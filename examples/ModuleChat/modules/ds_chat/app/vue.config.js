// vue.config.js
module.exports = {

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
    filenameHashing: false,
    chainWebpack: config => {
        config.module.rules.delete('eslint');
    }
  }
