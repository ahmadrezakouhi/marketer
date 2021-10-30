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
    Route::post('accept/cards','Acountant\CardController@accept')->name('acountant.cards.accept');
    Route::post('decline/cards','Acountant\CardController@decline')->name('acountant.cards.decline');
});
