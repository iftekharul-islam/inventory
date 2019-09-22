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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/paypal', 'PaymentController@payWithpaypal');

// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function()
{


	Route::get('dashboard','DashboardControlller@index')->name('dashboard');
	Route::resource('tag','TagController');
	Route::resource('customer','CustomerController');
	Route::resource('product','ProductController');
	Route::get('invoice/payment','InvoiceController@payment');
	Route::resource('invoice','InvoiceController');

	// route for processing payment
	Route::post('invoice/paypal', 'InvoiceController@payWithpaypal');

	// route for check status of the payment
	// Route::get('invoice/status', 'InvoiceController@getPaymentStatus');

});

Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){

	Route::get('dashboard','DashboardControlller@index')->name('dashboard');


});
