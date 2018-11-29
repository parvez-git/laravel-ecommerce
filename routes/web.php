<?php

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


Route::get('/', 'FrontpageController@index')->name('products');

Route::resource('/cart', 'CartController');
Route::post('/cart/delete-all', 'CartController@deleteAll')->name('cart.delete.all');

Route::get('/order/checkout', 'OrderController@checkout')->name('checkout');
Route::get('/payment/process', 'OrderController@paymentProcess')->name('payment.process');
Route::post('/shippinginfo/store', 'OrderController@shippinginfoStore')->name('shippinginfo.store');
Route::post('/order/store', 'OrderController@store')->name('order.store');


Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', 'HomeController@admin')->name('admin');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/shipping-info', 'HomeController@shippingInfo')->name('home.shippinginfo');

