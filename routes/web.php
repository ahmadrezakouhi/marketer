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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::post('logout',function(){
    Auth::logout();
    return redirect('login');
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {

    Route::resource('user', 'Admin\UserController');


    Route::resource('surgery', 'Admin\SurgeryController');

    Route::resource('marketer', 'Admin\MarketerController');

});

Route::prefix('marketer')->group(function () {

    Route::resource('customer', 'Marketer\CustomerController');

    Route::resource('card', 'Marketer\CardController');

    Route::resource('marketers', 'Marketer\MarketerController');

    Route::resource('payments', 'Marketer\PaymentController');

});


Route::prefix('acountant')->group(function(){

    Route::get('cards','Acountant\CardController@index')->name('acountant.cards.index');

    Route::post('cards/accept','Acountant\CardController@accept')->name('acountant.cards.accept');

    Route::post('cards/decline','Acountant\CardController@decline')->name('acountant.cards.decline');

    Route::get('payments','Acountant\PaymentController@index')->name('acountant.payments.index');

    Route::post('payments/accept','Acountant\PaymentController@accept')->name('acountant.payments.accept');

    Route::post('payments/decline','Acountant\PaymentController@decline')->name('acountant.payments.decline');

});



Route::prefix('adviser')->group(function ()
{
   Route::get('orders','Adviser\OrderController@index')->name('adviser.orders.index');
   Route::post('orders/accept','Adviser\OrderController@accept')->name('adviser.orders.accept');
   Route::post('orders/decline','Adviser\OrderController@decline')->name('adviser.orders.decline');
});
