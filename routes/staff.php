<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\Auth\LoginController;
use App\Http\Controllers\StaffController;

Route::name('staffs.')->namespace('Staff')->prefix('staffs')->group(function(){

    Route::namespace('Auth')->middleware('guest:staff')->group(function(){
        //login route
        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@processLogin');
       
    });

    Route::namespace('Auth')->middleware('auth:staff')->group(function(){

        Route::post('/logout',function(){
            Auth::guard('doctor')->logout();
            return redirect()->action([
                LoginController::class,
                'login'
            ]);
        })->name('logout');

    });

   
        //login route
        
    


});




?>