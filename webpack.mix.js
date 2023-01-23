const mix = require('laravel-mix');
require('laravel-mix-blade-reload');


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/app.css', 'public/css')
    .bladeReload();
