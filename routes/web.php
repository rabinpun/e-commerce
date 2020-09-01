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

//Route::get('/', function () {
//   return view('welcome');
//});

//landing page

Route::match(['get','post'],'/','IndexController@index')->name('main.index');
Route::match(['get','post'],'/admin','AdminController@login');


//products 
Route::get('/products','ProductsController@index')->name('products.index');
Route::get('/product/{product}','ProductsController@show')->name('products.show');


//cart 
Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/cart','CartController@store')->name('cart.store');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');
Route::delete('/cart/saveforlater/{product}','CartController@saveforlater')->name('cart.saveforlater');
Route::delete('/cart/{product}','CartController@destroy')->name('cart.delete');


//savefor later
Route::delete('/saveforlater/movetocart/{product}','saveforlaterController@movetocart')->name('saveforlater.movetocart');
Route::patch('/saveforlater/{product}','saveforlaterController@update')->name('saveforlater.update');
Route::delete('/saveforlater/{product}','saveforlaterController@destroy')->name('saveforlater.delete');
Route::view('/checkout','main.checkout');
Route::view('/thankyou','main.thankyou');
Route::view('/successpay','main.success');
Route::view('/failpay','main.fail');



//checkout

Route::get('/checkout','checkOutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout','checkOutController@store')->name('checkout.store');

Route::post('/checkout','checkOutController@fetch')->name('checkout.fetch');

//guest checkout
Route::get('/guestcheckout','checkOutController@index')->name('guestcheckout.index');
Route::post('/guestcheckout','checkOutController@store')->name('guestcheckout.store');

//coupons add and delete

Route::post('/coupons','CouponsController@store')->name('coupons.store');
Route::delete('/coupons','CouponsController@destroy')->name('coupons.delete');


//confirmation after success pay
Route::get('/thankyou','ConfirmationController@index')->name('confirmation.index');







Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::view('/home', 'admin.admin_loginpage')->name('home');
