<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/user_index', function () {
    return view('user_index');
});


Route::controller( \App\Http\Controllers\Authentication::class)->group(function(){
    Route::get('/','register')->name('register');
    Route::post('/register','storeuser')->name('store_user');
    Route::get('/login','login')->name('login');
    Route::post('/login','authenticate')->name('login_auth');
    Route::get('/forgotpass','forgotpassword')->name('forgotpassword');
    Route::post('/forgot-password', 'sendForgotPasswordEmail')->name('send_forgot_password_email');
    Route::get('/reset-password/{token}', 'resetPassword')->name('reset_password');
    Route::post('/reset-password', 'resetPasswordData')->name('reset_password_data');
    Route::get('/out','out')->name('out');

});

Route::controller( \App\Http\Controllers\usercontroller::class)->group(function(){
    Route::get('/profile','userprofile')->name('user_profile');
    Route::put('/profile','userprofileupdate')->name('userprofileupdate');
    Route::post('/profile','userimageupdate')->name('userimageupdate');
    Route::get('/Home','Home')->name('user_index');
});



Route::group(['prefix' => '/admin', 'middleware'=> 'checkRoles'],function(){
   
    Route::controller( \App\Http\Controllers\admincontroller::class)->group(function(){
        Route::get('/','index')->name('admin_home');
       
    });
});


