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

mix
    .sass('resources/sass/style.scss','public/assets/css/style.css')
    .scripts('node_modules/jquery/dist/jquery.js','public/assets/jquery/jquery.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets/bootstrap/bootstrap.js')
    .scripts('node_modules/perfect-scrollbar/dist/perfect-scrollbar.js','public/assets/perfect-scrollbar/perfect-scrollbar.js')
    .scripts('resources/js/waves.js','public/assets/js/waves.js')
    .scripts('resources/js/sidebarmenu.js','public/assets/js/sidebarmenu.js')
    .scripts('node_modules/sticky-kit/dist/sticky-kit.js','public/assets/sticky-kit/sticky-kit.js')
    .scripts('node_modules/jquery-sparkline/jquery.sparkline.js','public/assets/jquery-sparkline/jquery.sparkline.js')
    .scripts('resources/js/custom.js','public/assets/js/custom.js');
