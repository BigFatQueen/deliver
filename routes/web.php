<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StaffController;



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
Route::get('firebase', [FirebaseController::class, 'index']);
// Route::view('customers','customers'); 

//contact start
Route::resource('city', CityController::class);
Route::resource('contact', ContactController::class);


//user route
Route::get('/user/order', [OrderController::class, 'orderCreatedByUser'])->name('user.order.create');
Route::get('/user/info', [FrontEndController::class, 'userInfo'])->name('user.info');
Route::get('/user/address/list', [FrontEndController::class, 'userAddressList'])->name('user.address.list');
Route::get('/user/order/list', [FrontEndController::class, 'userOrderList'])->name('user.order.list');

// order search --------
Route::post('/order/search', [FrontEndController::class, 'orderSearch'])->name('order.search');
Route::get('/user/home', [FrontEndController::class, 'userHomepage'])->name('user.home');

Route::get('/get/orders/{status}',[FrontEndController::class,'userOrderbyStatus'])->name('user.order.status');




Route::post('/order/store', [OrderController::class, 'orderStoredByUser'])->name('user.order.store');

Route::get('/order/{id}', [OrderController::class, 'orderDetail'])->name('user.order.detail');
// for user
Route::delete('/order/{id}', [OrderController::class, 'orderDestroy'])->name('order.delete');



///admin start---------------------------------



Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [BackendController::class, 'dashboard'])->name('dashboard.index');

    // customer start
    Route::prefix('/orders')->group(function () {

        Route::get('/', [BackendController::class, 'orderIndex'])->name('admin.order.list');


        Route::get('/create/new', [BackendController::class, 'orderCreate'])->name('admin.order.create');

        Route::get('/getAddressByuid/{id}', [BackendController::class, 'getAddressByuid'])->name('admin.order.getAddress');

        Route::get('/detail/{id}',[OrderController::class,'orderDetailByAdmin'])->name('admin.order.detail');

         Route::get('/edit/{id}',[OrderController::class,'orderEditByAdmin'])->name('admin.order.edit');

         Route::put('/update/{id}',[OrderController::class,'orderUpdateByAdmin'])->name('admin.order.update');

        Route::delete('/delete/{id}',[OrderController::class,'orderDeleteByAdmin'])->name('admin.order.destroy');

        Route::post('/date/filter',[OrderController::class,'orderDateFilter'])->name('admin.order.date.filter');

        Route::get('/import',[BackendController::class,'orderImport'])->name('admin.order.import');

         Route::post('/readExcel',[BackendController::class,'readExcel'])->name('admin.order.readExcel');

         Route::post('/importExcel',[BackendController::class,'importExcel'])->name('admin.order.importExcel');
    });

    Route::prefix('/address')->group(function () {
        Route::get('/create/{id}', [ContactController::class, 'addressCreateByUid'])->name('admin.address.createbyui');


        Route::get('/edit/{id}', [ContactController::class, 'addressEdit'])->name('admin.address.edit');

        Route::get('/getall/{id}', [ContactController::class, 'addressbyuserid'])->name('admin.userid.addresses');


    });

    // customer start
    Route::prefix('/customer')->group(function () {
        Route::get('/', [BackendController::class, 'customerIndex'])->name('admin.customer.index');
    });

    Route::prefix('/rp')->group(function(){
        Route::get('/',[BackendController::class,'roleIndex'])->name('admin.rp.index');
        Route::get('/r/create',[BackendController::class,'roleCreate'])->name('admin.rp.role.create');
        Route::post('/r/store',[BackendController::class,'roleStore'])->name('admin.rp.role.store');
         Route::get('/r/show/{id}',[BackendController::class,'roleShow'])->name('admin.rp.role.show');
         Route::get('/r/edit/{id}',[BackendController::class,'roleEdit'])->name('admin.rp.role.edit');
         Route::put('/r/update/{id}',[BackendController::class,'roleUpdate'])->name('admin.rp.role.update');

         Route::delete('/r/destroy/{id}',[BackendController::class,'roleDelete'])->name('admin.rp.role.delete');


         Route::get('/p',[BackendController::class,'permissionIndex'])->name('admin.rp.p.index');

         Route::post('/p/store',[BackendController::class,'permissionStore'])->name('admin.rp.p.store');

         Route::put('/p/update/{id}',[BackendController::class,'permissionUpdate'])->name('admin.rp.p.update');

         Route::delete('/p/delete/{id}',[BackendController::class,'permissionDelete'])->name('admin.rp.p.delete');

    });

    //order import


});

//change order for admin and staff
Route::post('/s/change/',[OrderController::class,'changeOrderStatus'])->name('order.status.change');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// excel import/export
Route::get('file/import/read',[OrderController::class,'UserImportfileReading'])->name('user.file.reading');
Route::get('file-import-export', [OrderController::class, 'fileImportExport']);
Route::post('file-import', [OrderController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [OrderController::class, 'fileExport'])->name('file-export');


require __DIR__ . '/auth.php';

// auth redireact

Route::get('/redirect', [ResponseController::class, 'index']);

Route::resource('staff',StaffController::class);
