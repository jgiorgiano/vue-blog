const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-polyfill');


const tailwindcss = require('tailwindcss')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    })
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: ["defaults"] //Browser compatibility https://github.com/ai/browserslist
    });

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js')
        },
        extensions: ['.vue', '.js', '.js', '.json'],
    }
});

