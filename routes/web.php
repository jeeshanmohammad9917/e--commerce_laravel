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

Route::controller( \App\Http\Controllers\homecontroller::class)->group(function(){
    Route::get('/','index')->name('home');  
    Route::get('/view-product/{product:product_code}','productinfo')->name('product_info');  
    Route::get('/list-product','productlist')->name('product_list');  

});
Route::resource('cart', \App\Http\Controllers\CartController::class);
Route::post('add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('/store_order',[ \App\Http\Controllers\CartController::class , 'storeOrder'])->name('store_order');

Route::controller( \App\Http\Controllers\OrderController::class)->group(function(){
    Route::get('/orders', 'index')->name('list_orders');
    Route::post('/change-order-status/{id}', 'changeOrderStatus')->name('admin_change_order_status');
    Route::get('/lineitems/{id}', 'getLineItems')->name('get_line_items');

});

Route::controller( \App\Http\Controllers\Authentication::class)->group(function(){
    Route::get('/reg','register')->name('register');
    Route::post('/register','storeuser')->name('store_user');
    Route::get('/login','login')->name('login');
    Route::post('/login-auth','authenticate')->name('login_auth');
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
        Route::get('/adminhome','index')->name('admin_home');
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
     Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
        Route::post('/change-product-image/{id}', 'changeProductImage')->name('admin_product_image_change');
        Route::get('/change-product-status/{id}/{status?}', 'changeProductStatus')->name('admin_change_product_status');
    });
});

Route::get('/payment', [\App\Http\Controllers\RazorpayController::class,'formpage'])->name('payment');
Route::get('/make-order', [\App\Http\Controllers\RazorpayController::class,'makeorder'])->name('make-order');
Route::get('/success', [\App\Http\Controllers\RazorpayController::class,'success'])->name('success');

