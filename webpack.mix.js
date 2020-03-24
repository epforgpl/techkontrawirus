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

mix.copy('resources/icomoon/fonts', 'public/fonts');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/ideas.js', 'public/js')
    .js('resources/js/idea.js', 'public/js')
    .js('resources/js/new-idea.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
