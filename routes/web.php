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
        Route::get('/userr-list', 'usersList')->name('admin_user_list');
        Route::get('/edit-user/{id}', 'editUsers')->name('admin_user_edit');
        Route::put('/update-user/{id}', 'updateUsers')->name('admin_user_update');
        Route::post('/update-user-profile/{id}', 'updateUsersProfile')->name('admin_user_profile_update');
        Route::get('/register-user', 'registerUsersProfile')->name('admin_user_profile_register');
        Route::post('/register-user', 'registerUsersProfileData')->name('admin_user_profile_register_data');
        Route::get('/change-user-status/{id}/{status?}', 'changeUserStatus')->name('admin_change_user_status');  
    });
    Route::resource('brands', \App\Http\Controllers\BrandController::class);
    Route::controller( \App\Http\Controllers\BrandController::class)->group(function(){
        Route::post('/change-brand-image/{id}', 'changeBrandImage')->name('admin_brand_image_change');
        Route::get('/change-brand-status/{id}/{status?}', 'changeBrandStatus')->name('admin_change_brand_status');  
    });
    Route::resource('products', \App\Http\Controllers\ProductController::class);

});


