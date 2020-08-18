const path = require('path');

module.exports = {
    mode: "development",
    entry: {
        app: './source/js/index.js',
        // print: './src/print.js',
    },
    output: {
        filename: 'custom.js',
        // filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'assets/js'),
    },
    module: {
        rules: [
            {
              test: /\.(scss)$/,
              use: [
                {
                  // Adds CSS to the DOM by injecting a `<style>` tag
                  loader: 'style-loader'
                },
                {
                  // Interprets `@import` and `url()` like `import/require()` and will resolve them
                  loader: 'css-loader'
                },
                {
                  // Loader for webpack to process CSS with PostCSS
                  loader: 'postcss-loader',
                  options: {
                    plugins: function () {
                      return [
                        require('autoprefixer')
                      ];
                    }
                  }
                },
                {
                  // Loads a SASS/SCSS file and compiles it to CSS
                  loader: 'sass-loader'
                }
              ]
            }
        ]
        
    }
};