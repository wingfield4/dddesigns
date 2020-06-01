<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController');

Route::get('about', 'AboutController');

Route::post('admin/submitCustomization', 'AdminController@submitCustomization');
Route::post('admin/submitEditCustomization', 'AdminController@submitEditCustomization');
Route::post('admin/submitEditInformation', 'AdminController@submitEditInformation');
Route::post('admin/submitInformation', 'AdminController@submitInformation');
Route::post('admin/submitItem', 'AdminController@submitItem');
Route::post('admin/submitEditItem', 'AdminController@submitEditItem');
Route::post('admin/submitItemImage', 'AdminController@submitItemImage');
Route::post('admin/applyOrderFilters', 'AdminController@applyOrderFilters');

Route::get('admin/deleteImage/{imageId}/{itemId}', 'AdminController@deleteImage');
Route::get('admin/deleteCustomization/{customizationId}', 'AdminController@deleteCustomization');
Route::get('admin/deleteInformation/{informationId}', 'AdminController@deleteInformation');

Route::get('admin', 'AdminController');
Route::get('admin/file/{fileName}', 'AdminController@file');
Route::get('admin/users', 'AdminController@users');
Route::get('admin/order/{orderNumber}', 'AdminController@order');
Route::get('admin/orders', 'AdminController@orders');
Route::get('admin/item/{itemId}/edit', 'AdminController@editItem');
Route::get('admin/item/{itemId}/publicize', 'AdminController@publicizeItem');
Route::get('admin/item/{itemId}/privatize', 'AdminController@privatizeItem');
Route::get('admin/item/{itemId}', 'AdminController@item');
Route::get('admin/items/add', 'AdminController@addItem');
Route::get('admin/items', 'AdminController@items');
Route::get('admin/item/{itemId}/addCustomization', 'AdminController@addItemCustomization');
Route::get('admin/editCustomization/{customizationId}', 'AdminController@editItemCustomization');
Route::get('admin/item/{itemId}/addImages', 'AdminController@addItemImages');
Route::get('admin/item/{itemId}/addInformation', 'AdminController@addItemInformation');
Route::get('admin/editInformation/{informationId}', 'AdminController@editItemInformation');

Route::get('faqs', function () {
    return view('faqs');
});

Route::get('join', 'JoinController');
Route::post('join', 'JoinController@submit');

Route::post('login', 'LoginController@authenticate')->name('login');
Route::get('login', 'LoginController');
Route::get('logout', 'LoginController@logout');

Route::post('orders/submit', 'OrdersController@submit');
Route::post('orders/submitPayment', 'OrdersController@submitPayment');

Route::get('orders', 'OrdersController');
Route::get('orders/{orderNumber}', 'OrdersController@view');

Route::get('products/{itemPageUrl}/authorize', 'ProductsController@authorizeCustomization');
Route::post('products/{itemPageUrl}/authorize', 'ProductsController@authorizeCustomizationSubmit');
Route::get('products/{itemPageUrl}/customize', 'ProductsController@customize');
Route::get('products/{itemPageUrl}', 'ProductsController@product');
Route::get('products', 'ProductsController');

Route::get('welcome', 'WelcomeController');
