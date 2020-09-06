<?php

use App\Order;
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
Route::get('/checkoutcod','checkOutController@codindex')->name('checkoutcod.index');
Route::get('/checkoutes','checkOutController@esindex')->name('checkoutes.index');
Route::post('/checkouts','checkOutController@store')->name('checkout.store');
Route::post('/checkoutcod','checkOutController@codstore')->name('checkoutcod.store');
Route::post('/checkoutes','checkOutController@esstore')->name('checkoutes.store');


//cant use /checkout for 2 posts or more so i renamed checkout for store to checkouts as it is redirected to fail or success if i rrename the address fetch to checkouts and i change province then i will be redirected to checkouts which is not wanted
Route::post('/checkout','checkOutController@fetch')->name('address.fetch');

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


//to check mail template we can view the mail template locally
Route::get('/mail',function(){
    //$cartcontent="Laptop-1:3,Tv-4:7,Mobile-2:5,Laptop-5:1";//creating a random cartcontent
    $order= Order::find(9);//finding a order from order table can be any value just for testing
    //App\Order::find(8) is also correct
    //check that the order id exist i used 1 but there was no order with that id so i view the database and used a existing order 8
    $cartcontents=$order->products;
    return new App\Mail\OrderPlaced($cartcontents,$order);  // new App\Mail\Orderplaced = Mail::(new OrderPlaced($cartcontents,$order)); but we dont need to define the fasade
});