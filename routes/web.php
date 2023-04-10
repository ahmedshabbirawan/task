<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [HomeController::class, 'home'])->name('main');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('business-detail/{id}', [BusinessController::class,'show'])->name('businesses.detail');



Route::middleware(['web','auth'])->group(function () {


    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
    Route::get('/after_login', [App\Http\Controllers\Auth\LoginController::class, 'after_login']);

    Route::group(['prefix'=>'business','as' => 'businesses.'],function(){
        Route::get('/create', [BusinessController::class,'create'])->name('create');
        Route::post('/business', [BusinessController::class,'store'])->name('store');
    });

    Route::group(['prefix'=>'order','as' => 'order.'],function(){
        Route::post('/place_order', [CustomerOrderController::class,'place_order'])->name('place_order');
        Route::get('/get_customer_order', [CustomerOrderController::class,'get_customer_orders'])->name('get_customer_order');
        Route::get('/get_business_order', [CustomerOrderController::class,'get_business_order'])->name('get_business_order');
        Route::get('/disatch_order', [CustomerOrderController::class,'disatch_order'])->name('disatch_order');
        Route::get('/by_customer', [CustomerOrderController::class,'by_customer'])->name('by_customer');
    });

    Route::post('/save-token', [UserController::class, 'saveToken'])->name('save-token');
    Route::get('/send-notification', [UserController::class, 'sendNotification'])->name('send.notification');
 });
