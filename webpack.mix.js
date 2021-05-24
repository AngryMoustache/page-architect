const mix = require('laravel-mix')

mix.disableSuccessNotifications()
  // .sass('resources/css/page-architect.scss', '../../../public/vendor/page-architect/css')
  .sass('resources/css/page-architect.scss', 'public/css')

if (mix.inProduction()) {
  mix.version()
}
