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
   .js('resources/js/sticky-kit_users.js', 'public/js')
   .js('resources/js/lazyload_users.js', 'public/js')
   .copy([
   'node_modules/jquery/dist/jquery.min.js',
   'node_modules/sticky-kit/dist/sticky-kit.min.js'
   ], 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
       autoprefixer: {
           options: {
               browsers: [
                   'last 6 versions'
               ]
           }
       }
   });
