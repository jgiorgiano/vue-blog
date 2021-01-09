const mix = require('laravel-mix');
const path = require('path');


const tailwindcss = require('tailwindcss')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    });

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js')
        },
        extensions: ['.vue', '.js', '.js', '.json'],
    }
});

