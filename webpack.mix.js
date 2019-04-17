let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .scripts(//tema
        [
            //dependencias
            './node_modules/jquery/dist/jquery.js',
            "./node_modules/popper.js/dist/umd/popper.js",
            './node_modules/bootstrap/dist/js/bootstrap.js',
            './node_modules/admin-lte/dist/js/adminlte.js',
            './node_modules/moment/moment.js',
            './node_modules/moment/locale/es.js',

        ],
        './public/js/vendor.js'
    )
   .sass('resources/assets/sass/app.scss', 'public/css')
   .webpackConfig({ devtool: "source-map" });
