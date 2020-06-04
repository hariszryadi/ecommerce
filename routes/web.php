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

Route::get('/', 'Ecommerce\FrontEndController@index')->name('frontend.index');
Route::get('/product', 'Ecommerce\FrontEndController@product')->name('frontend.product');
Route::get('/category/{slug}', 'Ecommerce\FrontEndController@categoryProduct')->name('frontend.category');
Route::get('/product/{slug}', 'Ecommerce\FrontEndController@show')->name('frontend.show_product');
Route::post('cart', 'Ecommerce\CartController@addToCart')->name('frontend.cart');
Route::get('/cart', 'Ecommerce\CartController@listCart')->name('frontend.list_cart');
Route::post('/cart/update', 'Ecommerce\CartController@updateCart')->name('frontend.update_cart');
Route::get('/checkout', 'Ecommerce\CartController@checkout')->name('frontend.checkout');
Route::post('/checkout', 'Ecommerce\CartController@processCheckout')->name('frontend.store_checkout');
Route::get('/checkout/{invoice}', 'Ecommerce\CartController@checkoutFinish')->name('frontend.finish_checkout');

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function(){
    Route::get('login', 'LoginController@loginForm')->name('customer.login');
    Route::get('verify/{token}', 'FrontEndController@verifyCustomerRegistration')->name('customer.verify');
    Route::post('login', 'LoginController@login')->name('customer.post_login');

    Route::group(['middleware' => 'customer'], function() {
        Route::get('dashboard', 'LoginController@dashboard')->name('customer.dashboard');
        Route::get('logout', 'LoginController@logout')->name('customer.logout');
    });
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    
    // category
    Route::resource('category', 'CategoryController')->except(['craete', 'show']);

    // product
    Route::resource('product', 'ProductController')->except(['show']);
    ROute::get('/product/bulk', 'ProductController@massUploadForm')->name('product.bulk');
    ROute::post('/product/bulk', 'ProductController@massUpload')->name('product.saveBulk');
});

