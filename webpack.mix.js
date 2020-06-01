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

mix
  .sass('resources/sass/addCustomization.scss', 'public/css')
  .sass('resources/sass/addItem.scss', 'public/css')
  .sass('resources/sass/admin.scss', 'public/css')
  .sass('resources/sass/adminOrders.scss', 'public/css')
  .sass('resources/sass/adminItem.scss', 'public/css')
  .sass('resources/sass/adminItems.scss', 'public/css')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/fullOrder.scss', 'public/css')
  .sass('resources/sass/editItem.scss', 'public/css')
  .sass('resources/sass/login.scss', 'public/css')
  .sass('resources/sass/join.scss', 'public/css')
  .sass('resources/sass/customize.scss', 'public/css')
  .sass('resources/sass/pagination.scss', 'public/css')
  .sass('resources/sass/product.scss', 'public/css')
  .sass('resources/sass/products.scss', 'public/css')
  .sass('resources/sass/home.scss', 'public/css')
  .sass('resources/sass/authorizeCustomization.scss', 'public/css')
  .sass('resources/sass/reviewGallery.scss', 'public/css')
  .js('resources/js/addCustomization.js', 'public/js')
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/bootstrap.js', 'public/js')
  .js('resources/js/customize.js', 'public/js')
  .js('resources/js/product.js', 'public/js')
  .js('resources/js/reviewGallery.js', 'public/js')
  .copyDirectory('resources/images', 'public/images');
