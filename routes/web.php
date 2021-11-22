<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackendController;

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
    return view('FrontEnd_Template');
});
Route::get('firebase',[FirebaseController::class,'index']);
// Route::view('customers','customers'); 

//contact start
Route::resource('city',CityController::class);
Route::resource('contact',ContactController::class);


//user route
Route::get('/user/order',[OrderController::class,'orderCreatedByUser'])->name('user.order.create');
Route::get('/user/info',[FrontEndController::class,'userInfo'])->name('user.info');
Route::get('/user/address/list',[FrontEndController::class,'userAddressList'])->name('user.address.list');
Route::get('/user/order/list',[FrontEndController::class,'userOrderList'])->name('user.order.list');
Route::get('/user/home',[FrontEndController::class,'userHomepage'])->name('user.home');






Route::post('/order/store',[OrderController::class,'orderStoredByUser'])->name('user.order.store');

Route::delete('/order/{id}',[OrderController::class,'orderDestroy'])->name('order.delete');


///admin start---------------------------------

//Tour Crud process 
Route::prefix('tour')->group(function () {

Route::get('/',[BackendController::class,'tourIndex'])->name('tour.index');
Route::get('/create',[BackendController::class,'tourCreate'])->name('tour.create');

Route::get('/{id}',[BackendController::class,'tourShow'])->name('tour.show');

Route::post('/store',[BackendController::class,'tourStore'])->name('tour.store');

Route::get('/{id}/edit',[BackendController::class,'tourEdit'])->name('tour.edit');

Route::put('/{id}',[BackendController::class,'tourUpdate'])->name('tour.update');

Route::delete('/{id}',[BackendController::class,'tourDestroy'])->name('tour.destroy');

Route::get('/get/tours',[BackendController::class,'getTourAjax'])->name('ajax.gettourAjax');

});

Route::prefix('admin')->group(function () {

    Route::get('/dashboard',[BackendController::class,'dashboard'])->name('dashboard.index');

    // customer start
    Route::prefix('/orders')->group(function () {

        Route::get('/',[BackendController::class,'orderIndex'])->name('admin.order.list');


        Route::get('/create/new',[BackendController::class,'orderCreate'])->name('admin.order.create');

    });
   
    // customer start
    Route::prefix('/customer')->group(function () {
    Route::get('/',[BackendController::class,'customerIndex'])->name('customer.index');

    });

});

