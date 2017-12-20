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
   .sass('resources/assets/sass/app.scss', 'public/css')

mix.copy('node_modules/bootstrap/', 'public/plugins/bootstrap/', false)
mix.copy('node_modules/jquery/', 'public/plugins/jquery/', false)
mix.copy('node_modules/font-awesome/', 'public/plugins/font-awesome/', false)
mix.copy('node_modules/admin-lte/', 'public/theme/', false)

//JS PLUGINS
mix.copy('node_modules/toastr/', 'public/plugins/toastr/', false)
mix.copy('node_modules/sweetalert2/', 'public/plugins/sweetalert2/', false)
mix.copy('node_modules/toastr/', 'public/plugins/toastr/', false)
mix.copy('node_modules/axios/', 'public/plugins/axios/', false)
mix.copy('node_modules/jstree/', 'public/plugins/jstree/', false)

/** APPLICATION JS */

//Login page
mix.js('resources/assets/js/components/Login/index.js', 'public/js/pages/login')
