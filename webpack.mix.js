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
    .sass('resources/sass/payment.scss', 'public/css/payment.css')
    .sass('resources/sass/doctor/doctor.scss', 'public/css/doctor/doctor.css')
    .sass('resources/sass/pharmacist/pharmacist.scss', 'public/css/pharmacist/pharmacist.css')
    .sass('resources/sass/patient/schedule_doctor.scss', 'public/css/patient/schedule_doctor.css');
