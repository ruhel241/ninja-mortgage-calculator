let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

mix.js('src/js/ninja_mortgage_calc.js', 'public/js/ninja_mortgage_calc.js');
mix.js('src/js/UserShowApp.js', 'public/js/UserShowApp.js');