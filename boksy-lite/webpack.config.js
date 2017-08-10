//webpack.config.js

var webpack = require('webpack')

module.exports = {
  // ...
  plugins: [
    // ...
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    })
  ]
}

module.exports = function(env) {
    return {
      entry: "./js/app.js",
        output: {
            path: __dirname + "/dist",
            filename: "bundle.js"
        },
    }
}
