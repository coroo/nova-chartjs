const mix = require('laravel-mix')

mix
    .setPublicPath('dist')
    .js('resources/js/chart-js-integration.js', 'js')
    // .js('resources/js/nova-apex-chart.js', 'js')
