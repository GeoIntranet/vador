var elixir = require('laravel-elixir');
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
    
    // Sass
    var options = {
        includePaths: [
            'node_modules/foundation-sites/scss',
            'node_modules/motion-ui/src'
        ]
    };
    mix.sass('app.scss', null, options);
    mix.version(['css/app.css']);

    mix.scripts([
        'jquery.js'
    ],'public/js/jq.js');

    mix.scripts([
        'bbcode.js'
    ],'public/js/bbcode.js');

    mix.scripts([
        'foundation.min.js',
        'datepicker.js',
        'foundation-datepicker.fr.js',
        'start_foundation.js'
    ]);
    mix.browserSync({
        proxy: 'localhost/test/vador/public'
    });
 
});
