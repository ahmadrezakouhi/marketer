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
    return redirect('login');
});

Auth::routes();
Route::post('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');



Route::prefix('admin')->group(function () {

    Route::get('dashboard', 'Admin\DashboardController@dashboard')->middleware('super_admin')->name('admin.dashboard');
    Route::get('sub-marketers', 'Admin\SubMarketerController@index')->middleware('super_admin')->name('admin.sub-marketer');

    Route::resource('user', 'Admin\UserController')->middleware('super_admin');

    Route::resource('surgery', 'Admin\SurgeryController')->middleware('super_admin');

    Route::resource('marketer', 'Admin\MarketerController')->middleware('admin');
});

Route::middleware('marketer')->prefix('marketer')->group(function () {

    Route::get('dashboard', 'Marketer\DashboardController@dashboard')->name('marketer.dashboard');
    Route::get('sub-marketers', 'Marketer\SubMarketerController@index')->name('marketer.sub-marketer');


    Route::resource('customer', 'Marketer\CustomerController');

    Route::resource('card', 'Marketer\CardController');

    Route::resource('marketers', 'Marketer\MarketerController');

    Route::resource('payments', 'Marketer\PaymentController');

    Route::get('wallet-amount', 'Marketer\PaymentController@getWalletAmount')->name('wallet.amount');
});


Route::middleware('accountant')->prefix('accountant')->group(function () {

    Route::get('cards', 'Acountant\CardController@index')->name('acountant.cards.index');

    Route::post('cards/accept', 'Acountant\CardController@accept')->name('acountant.cards.accept');

    Route::post('cards/decline', 'Acountant\CardController@decline')->name('acountant.cards.decline');

    Route::get('payments', 'Acountant\PaymentController@index')->name('acountant.payments.index');

    Route::post('payments/accept', 'Acountant\PaymentController@accept')->name('acountant.payments.accept');

    Route::post('payments/decline', 'Acountant\PaymentController@decline')->name('acountant.payments.decline');
});



Route::middleware('adviser')->prefix('adviser')->group(function () {
    Route::get('orders', 'Adviser\OrderController@index')->name('adviser.orders.index');
    Route::post('orders/accept', 'Adviser\OrderController@accept')->name('adviser.orders.accept');
    Route::post('orders/decline', 'Adviser\OrderController@decline')->name('adviser.orders.decline');

    Route::post('add/orders', 'Adviser\OrderController@addOrder')->name('adviser.orders.add');

    Route::get('owner/orders', 'Adviser\OrderController@owner')->name('adviser.orders.owner');
});


Route::get('change-password', 'Common\PasswordController@index')
    ->middleware('auth')->name('common.change-password');
Route::patch('update-password', 'Common\PasswordController@updatePassword')
    ->middleware('auth')->name('common.update-password');
