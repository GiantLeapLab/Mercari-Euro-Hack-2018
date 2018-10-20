const path = require('path');
const merge = require('webpack-merge');
const webpackConfig = require('./webpack.config');

module.exports = merge(webpackConfig, {

    devtool: 'source-map',

    output: {
        pathinfo: true,
        path: path.join(__dirname, '../web/js'),
        filename: '[name].min.js'
    },

    devServer: {
        // host: '192.168.31.166',
        port: 3000,
        https: true
    }

});
