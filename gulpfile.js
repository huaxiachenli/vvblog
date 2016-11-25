const elixir = require('laravel-elixir');


require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
});
// elixir(function(mix){
//     mix.sass('app.scss');
//     mix.scripts([
//         'app.js',
//         'application.js',
//
//         'bootstrap-markdown.js',
//         'bootstrap-markdown.zh.js',
//         'jquery.hotkeys.js',
//         'markdown.js',
//         'select2.js'
//     ],'public/js/final.js');
// })
// elixir(function(mix) {
//     mix.scripts([
//
//         './public/js/app.js',
//         'bootstrap-markdown.js',
//         'bootstrap-markdown.zh.js',
//         'jquery.hotkeys.js',
//         'markdown.js',
//         'select2.js',
//         'to-markdown.min.js',
//         'application.js',
//
//     ]).sass('app.scss');
// });
// elixir(function(mix) {
//     mix.sass('application.scss');
// });
