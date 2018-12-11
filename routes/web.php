<?php

Route::get('/', 'FrontpageController@index')->name('products');

Route::resource('/cart', 'CartController');
Route::post('/cart/delete-all', 'CartController@deleteAll')->name('cart.delete.all');

Route::get('/order/checkout', 'OrderController@checkout')->name('checkout');
Route::get('/payment/process', 'OrderController@paymentProcess')->name('payment.process');
Route::post('/shippinginfo/store', 'OrderController@shippinginfoStore')->name('shippinginfo.store');
Route::post('/order/store', 'OrderController@store')->name('order.store');

Route::post('payment/stripe', 'OrderController@postPaymentWithStripe')->name('payment.stripe');


Auth::routes();

// SOCIALITE
Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('github.login');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


// ADMIN
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', 'AdminController@admin')->name('admin');
    Route::put('/paymentstatusupdate/{orderid}', 'AdminController@paymentStatusUpdate')->name('admin.paymentstatusupdate');

    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
});

// USER
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/shipping-info', 'HomeController@shippingInfo')->name('home.shippinginfo');
Route::get('/home/orderdetails/{orderid}', 'HomeController@orderDetails')->name('home.orderdetails');

