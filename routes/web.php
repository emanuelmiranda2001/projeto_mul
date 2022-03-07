<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

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

Route::get('/home', [App\Http\Controllers\ProductController::class, 'getIndex'])->name('home');

Auth::routes(['verify' => true]);

//SHOP
Route::get('/add-to-cart/{id}', [App\Http\Controllers\ProductController::class, 'getAddToCart'])->name('product.addToCart')->middleware('auth', 'verified');
Route::get('/shopping-cart', [App\Http\Controllers\ProductController::class, 'getCart'])->name('product.shoppingCart')->middleware('auth', 'verified');
Route::get('/reduce/{id}', [App\Http\Controllers\ProductController::class, 'getReduceByOne'])->name('product.reduceByOne')->middleware('auth', 'verified');
Route::get('/remove/{id}', [App\Http\Controllers\ProductController::class, 'getRemoveItem'])->name('product.remove')->middleware('auth', 'verified');
Route::get('/checkout', [App\Http\Controllers\ProductController::class, 'getCheckout'])->name('checkout')->middleware('auth', 'verified');
Route::post('/checkout', [App\Http\Controllers\ProductController::class, 'postCheckout'])->name('checkout')->middleware('auth', 'verified');

Route::post('/paypal', [App\Http\Controllers\PaymentController::class, 'payWithpaypal'])->name('paypal')->middleware('auth', 'verified');
Route::get('/status', [App\Http\Controllers\PaymentController::class, 'getPaymentStatus'])->name('status')->middleware('auth', 'verified');

//USERS

Route::get('users/profile', 'App\Http\Controllers\UserController@edit')->name('users.edit-profile')->middleware('auth', 'verified');
Route::post('users/profile', 'App\Http\Controllers\UserController@update')->name('users.update-profile')->middleware('auth', 'verified');

Route::get('users/orders', 'App\Http\Controllers\UserController@getOrders')->name('user.orders')->middleware('auth', 'verified');

Route::get('/specs', [App\Http\Controllers\SpecsController::class, 'index'])->name('specs');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/reserve', [App\Http\Controllers\ReserveController::class, 'index'])->name('reserve');

Route::get('new_fpost','App\Http\Controllers\FpostsController@create')->name('new_fpost')->middleware('auth', 'verified');
Route::post('new_fpost','App\Http\Controllers\FpostsController@store')->middleware('auth', 'verified');
Route::get('index_fposts', 'App\Http\Controllers\FpostsController@indexFposts')->name('index_fposts')->middleware('auth', 'verified');
Route::get('fposts/{id}', 'App\Http\Controllers\FpostsController@show')->middleware('auth', 'verified');
Route::post('comment','App\Http\Controllers\FpostCommentsController@postComment')->middleware('auth', 'verified');
Route::get('fposts/{id}/edit', 'App\Http\Controllers\FpostsController@edit')->name('edit_fpost')->middleware('auth','verified');
Route::post('fposts/{id}/edit', 'App\Http\Controllers\FpostsController@update')->middleware('auth','verified');

// ADMIN ROUTES
Route::group(['middleware' => 'role:admin'], function() {
	Route::get('users/{id}/edit', 'App\Http\Controllers\UserController@editUser')->name('users.edit')->middleware('auth', 'verified');
	Route::post('users/{id}/edit', 'App\Http\Controllers\UserController@updateUser')->name('users.update-user')->middleware('auth', 'verified');	
    Route::get('users/allorders', 'App\Http\Controllers\UserController@getAllOrders')->name('admin.orders')->middleware('auth', 'verified');
});

Route::resource('products', 'App\Http\Controllers\ProductController')->middleware('auth', 'verified');

Route::resource('users', 'App\Http\Controllers\UserController')->middleware('auth', 'verified');

Route::group(['middleware' => 'role:admin'], function() {
    Route::get('fpostsall', 'App\Http\Controllers\FpostsController@allFposts')->name('fpostsall');
    Route::post('admin/status_fpost/{id}', 'App\Http\Controllers\FpostsController@status');
});

