const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.react('resources/js/review-columns-setting-app/index.js', 'public/js/review-columns-setting-app.js');

mix.react('resources/js/info-columns-setting-app/index.js', 'public/js/info-columns-setting-app.js');

// for dev purpose: live reloading
var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [
        new LiveReloadPlugin()
    ]
});
