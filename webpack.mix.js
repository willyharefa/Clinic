const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/index.scss', 'public/css/index.css')
    .sass('resources/sass/admin.scss', 'public/css/admin.css')
    .sass('resources/sass/patient.scss', 'public/css/patient.css')
    .sass('resources/sass/presets.scss', 'public/css/presets.css')
    .sass('resources/sass/dashboard.scss', 'public/css/dashboard.css')
    .sass('resources/sass/payment.scss', 'public/css/payment.css')
    .sass('resources/sass/doctor.scss', 'public/css/doctor.css')
    .sass('resources/sass/pharmacist.scss', 'public/css/pharmacist.css')
