const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        'pace-theme-minimal.css',
        'bootstrap.css',
        'font-awesome.css',
        'animate.css',
        'toastr.min.css',
        'magnific-popup.css',
        'style.css',
    ]);

    mix.scripts([
        'pace.min.js',
        'jquery-1.12.3.min.js',
        'bootstrap.min.js',
        'nano-scroller.js',
        'template-script.min.js',
        'toastr.min.js',
        'chart.min.js',
        'jquery.magnific-popup.min.js',
    ]);

    mix.browserSync();
});
