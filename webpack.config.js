var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')

    .addEntry('formbooking', './public/styleperso/formbooking.js')
    .addEntry('payment', './public/styleperso/payment.js')
    .addEntry('scrollup', './public/styleperso/scrollup.js');


module.exports = Encore.getWebpackConfig();
