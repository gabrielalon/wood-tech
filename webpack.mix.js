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

mix.js('resources/assets/web/js/web.js', 'public/js')
    .sass('resources/assets/web/sass/web.scss', 'public/css')
    .sourceMaps()
    .version();

mix.js('resources/assets/admin/js/admin.js', 'public/js')
    .sass('resources/assets/admin/sass/admin.scss', 'public/css')
    .sourceMaps()
    .version();
